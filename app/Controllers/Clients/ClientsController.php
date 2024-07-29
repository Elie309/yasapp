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

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 5;

        $search = esc($this->request->getVar('search'));
        $search = trim($search);

        $searchParam = esc($this->request->getVar('searchParam'));

        $param = [
            'firstname' => 'clients.client_firstname',
            'lastname' => 'clients.client_lastname',
            'email' => 'clients.client_email',
            'visibility' => 'clients.client_visibility',
            'phone_number' => 'phones.phone_number'
        ];

        if (isset($search) && !empty($search)) {
            if ($searchParam != 'phone_number') {
                $clients = $clientModel->select('clients.*, GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers')
                    ->join('phones', 'phones.client_id = clients.client_id', 'left')
                    ->join('countries', 'countries.country_id = phones.country_id', 'left')
                    ->where('(clients.employee_id = ' . $employee_id . ' OR clients.client_visibility = "public")')
                    ->like($param[$searchParam] ?? 'clients.client_firstname', $search)
                    ->groupBy('clients.client_id')
                    ->paginate($rowsPerPage);
            } else {
                $clients = $clientModel->select('clients.*, GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers')
                    ->join('phones', 'phones.client_id = clients.client_id', 'left')
                    ->join('countries', 'countries.country_id = phones.country_id', 'left')
                    ->where('(clients.employee_id = ' . $employee_id . ' OR clients.client_visibility = "public")')
                    ->like('phones.phone_number', $search)
                    ->groupBy('clients.client_id')
                    ->paginate($rowsPerPage);
            }
        } else {
            $clients = $clientModel->select('clients.*, GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers')
                ->join('phones', 'phones.client_id = clients.client_id', 'left')
                ->join('countries', 'countries.country_id = phones.country_id', 'left')
                ->where('clients.employee_id', $employee_id)
                ->orWhere('clients.client_visibility', 'public')
                ->groupBy('clients.client_id')
                ->paginate($rowsPerPage);
        }
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
            if (is_array($phones)) {
                foreach ($phones as $key => $phone) {
                    $phoneData = [
                        'client_id' => $client_id,
                        'country_id' => $countries[$key],
                        'phone_number' => $phone
                    ];

                    if (!$phoneModel->save($phoneData)) {

                        $clientModel->delete($client_id);
                        return redirect()->back()->with('errors', $phoneModel->errors());

                    }
                }
            } else {
                return redirect()->back()->with('errors', ['Phone numbers are not provided correctly.']);
            }


            return redirect()->back()->with('success', 'Client added successfully');
        } else {
            return redirect()->back()->with('errors', $clientModel->errors());
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

        $client = $clientModel->find($id);
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

        if ($clientModel->update($id, $clientData)) {
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
                        return redirect()->back()->with('errors', $phoneModel->errors());
                    }
                }

                return redirect()->back()->with('success', 'Client updated successfully');
            } else {
                return redirect()->back()->with('errors', ['Phone numbers are not provided correctly.']);
            }
        } else {
            return redirect()->back()->with('errors', $clientModel->errors());
        }
    }

    public function delete()
    {
        //
    }
}
