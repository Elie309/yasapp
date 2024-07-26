<?php

namespace App\Entities\Clients;

use CodeIgniter\Entity\Entity;

class ClientEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'client_id' => 'int',
        'employee_id' => 'int',
        'client_firstname' => 'string',
        'client_lastname' => 'string',
        'client_email' => 'string',
        'client_visibility' => 'string',
    ];

    //Get phone numbers
    public function getPhones()
    {
        $phoneModel = new \App\Models\Clients\PhoneModel();


        $phones = $phoneModel->select('phones.*, countries.country_code')
        ->join('countries', 'countries.country_id = phones.country_id', 'left')
        ->where('phones.client_id', $this->client_id)
        ->findAll();

        
        $phoneList = [];

        foreach ($phones as $phone) {
            $phoneList[] = $phone->country_code . ' ' . $phone->phone_number;
        }

        return $phoneList;
    }
}
