<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        
        return view("template/header") . view('settings/settings') . view("template/footer");
    }

}
