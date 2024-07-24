<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        $session = service('session');
        
        return view("template/header", ['role' => $session->get('role')]) . view('settings/settings') . view("template/footer");
    }

}
