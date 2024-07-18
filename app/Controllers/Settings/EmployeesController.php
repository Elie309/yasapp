<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class EmployeesController extends BaseController
{

    public function index()
    {
        $session = service('session');

        $employeeModel = new EmployeeModel();
        $employeeData = $employeeModel->findAll();

        return view("template/header", ['role' => $session->get('role')]) .
            view('settings/employees', ['employeeData' => $employeeData]) .
            view("template/footer");
    }
}
