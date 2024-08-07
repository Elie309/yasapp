<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $session = service('session');
        return view("template/header", ['role' => $session->get('role')]) . view('Dashboard/dashboard') . view("template/footer");
    }
}
