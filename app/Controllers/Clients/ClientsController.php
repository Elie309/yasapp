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
        $id = $session->get('id');

        $clientModel = new ClientModel();

        $clients = $clientModel->select('clients.*, countries.country_code, phones.phone_number')
            ->join('phones', 'phones.client_id = clients.client_id', 'left')
            ->join('countries', 'countries.country_id = phones.country_id', 'left')
            ->where('clients.employee_id', $id)
            ->orWhere('clients.client_visibility', 'public')
            ->findAll();

            $clientsGrouped = [];

            foreach ($clients as $client) {
                if (!isset($clientsGrouped[$client->client_id])) {
                    $clientsGrouped[$client->client_id] = $client;
                    $clientsGrouped[$client->client_id]->phones = [];
                }
                $clientsGrouped[$client->client_id]->phones = $client->country_code . ' ' . $client->phone_number;
            }
            
            // Convert the associative array back to a numeric array
            $clients = array_values($clientsGrouped);

        return view('template/header', ['role' => $role]) . view('Clients/clients', ['employee_id' => $id, 'clients' => $clients]) . view('template/footer');
    }

    public function add()
    {
        $session = service('session');

        $role = $session->get('role');
        $id = $session->get('id');

        $countries = new CountryModel();
        $countries = $countries->findAll();


        return view('template/header', ['role' => $role]) . view('Clients/addClient', ['employee_id' => $id, 'countries' => $countries]) . view('template/footer');
    }

    public function addClient()
    {
        $session = service('session');

        $role = $session->get('role');
        $id = $session->get('id');

        $firstname = $this->request->getPost('client_firstname');
        $lastname = $this->request->getPost('client_lastname');
        $email = $this->request->getPost('client_email');
        $visibility = $this->request->getPost('client_visibility');
        $phones = $this->request->getPost('phone_number');
        $countries = $this->request->getPost('country_id');

        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        $clientData = [
            'employee_id' => $id,
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
        //
    }

    public function updateClient($id)
    {
        //
    }

    public function delete()
    {
        //
    }
}
