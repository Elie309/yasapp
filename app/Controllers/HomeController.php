<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view("template/header") . view('Dashboard/dashboard') . view("template/footer");
    }
}
