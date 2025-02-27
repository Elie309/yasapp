<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use App\Models\Requests\RequestModel;

class RequestsChartsController extends BaseController
{

    public function requestsByStatus()
    {
        $model = new RequestModel();
        $data = $model->select('request_state, COUNT(*) AS total')
                      ->groupBy('request_state')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function requestsByPriority()
    {
        $model = new RequestModel();
        $data = $model->select('request_priority, COUNT(*) AS total')
                      ->groupBy('request_priority')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function requestsByCity()
    {
        $model = new RequestModel();
        $data = $model->select('ci.city_name, COUNT(requests.request_id) AS total_requests')
                      ->join('cities ci', 'requests.city_id = ci.city_id')
                      ->groupBy('ci.city_name')
                      ->orderBy('total_requests', 'DESC')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function requestsOverTime()
    {
        $model = new RequestModel();
        $data = $model->select('DATE(created_at) AS date, COUNT(*) AS total_requests')
                      ->groupBy('DATE(created_at)')
                      ->orderBy('date')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function averageRequestBudgetByPriority()
    {
        $model = new RequestModel();
        $data = $model->select('request_priority, AVG(request_budget) AS avg_budget')
                      ->groupBy('request_priority')
                      ->orderBy('avg_budget', 'DESC')
                      ->findAll();

        return $this->response->setJSON($data);
    }
}
