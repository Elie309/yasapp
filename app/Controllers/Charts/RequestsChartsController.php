<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use App\Models\Requests\RequestModel;

class RequestsChartsController extends BaseController
{
    private $employee_id;

    public function __construct()
    {
        $this->employee_id = session()->get('id');
    }

    public function requestsByStatus()
    {
        try {
            $model = new RequestModel();
            $data = $model->select('request_state, COUNT(*) AS total')
                          ->where('agent_id', $this->employee_id)
                          ->groupBy('request_state')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function requestsByPriority()
    {
        try {
            $model = new RequestModel();
            $data = $model->select('request_priority, COUNT(*) AS total')
                          ->where('agent_id', $this->employee_id)
                          ->groupBy('request_priority')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function requestsByCity()
    {
        try {
            $model = new RequestModel();
            $data = $model->select('ci.city_name, COUNT(requests.request_id) AS total_requests')
                          ->join('cities ci', 'requests.city_id = ci.city_id')
                          ->where('requests.agent_id', $this->employee_id)
                          ->groupBy('ci.city_name')
                          ->orderBy('total_requests', 'DESC')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function requestsOverTime()
    {
        try {
            $model = new RequestModel();
            $data = $model->select('DATE(request_created_at) AS date, COUNT(*) AS total_requests')
                          ->where('agent_id', $this->employee_id)
                          ->groupBy('DATE(request_created_at)')
                          ->orderBy('date')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function averageRequestBudgetByPriority()
    {
        try {
            $model = new RequestModel();
            $data = $model->select('request_priority, AVG(request_budget) AS avg_budget')
                          ->where('agent_id', $this->employee_id)
                          ->groupBy('request_priority')
                          ->orderBy('avg_budget', 'DESC')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }
}
