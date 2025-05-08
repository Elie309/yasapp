<?php 

namespace App\Services\Listings;

use App\Services\BaseServices;

class ListingsServices extends BaseServices
{

    private $tiles = [
        'european',
        'marble',
        'granite',
        'parquet',
        'other'
    ];
    
    private $LAND_TYPES = [
        'residential',
        'industrial',
        'commercial',
        'agricultural',
        'mixed',
        'other'
    ];

    public function __construct()
    {
      
    }



    public function getTiles(){

        return $this->tiles;
    }

    public function getLandTypes(){

        return $this->LAND_TYPES;
    }
   
}