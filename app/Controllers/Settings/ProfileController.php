<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\EmployeeModel;

class ProfileController extends BaseController
{
    public function index()
    {

        $employeeModel = new EmployeeModel();


        $employee = $employeeModel->where('employee_name', $this->session->get('name'))->where('employee_status', 'active')->first();


        return view("template/header") . view('Settings/profile', ['employee' => $employee]) . view("template/footer");
    }


    public function updateProfile()
    {

        $employee_id = $this->session->get('id');

        $employeeModel = new EmployeeModel();

        $employeeData = [
            'employee_name' => $this->request->getPost('employee_name'),
            'employee_email' => $this->request->getPost('employee_email'),
            'employee_phone' => $this->request->getPost('employee_phone'),
            'employee_address' => $this->request->getPost('employee_address'),
            'employee_birthday' => $this->request->getPost('employee_birthday'),
        ];

        $employeeData['employee_id'] = $employee_id;

        // Handler for password
        $employee_password = $this->request->getPost('employee_password');


        //check if password is a string
        if (isset($employee_password) && !empty($employee_password) && is_string($employee_password)) {
            //Use the entity to hash the password
            $employeeData['employee_password'] = (new \App\Entities\EmployeeEntity())->setPassword($employee_password)->employee_password;
        }

        // CHeck for employee id
        if (isset($employeeData['employee_id']) && !empty($employeeData['employee_id'])) {

            // Get the employee data
            $employee = $employeeModel->find($employeeData['employee_id']);

            // UNSET THE DATA THAT MUST BE UNIQUE IF THEY ARE THE SAME
            if ($employeeData['employee_name'] == $employee->employee_name) {
                unset($employeeData['employee_name']);
            }
            if ($employeeData['employee_email'] == $employee->employee_email) {
                unset($employeeData['employee_email']);
            }
            if ($employeeData['employee_phone'] == $employee->employee_phone) {
                unset($employeeData['employee_phone']);
            }



            // Update the employee
            if ($employeeModel->update($employeeData['employee_id'], $employeeData)) {
                if (isset($employeeData['employee_name'])) {
                    $this->session->set('name', $employeeData['employee_name']);
                }
                return redirect()->to('settings/profile')->with('success', 'Employee updated successfully');
            } else {
                return redirect()->to('settings/profile')->with('errors', $employeeModel->errors());
            }
        }

        return redirect()->to('settings/profile')->with('errors', 'Employee ID not found');
    }
}
