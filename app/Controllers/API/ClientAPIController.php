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

        // Fetch phone numbers
        $phones = $clientModel->select('clients.client_id, phones.phone_number, phones.country_id')
            ->join('phones', 'clients.client_id = phones.client_id', 'left')
            ->groupStart()
            ->like('clients.client_firstname', $search)
            ->orLike('clients.client_lastname', $search)
            ->orLike('clients.client_email', $search)
            ->orLike('phones.phone_number', $search)
            ->groupEnd()
            ->groupStart()
            ->where('clients.employee_id', $employee_id)
            ->groupEnd()
            ->findAll();


        $clientsWithPhones = [];

        // Group phone numbers by client_id
        $phoneNumbersByClient = [];
        foreach ($phones as $phone) {
            $clientId = $phone->client_id;

            if (!isset($phoneNumbersByClient[$clientId])) {

                $phoneNumbersByClient[$clientId] = [];

            }
            //Check if country_id is null & set it to 0
            if($phone->country_id == null ||  $phone->phone_number == null){
                continue;
            }
            $phoneNumbersByClient[$clientId][] = [
                'country_id' => $phone->country_id,
                'phone_number' => $phone->phone_number
            ];
        }

        // Combine clients with their phone numbers
        foreach ($clients as $client) {
            $clientId = $client->client_id;
            $clientsWithPhones[] = [
                'client_id' => $client->client_id,
                'client_firstname' => $client->client_firstname,
                'client_lastname' => $client->client_lastname,
                'client_email' => $client->client_email,
                'phone_numbers' => $client->phone_numbers,
                'phones' => isset($phoneNumbersByClient[$clientId]) ? $phoneNumbersByClient[$clientId] : []
            ];
        }



        return $this->response->setJSON($clientsWithPhones);
    }
}
