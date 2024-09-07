<?php

namespace App\Controllers\Listings;

use App\Controllers\BaseController;

class ListingsController extends BaseController
{
    public function index()
    {
        return view('template/header') . view('listings/listings') . view('template/footer');
    }
}
