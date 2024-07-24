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

    public function handleEmployeeForm()
    {
        $session = service('session');
        $employeeModel = new EmployeeModel();

        $employeeData = [
            'employee_id' => $this->request->getPost('employee_id'),
            'employee_name' => $this->request->getPost('employee_name'),
            'employee_email' => $this->request->getPost('employee_email'),
            'employee_phone' => $this->request->getPost('employee_phone'),
            'employee_address' => $this->request->getPost('employee_address'),
            'employee_birthday' => $this->request->getPost('employee_birthday'),
            'employee_role' => $this->request->getPost('employee_role'),
            'employee_status' => $this->request->getPost('employee_status'),
        ];

        // Handler for password
        $employee_password = $this->request->getPost('employee_password');

        
        //check if password is a string
        if(isset($employee_password) && !empty($employee_password) && is_string($employee_password)){
            //Use the entity to hash the password
            $employeeData['employee_password'] = (new \App\Entities\EmployeeEntity())->setPassword($employee_password)->employee_password;
        }

        // CHeck for employee id
        if(isset($employeeData['employee_id']) && !empty($employeeData['employee_id'])){

            // Get the employee data
            $employee = $employeeModel->find($employeeData['employee_id']);
            
            // UNSET THE DATA THAT MUST BE UNIQUE IF THEY ARE THE SAME
            if($employeeData['employee_name'] == $employee->employee_name){
                unset($employeeData['employee_name']);
            }           
            if($employeeData['employee_email'] == $employee->employee_email){
                unset($employeeData['employee_email']);
            }
            if($employeeData['employee_phone'] == $employee->employee_phone){
                unset($employeeData['employee_phone']);
            }

            $currentEmployee = $employeeModel->where('employee_name', $session->get('name'))->where('employee_status', 'active')->first();

            // Update the employee
            if($employeeModel->update($employeeData['employee_id'], $employeeData)){

                if($employeeData['employee_id'] == $currentEmployee->employee_id ){
                    $newData = [
                        'name' => $employeeData['employee_name'],
                        'role' => $employeeData['employee_role'],
                    ];
                    $session->set($newData);
                }

                return redirect()->to('/settings/employees')->with('success', 'Employee updated successfully');
            }else{
                return redirect()->to('/settings/employees')->with('errors', $employeeModel->errors());
            }

        }


        if($employeeModel->save($employeeData)){
            return redirect()->to('/settings/employees')->with('success', 'Employee added successfully');
        }else{
            return redirect()->to('/settings/employees')->with('errors', $employeeModel->errors());
        }

    }
}
