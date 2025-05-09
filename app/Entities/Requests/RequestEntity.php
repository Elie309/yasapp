<?php

namespace App\Entities\Requests;

use CodeIgniter\Entity\Entity;
use Error;

class RequestEntity extends Entity
{
    protected $datamap = [];
    
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'request_id' => 'integer',
        'client_id' => 'integer',
        'city_id' => 'integer',
        'currency_id' => 'integer',
        'agent_id' => 'integer',
        'request_budget' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];


    public function isValid(): Error|bool
    {
        $errors = [];

        if (empty($this->city_id) || !is_int($this->city_id) || $this->city_id < 1) {
            $errors[] = 'City name invalid';
        }


        if (empty($this->currency_id) || !is_int($this->currency_id) || $this->currency_id < 1) {
            $errors[] = 'Currency is invalid';
        }

        if (empty($this->agent_id) || !is_int($this->agent_id) || $this->agent_id < 1) {
            $errors[] = 'Agent is invalid';
        }

        if(!is_string($this->request_location)) {
            $errors[] = 'Request location is invalid';
        }

        if (empty($this->request_budget) || !is_float($this->request_budget)) {
            $errors[] = 'Request budget is invalid';
        }

        if (empty($this->request_state) || !is_string($this->request_state)) {
            $errors[] = 'Request state is invalid';
        }

        if (empty($this->request_priority) || !is_string($this->request_priority)) {
            $errors[] = 'Request priority is invalid';
        }

        if (!is_string($this->comments)) {
            $errors[] = 'Comments are invalid';
        }

        if (!empty($errors)) {
            return new Error(implode(', ', $errors));
        }

        return true;

    }
}
