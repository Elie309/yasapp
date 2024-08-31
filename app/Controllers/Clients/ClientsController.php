<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;
use App\Models\Settings\Location\CountryModel;
use App\Models\Clients\PhoneModel;

class ClientsController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        $clientModel = new ClientModel();

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $search = esc($this->request->getVar('search'));

        $visibility = esc($this->request->getVar('visibility'));

        $created_at = esc($this->request->getVar('createdAt'));

        $updated_at = esc($this->request->getVar('updatedAt'));


        $clients = $clientModel->select('clients.*, CONCAT(clients.client_firstname, " ", clients.client_lastname) as full_name, GROUP_CONCAT(CONCAT(countries.country_code, " " ,phones.phone_number) SEPARATOR ", ") as phone_numbers')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->groupStart()
            ->where('clients.employee_id', $employee_id)
            ->orWhere('clients.client_visibility', 'public')
            ->groupEnd()
            ->groupBy('clients.client_id');

        if (isset($search) && !empty($search)) {
            $clients->groupStart()
                ->like('clients.client_firstname', $search)
                ->orLike('clients.client_lastname', $search)
                ->orLike('clients.client_email', $search)
                ->orLike('phones.phone_number', $search)
                ->groupEnd();
        }

        if (isset($visibility) && !empty($visibility)) {
            $clients->where('clients.client_visibility', $visibility);
        }

        if (isset($created_at) && !empty($created_at)) {
            $clients->where('clients.created_at >=', $created_at . ' 00:00:00')
                ->orderBy('clients.created_at', 'ASC');
        }

        if (isset($updated_at) && !empty($updated_at)) {
            $clients->where('clients.updated_at >=', $updated_at . ' 00:00:00')
                ->orderBy('clients.updated_at', 'ASC');
        }

        $clients = $clients->paginate($rowsPerPage);

        $pager = $clientModel->pager;


        return view('template/header', ['role' => $role]) . view('Clients/clients', ['employee_id' => $employee_id, 'clients' => $clients, 'pager' => $pager]) . view('template/footer');
    }



    public function add()
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        // TODO: Change the way we access the countries
        $countriesModel = new CountryModel();
        $countries = $countriesModel->findAll();

        return view('template/header', ['role' => $role]) . view('Clients/addClient', ['employee_id' => $employee_id, 'countries' => $countries]) . view('template/footer');
    }

    public function addClient()
    {
        $session = service('session');

        $employee_id = $session->get('id');

        $firstname = $this->request->getPost('client_firstname');
        $lastname = $this->request->getPost('client_lastname');
        $email = $this->request->getPost('client_email');
        $visibility = $this->request->getPost('client_visibility');
        $phones = $this->request->getPost('phone_number');
        $countries = $this->request->getPost('country_id');



        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $clientData = [
            'employee_id' => $employee_id,
            'client_firstname' => $firstname,
            'client_lastname' => $lastname,
            'client_email' => $email,
            'client_visibility' => $visibility,
        ];

        if ($clientModel->save($clientData)) {
            $client_id = $clientModel->insertID();

            // Ensure $phones is an array before using it in the foreach loop
            if (
                is_array($phones) && is_array($countries) && count($phones) == count($countries)
                && count($phones) > 0 && count($countries) > 0
            ) {
                foreach ($phones as $key => $phone) {
                    $phoneData = [
                        'client_id' => $client_id,
                        'country_id' => $countries[$key],
                        'phone_number' => $phone
                    ];

                    if (!$phoneModel->save($phoneData)) {

                        $clientModel->delete($client_id);
                        return redirect()->back()->withInput()->with('errors', $phoneModel->errors());
                    }
                }
            } //No need to check if it is empty or anything, the validation will take care of it


            return redirect()->back()->with('success', 'Client added successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', $clientModel->errors());
        }
    }

    public function edit($id)
    {

        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();
        $countriesModel = new CountryModel();

        $client = $clientModel->select('clients.*')
            ->groupStart()
            ->where('clients.client_id', $id)
            ->where('clients.employee_id', $employee_id)
            ->groupEnd()
            ->groupBy('clients.client_id')
            ->first();

        if (!$client) {
            return redirect()->back();
        }

        $phones = $phoneModel->where('client_id', $id)->findAll();
        $countries = $countriesModel->findAll();

        return view('template/header', ['role' => $role]) . view('Clients/editClient', ['client' => $client, 'phones' => $phones, 'employee_id' => $employee_id, 'countries' => $countries]) . view('template/footer');
    }

    public function updateClient($id)
    {

        $session = service('session');

        $employee_id = $session->get('id');

        $firstname = $this->request->getPost('client_firstname');
        $lastname = $this->request->getPost('client_lastname');
        $email = $this->request->getPost('client_email');
        $visibility = $this->request->getPost('client_visibility');
        $phones = $this->request->getPost('phone_number');
        $countries = $this->request->getPost('country_id');

        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $clientData = [
            'client_firstname' => $firstname,
            'client_lastname' => $lastname,
            'client_email' => $email,
            'client_visibility' => $visibility,
        ];

        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->back();
        }

        if($client->employee_id != $employee_id || $client->client_visibility != 'public'){
            return redirect()->back();
        }

        if ($clientModel->update($id, $clientData)) {
            //The where will get all the phone numbers for the client and delete them
            $phoneModel->where('client_id', $id)->delete();

            // Ensure $phones is an array before using it in the foreach loop
            if (is_array($phones)) {
                foreach ($phones as $key => $phone) {
                    $phoneData = [
                        'client_id' => $id,
                        'country_id' => $countries[$key],
                        'phone_number' => $phone
                    ];

                    if (!$phoneModel->save($phoneData)) {
                        return redirect()->back()->withInput()->with('errors', $phoneModel->errors());
                    }
                }

                return redirect()->back()->with('success', 'Client updated successfully');
            }

            return redirect()->back()->with('success', 'Client updated successfully, with no phone number');
        } else {
            return redirect()->back()->withInput()->with('errors', $clientModel->errors());
        }
    }

    public function view($id)
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');


        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $client = $clientModel->select('clients.*, employees.employee_name')
            ->join('employees', 'employees.employee_id = clients.employee_id')
            ->where('clients.client_id', $id)
            ->first();
        $phones = $phoneModel->select('phones.*, countries.country_code')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->where('phones.client_id', $id)
            ->findAll();

        return view('template/header', ['role' => $role]) . view('Clients/viewClient', ['client' => $client, 'phones' => $phones, 'employee_id' => $employee_id]) . view('template/footer');
    }
}
