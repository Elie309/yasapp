<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;

class ClientAPIController extends BaseController
{
    public function search()
    {

        $employee_id = $this->session->get('id');

        $clientModel = new ClientModel();

        $search = esc($this->request->getVar('search'));
        $search = str_replace('+', ' ', $search);
        $search = trim($search);

        $clients = $clientModel->select('Clients.client_id, Clients.client_firstname, Clients.client_lastname, Clients.client_email, GROUP_CONCAT(Phones.phone_number SEPARATOR ", ") as phone_numbers')
            ->join('Phones', 'Clients.client_id = Phones.client_id', 'left')
            ->groupStart()
            ->like('Clients.client_firstname', $search)
            ->orLike('Clients.client_lastname', $search)
            ->orLike('Clients.client_email', $search)
            ->orLike('Phones.phone_number', $search)
            ->groupEnd()
            ->groupStart()
            ->where('Clients.employee_id', $employee_id)
            ->groupEnd()
            ->groupBy('Clients.client_id')
            ->findAll();

        return $this->response->setJSON($clients);
    }
}
