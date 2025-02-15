<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\EmployeeSubregionModel;
use App\Models\Settings\Location\SubregionModel;
use App\Models\Settings\EmployeeModel;
use App\Entities\Settings\EmployeeSubregionEntity;

/**
 * Class EmployeeSubregionController
 */
class EmployeeSubregionController extends BaseController
{
    protected $employeeSubregionModel;
    protected $subregionModel;
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeSubregionModel = new EmployeeSubregionModel();
        $this->subregionModel = new SubregionModel();
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $results = $this->employeeSubregionModel->select('employee_subregions.*, employees.employee_name, subregions.subregion_name')
            ->join('employees', 'employees.employee_id = employee_subregions.employee_id')
            ->join('subregions', 'subregions.subregion_id = employee_subregions.subregion_id')
            ->findAll();

        return view("template/header") .
            view('settings/employee_subregions', [
                'results' => $results,
                'employees' => $this->employeeModel->findAll(),
                'subregions' => $this->subregionModel->findAll(),
            ]) .
            view("template/footer");
    }

    public function addEmployeeSubregion()
    {
        $employeeId = $this->request->getPost('employee_id');
        $subregionId = $this->request->getPost('subregion_id');

        if (!$this->employeeModel->find($employeeId) || !$this->subregionModel->find($subregionId)) {
            return redirect()->back()->with('error', 'Invalid Employee or Subregion.');
        }

        $employeeSubregion = new EmployeeSubregionEntity();
        $employeeSubregion->employee_id = $employeeId;
        $employeeSubregion->subregion_id = $subregionId;

        if ($this->employeeSubregionModel->insert($employeeSubregion)) {
            return redirect()->to('/settings/employee-subregions')->with('success', 'Employee Subregion added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add Employee Subregion.');
        }
    }


    public function deleteEmployeeSubregion()
    {
        //Get posts
        $employeeId = $this->request->getPost('employee_id');
        $subregionId = $this->request->getPost('subregion_id');

        //Check if the employee subregion exists
        $employeeSubregion = $this->employeeSubregionModel->where('employee_id', $employeeId)
            ->where('subregion_id', $subregionId)
            ->first();
        
        if (!$employeeSubregion) {
            return redirect()->back()->with('error', 'Employee Subregion not found.');
        }

        //Delete the employee subregion
        if ($this->employeeSubregionModel->delete($employeeSubregion->employee_subregion_id)) {
            return redirect()->to('/settings/employee-subregions')->with('success', 'Employee Subregion deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Employee Subregion.');
        }
    }
}
