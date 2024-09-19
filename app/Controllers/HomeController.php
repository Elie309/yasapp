<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view("template/header") . view('dashboard/dashboard') . view("template/footer");
    }
}
