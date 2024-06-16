<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view("template/header") . view('dashboard') . view("template/footer");
    }
}
