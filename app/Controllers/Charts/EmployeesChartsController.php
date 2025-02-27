<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use App\Models\Settings\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeesChartsController extends BaseController
{

    public function employeeRoleDistribution()
    {
        $model = new EmployeeModel();
        $data = $model->select('employee_role, COUNT(*) AS total')
                      ->groupBy('employee_role')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function employeeCountOverTime()
    {
        $model = new EmployeeModel();
        $data = $model->select('DATE(created_at) AS date, COUNT(*) AS total_employees')
                      ->groupBy('DATE(created_at)')
                      ->orderBy('date')
                      ->findAll();

        return $this->response->setJSON($data);
    }
}
