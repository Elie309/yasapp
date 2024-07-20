<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\EmployeeModel;

class AuthController extends BaseController
{

    // private $n = 60;

    public function login()
    {
        //TODO: To activate later on production
        // $this->cachePage($this->n);
        return view('auth/login');
    }

    public function acceptData(){

        $name = $this->request->getPost('name');
        $password = $this->request->getPost("password");
        

         $employeeModel = new EmployeeModel();

         $employee = $employeeModel->where('employee_name', $name)->where('employee_status', 'active')->first();
         
        
         $session = service('session');

         if ($employee && $employee->verifyPassword($password)) {

             $newData = [
                'name' => $name,
                'role' => $employee->employee_role,
             ];
    
             $session->set($newData);

             return redirect()->to("/"); 

         } else {

            $session->setFlashdata('error', 'Invalid username or password');

            return redirect()->back();
         }

    }

    public function logout(){
        $session = service('session');

        $array_items = ['name', 'role'];
        $session->remove($array_items);

        return redirect()->to("login");
    }
}
