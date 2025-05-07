<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class PropertyPriceEntity extends Entity
{
    protected $datamap = [
        'price_id' => 'property_price_id',
        'property_id' => 'property_price_property_id',
        'type' => 'property_price_type',
        'currency_id' => 'property_price_currency_id',
        'price_amount' => 'property_price_amount',
        'rent_period' => 'property_price_rent_period',
        'payment_plan' => 'property_price_payment_plan',
        'payment_terms' => 'property_price_payment_terms',
        'is_negotiable' => 'property_price_is_negotiable',
        'is_primary' => 'property_price_is_primary',
        'price_updated_at' => 'property_price_updated_at'
    ];

    protected $dates = ['property_price_updated_at'];
    protected $casts = [
        'property_price_id' => 'integer',
        'property_price_property_id' => 'integer',
        'property_price_currency_id' => 'integer',
        'property_price_amount' => 'float',
        'property_price_is_negotiable' => 'boolean',
        'property_price_is_primary' => 'boolean',
    ];

    protected $defaultBooleans = [
        'property_price_is_negotiable',
        'property_price_is_primary',
    ];

    public function fill(array $data = null)
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

    public function setPriceAmount(string $price)
    {
        $this->attributes['property_price_amount'] = (float) $price;
        return $this;
    }

    public function setIsNegotiable(string $value = 'off')
    {
        $this->attributes['property_price_is_negotiable'] = $value == 'on' ? true : false;
        return $this;
    }

    public function setIsPrimary(string $value = 'off')
    {
        $this->attributes['property_price_is_primary'] = $value == 'on' ? true : false;
        return $this;
    }

    public function getIsNegotiable()
    {
        return $this->attributes['property_price_is_negotiable'] ? true : false;
    }

    public function getIsPrimary()
    {
        return $this->attributes['property_price_is_primary'] ? true : false;
    }
}