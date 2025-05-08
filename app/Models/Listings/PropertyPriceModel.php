<?php

namespace App\Models\Listings;

use CodeIgniter\Model;

class PropertyPriceModel extends Model
{
    protected $table            = 'property_prices';
    protected $primaryKey       = 'property_price_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Listings\PropertyPriceEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_price_property_id',
        'property_price_type',
        'property_price_currency_id',
        'property_price_amount',
        'property_price_rent_period',
        'property_price_payment_terms',
        'property_price_is_negotiable',
        'property_price_is_primary',
        'property_price_updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'property_price_id'          => 'integer',
        'property_price_property_id'       => 'integer',
        'property_price_currency_id'       => 'integer',
        'property_price_amount'      => 'float',
    ];
    
    protected array $castHandlers = [];

    // Validation
    protected $validationRules = [
        'property_price_property_id'       => 'required|integer',
        'property_price_type'        => 'required|in_list[rent,sale]',
        'property_price_currency_id'       => 'required|integer',
        'property_price_amount'      => 'required|decimal',
        'property_price_rent_period'       => 'permit_empty|in_list[daily,weekly,monthly,yearly]',
        'property_price_payment_terms'     => 'permit_empty|in_list[cash,installments,mortgage,custom]',
        'property_price_is_negotiable'     => 'permit_empty|boolean',
        'property_price_is_primary'        => 'permit_empty|boolean',
    ];
    
    protected $validationMessages = [
        'property_price_property_id' => [
            'required' => 'Property ID is required',
            'integer'  => 'Property ID must be an integer',
        ],
        'property_price_type' => [
            'required'  => 'Price type is required',
            'in_list'   => 'Price type must be either rent or sale',
        ],
        'property_price_currency_id' => [
            'required' => 'Currency ID is required',
            'integer'  => 'Currency ID must be an integer',
        ],
        'property_price_amount' => [
            'required' => 'Price amount is required',
            'decimal'  => 'Price amount must be a decimal value',
        ],
        'property_price_rent_period' => [
            'in_list' => 'Rent period must be one of: daily, weekly, monthly, yearly',
        ],
        'property_price_payment_terms' => [
            'in_list' => 'Payment terms must be one of: cash, installments, mortgage, custom',
        ],
        'property_price_is_negotiable' => [
            'boolean' => 'Is negotiable must be a boolean value',
        ],
        'property_price_is_primary' => [
            'boolean' => 'Is primary must be a boolean value',
        ],
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all prices for a property
     *
     * @param int $propertyId
     * @return array
     */
    public function getPricesByProperty(int $propertyId)
    {
        return $this->where('property_price_property_id', $propertyId)->findAll();
    }

    /**
     * Get the primary price for a property by price type
     *
     * @param int $propertyId
     * @param string $priceType
     * @return object|null
     */
    public function getPrimaryPrice(int $propertyId, string $priceType)
    {
        return $this->where([
            'property_price_property_id' => $propertyId,
            'property_price_type'  => $priceType,
            'property_price_is_primary'  => true
        ])->first();
    }

    /**
     * Set a price as primary and ensure others of same type are not primary
     *
     * @param int $priceId
     * @param int $propertyId
     * @param string $priceType
     * @return bool
     */
    public function setPrimaryPrice(int $priceId, int $propertyId, string $priceType)
    {
        $this->db->transBegin();
        
        // First unset all primary prices for this property and price type
        $this->where([
            'property_price_property_id' => $propertyId,
            'property_price_type'  => $priceType,
        ])->set(['property_price_is_primary' => false])->update();
        
        // Then set the selected price as primary
        $this->update($priceId, ['property_price_is_primary' => true]);
        
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return false;
        }
        
        $this->db->transCommit();
        return true;
    }
}
