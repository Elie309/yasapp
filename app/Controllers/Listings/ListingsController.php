<?php

namespace App\Controllers\Listings;

use App\Controllers\BaseController;

class ListingsController extends BaseController
{
    public function index()
    {
        return view('template/header') . view('listings/listings') . view('template/footer');
    }

    public function add(){
        return view('template/header') . view('listings/saveListing', ['method' =>'NEW_REQUEST']) . view('template/footer');
    }
}
