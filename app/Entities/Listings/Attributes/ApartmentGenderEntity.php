<?php

namespace App\Entities\Listings\Attributes;

use App\Models\Listings\Attributes\ApartmentGenderModel;
use CodeIgniter\Entity\Entity;

class ApartmentGenderEntity extends Entity
{
    protected $datamap = [];
    protected $casts   = [
        'apartment_gender_id' => 'integer',
        'apartment_gender_name' => 'string',
    ];

    public function getApartmentGenders(){

        //Get all
        $apartmentGenders = new ApartmentGenderModel();
        $apartmentGenders = $apartmentGenders->findAll();

        $apartmentGenders = array_map(function ($apartmentGender) {
            return [
                'id' => $apartmentGender->apartment_gender_id,
                'name' => $apartmentGender->apartment_gender_name
            ];
        }, $apartmentGenders);

        return $apartmentGenders;
    }

}
