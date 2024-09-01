<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\Settings\EmployeeModel;

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
         
        

         if ($employee && $employee->verifyPassword($password)) {

             $newData = [
                'name' => $name,
                'role' => $employee->employee_role,
                'id' => $employee->employee_id
             ];
    
             $this->session->set($newData);

             return redirect()->to("/"); 

         } else {

            $this->session->setFlashdata('error', 'Invalid username or password');

            return redirect()->back();
         }

    }

    public function logout(){

        $array_items = ['name', 'role'];
        $this->session->remove($array_items);

        return redirect()->to("login");
    }
}
