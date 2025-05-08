<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class PropertyEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'property_id' => 'integer',
        'client_id' => 'integer',
        'employee_id' => 'integer',
        'city_id' => 'integer',
        'land_id' => 'integer',
        'apartment_id' => 'integer',
        'property_status_id' => 'integer',
        'property_size' => 'float',
    ];

    protected $defaultBooleans = [
    ];

    public function fill(?array $data = null)
    {
        parent::fill($data);

        foreach ($this->defaultBooleans as $attribute) {

            //Check if the attribute is not set - if not set, set it to false -- Checkbox values are not sent when unchecked
            if (!isset($this->attributes[$attribute])) {
                $this->attributes[$attribute] = false;
            }
        }

        return $this;
    }

    public function setPropertySize(string $size)
    {
        $this->attributes['property_size'] = (float) $size;
        return $this;
    }

    public function setPropertyPrice(string $price)
    {
        $this->attributes['property_price'] = (float) $price;
        return $this;
    }





}
