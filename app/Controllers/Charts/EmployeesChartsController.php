<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use App\Models\Settings\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeesChartsController extends BaseController
{
    private function checkAdminAccess()
    {
        $role = $this->session->get("role");
        if ($role !== 'admin') {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Access denied']);
        }
        return null;
    }

    public function employeeRoleDistribution()
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        try {
            $model = new EmployeeModel();
            $data = $model->select('employee_role, COUNT(*) AS total')
                          ->groupBy('employee_role')
                          ->findAll();

            if (empty($data)) {
                return $this->response->setStatusCode(200)->setJSON([
                    ['employee_role' => 'No Data', 'total' => 0]
                ]);
            }

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function employeeCountOverTime()
    {
        if ($response = $this->checkAdminAccess()) {
            return $response;
        }

        try {
            $model = new EmployeeModel();
            $data = $model->select('DATE(created_at) AS date, COUNT(*) AS total_employees')
                          ->groupBy('DATE(created_at)')
                          ->orderBy('date')
                          ->findAll();

            if (empty($data)) {
                return $this->response->setStatusCode(200)->setJSON([
                    ['date' => date('Y-m-d'), 'total_employees' => 0]
                ]);
            }

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }
}
