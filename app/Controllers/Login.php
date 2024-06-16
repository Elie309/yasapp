<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Employee as EmployeeModel;
use Config\Cookie;

class Login extends BaseController
{

    private $n = 60;

    public function index()
    {
        $this->cachePage($this->n);
        return view('login');
    }

    public function acceptData(){

        $name = $this->request->getPost('name');
        $password = $this->request->getPost("password");
        

         $employeeModel = new EmployeeModel();

         $employee = $employeeModel->where('name', $name)->first();
         
       

         if ($employee && $employee->verifyPassword($password)) {
             // Authentication successful

             $session = service('session');

             $newData = [
                'name' => $name,
                'role' => $employee->role,
             ];
    
             $session->set($newData);

             return redirect()->to("/"); 

         } else {
             return redirect()->back()->with('error', 'Invalid username or password');
         }
        

    

    }
}
