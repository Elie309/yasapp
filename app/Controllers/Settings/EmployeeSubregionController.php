<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\EmployeeSubregionModel;
use App\Models\Settings\Location\SubregionModel;
use App\Models\Settings\EmployeeModel;
use App\Entities\Settings\EmployeeSubregionEntity;
use Exception;
use CodeIgniter\Database\Exceptions\DatabaseException;

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
        try {
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
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->with('errors', 'An error occurred while fetching data.');
        }
    }

    public function addEmployeeSubregion()
    {
        try {
            $employeeId = esc($this->request->getPost('employee_id'));
            $subregionId = esc($this->request->getPost('subregion_id'));

            if (!isset($employeeId) || !isset($subregionId)) {
                return redirect()->back()->with('errors', 'Employee ID or Subregion ID is missing.');
            }

            if (!$this->employeeModel->find($employeeId) || !$this->subregionModel->find($subregionId)) {
                return redirect()->back()->with('errors', 'Invalid Employee or Subregion.');
            }

            $employeeSubregion = new EmployeeSubregionEntity();
            $employeeSubregion->employee_id = $employeeId;
            $employeeSubregion->subregion_id = $subregionId;

            if (!$this->employeeSubregionModel->save($employeeSubregion)) {
                return redirect()->back()->with('errors', 'Failed to add Employee Subregion.');
            } 
            return redirect()->to('/settings/employee-subregions')->with('success', 'Employee Subregion added successfully.');

        } catch (DatabaseException $e) {

            if ($e->getCode() == 1062) { // Duplicate entry error code
                return redirect()->back()->with('errors', 'Duplicate entry for Employee and Subregion.');
            }
            return redirect()->back()->with('errors', $e->getMessage());
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function deleteEmployeeSubregion()
    {
        try {
            $employeeSubregionId = esc($this->request->getPost('employee_subregions_id'));

            if (!isset($employeeSubregionId)) {
                return redirect()->back()->with('errors', 'Employee Subregion ID is missing.');
            }

            $employeeSubregion = $this->employeeSubregionModel->find($employeeSubregionId);

            if (!$employeeSubregion) {
                return redirect()->back()->with('errors', 'Employee Subregion not found.');
            }

            if ($this->employeeSubregionModel->delete($employeeSubregionId)) {
                return redirect()->to('/settings/employee-subregions')->with('success', 'Employee Subregion deleted successfully.');
            } else {
                return redirect()->back()->with('errors', 'Failed to delete Employee Subregion.');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->with('errors', 'An error occurred while deleting Employee Subregion.');
        }
    }
}
