<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LocationController extends BaseController
{
    public function index()
    {
        $session = service('session');
        
        return view("template/header", ['role' => $session->get('role')]) . view('settings/location') . view("template/footer");
    }

    public function addCity(){
        
    }

    public function addSubregion(){
        
    }

    public function addRegion(){
        
    }

    public function addCountry(){
        
    }
}
