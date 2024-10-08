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

        $employee_id = $this->session->get('id');

        $clientModel = new ClientModel();

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $clients = $this->_applyFilters($clientModel, $employee_id);
        
        $clients = $clients->paginate($rowsPerPage);

        $pager = $clientModel->pager;


        return view('template/header') . view('clients/clients', ['employee_id' => $employee_id, 'clients' => $clients, 'pager' => $pager]) . view('template/footer');
    }



    public function add()
    {
        $employee_id = $this->session->get('id');

        // TODO: Change the way we access the countries
        $countriesModel = new CountryModel();
        $countries = $countriesModel->findAll();

         return view('template/header')  . view('clients/addClient', ['employee_id' => $employee_id, 'countries' => $countries]) . view('template/footer');
    }

    public function addClient()
    {

        $employee_id = $this->session->get('id');

        $firstname = $this->request->getPost('client_firstname');
        $lastname = $this->request->getPost('client_lastname');
        $email = $this->request->getPost('client_email');
        $phones = $this->request->getPost('phone_number');
        $countries = $this->request->getPost('country_id');



        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $clientData = [
            'employee_id' => $employee_id,
            'client_firstname' => $firstname,
            'client_lastname' => $lastname,
            'client_email' => $email,
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



        $employee_id = $this->session->get('id');

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
            return redirect('clients')->with('errors', ['Not allowed to edit this client']);
        }

        $phones = $phoneModel->where('client_id', $id)->findAll();
        $countries = $countriesModel->findAll();

        return view('template/header')  . view('clients/editClient', ['client' => $client, 'phones' => $phones, 'employee_id' => $employee_id, 'countries' => $countries]) . view('template/footer');
    }

    public function updateClient($id)
    {

 

        $employee_id = $this->session->get('id');

        $firstname = $this->request->getPost('client_firstname');
        $lastname = $this->request->getPost('client_lastname');
        $email = $this->request->getPost('client_email');
        $phones = $this->request->getPost('phone_number');
        $countries = $this->request->getPost('country_id');

        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $clientData = [
            'client_firstname' => $firstname,
            'client_lastname' => $lastname,
            'client_email' => $email,
        ];

        $client = $clientModel->find($id);

        if (!$client) {
            return redirect('clients')->with('errors', ['Client not found']);
        }

        if($client->employee_id != $employee_id){
            return redirect('clients')->with('errors', ['Not allowed to edit this client']);
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

        $employee_id = $this->session->get('id');


        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $client = $clientModel->select('clients.*, employees.employee_name')
            ->join('employees', 'employees.employee_id = clients.employee_id')
            ->where('clients.client_id', $id)
            ->first();

        if(!$client){
            return redirect('clients')->with('errors', ['Client not found']);
        }

        if($client->employee_id != $employee_id){
            return redirect('clients')->with('errors', ['You are not allowed to view this client']);
        }
        $phones = $phoneModel->select('phones.*, countries.country_code')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->where('phones.client_id', $id)
            ->findAll();

            return view('template/header') . view('clients/viewClient', ['client' => $client, 'phones' => $phones, 'employee_id' => $employee_id]) . view('template/footer');
    }

    public function export(){
        
        helper('excel');

        $employee_id = $this->session->get('id');

        $clientsModel = new ClientModel();

        $clients = $this->_applyFilters($clientsModel, $employee_id);

        $clients = $clients->findAll();

        $filename = 'clients_export_' . date('Ymd') . '.xlsx';
        $header =
        [
            'client_id' => 'ID',
            'client_firstname' => 'Firstname',
            'client_lastname' => 'Lastname',
            'client_email' => 'Email',
            'phone_numbers' => 'Phone Numbers',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
        export_to_excel($filename, $header, $clients);
       
    }


    private function _applyFilters($clientModel, $employee_id){
        $search = esc($this->request->getVar('search'));

        $created_at = esc($this->request->getVar('createdAt'));

        $updated_at = esc($this->request->getVar('updatedAt'));


        $clients = $clientModel->select('clients.*, CONCAT(clients.client_firstname, " ", clients.client_lastname) as full_name, GROUP_CONCAT(CONCAT(countries.country_code, " " ,phones.phone_number) SEPARATOR ", ") as phone_numbers')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->groupStart()
            ->where('clients.employee_id', $employee_id)
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


        if (isset($created_at) && !empty($created_at)) {
            $clients->where('clients.created_at >=', $created_at . ' 00:00:00')
                ->orderBy('clients.created_at', 'ASC');
        }

        if (isset($updated_at) && !empty($updated_at)) {
            $clients->where('clients.updated_at >=', $updated_at . ' 00:00:00')
                ->orderBy('clients.updated_at', 'ASC');
        }

        //ordered by created at by default
        $clients->orderBy('clients.created_at', 'DESC');

        return $clients;

    }
}
