<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;
use App\Models\Settings\Location\CountryModel;

class ClientsController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $role = $session->get('role');
        $id = $session->get('role');

        $clientModel = new ClientModel();

        $clients = $clientModel->where('employee_id', $id)
                       ->orWhere('client_visibility', 'public')
                       ->findAll();
                       
        $countries = new CountryModel();
        $countries = $countries->findAll(); 


        return view('template/header', ['role' => $role]) . view('Clients/clients', ['employee_id' => $id, 'clients' => $clients, 'countries' => $countries]) . view('template/footer');
    }

    public function add()
    {
        //
    }

    public function addClient($id)
    {
        //
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
