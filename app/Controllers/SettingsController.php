<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SettingsController extends BaseController
{
    public function index()
    {
        $session = service('session');
        
        return view("template/header", ['role' => $session->get('role')]) . view('settings/settings') . view("template/footer");
    }

    public function location(){

        $session = service('session');
        
        return view("template/header", ['role' => $session->get('role')]) . view('settings/location') . view("template/footer");
    }
}
