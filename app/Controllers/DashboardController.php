<?php

namespace App\Controllers;

use App\Models\Requests\RequestModel;
use App\Models\Listings\PropertyModel;
use App\Models\Settings\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    private $employee_id;
    private $role;

    public function __construct()
    {
        $this->employee_id = session()->get('id');
        $this->role = session()->get('role');
    }

    public function index(): string
    {

        $data = $this->getSummaryStats();

        return view("template/header") . view(
            'dashboard/dashboard',
            [
                'data' => $data,
                'role' => $this->role,
            ]
        ) . view("template/footer");
    }


    /**
     * Get summary statistics for the dashboard.
     *
     * @return array
     */
    public function getSummaryStats()
    {
        try {
            $requestModel = new RequestModel();
            $propertyModel = new PropertyModel();
            $employeeModel = new EmployeeModel();

            $data = [];

            // For admin, get global stats
            if ($this->role === 'admin') {
                $data['total_requests'] = $requestModel->countAllResults();
                $data['pending_requests'] = $requestModel->where('request_state', 'Pending')->countAllResults();
                $data['total_properties'] = $propertyModel->countAllResults();
                $data['total_employees'] = $employeeModel->countAllResults();
            }
            // For regular employees, get only their relevant stats
            else {
                $data['total_requests'] = $requestModel->where('agent_id', $this->employee_id)->countAllResults();
                $data['pending_requests'] = $requestModel->where([
                    'agent_id' => $this->employee_id,
                    'request_state' => 'Pending'
                ])->countAllResults();
                $data['total_properties'] = $propertyModel->where('employee_id', $this->employee_id)->countAllResults();
                $data['total_employees'] = 0; // Regular employees don't see this, but we include it for consistency
            }

            // Add percentages or additional stats
            if ($data['total_requests'] > 0) {
                $data['pending_percentage'] = round(($data['pending_requests'] / $data['total_requests']) * 100);
            } else {
                $data['pending_percentage'] = 0;
            }

            return $data;
        } catch (\Exception $e) {

            return $data = [
                'total_requests' => 0,
                'pending_requests' => 0,
                'total_properties' => 0,
                'total_employees' => 0,
                'pending_percentage' => 0,
                'error' => $e->getMessage()
            ];
        }
    }
}
