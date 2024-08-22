<?php

namespace App\Controllers\Requests;

use App\Controllers\BaseController;
use App\Models\Requests\RequestModel;
use App\Models\Settings\CurrenciesModel;
use CodeIgniter\HTTP\ResponseInterface;

class RequestController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $search = esc($this->request->getVar('search'));
        $search = trim($search);

        $searchParam = esc($this->request->getVar('searchParam'));

        $param = [
            'client_id' => 'requests.client_id',
            'location_id' => 'requests.location_id',
            'payment_plan_id' => 'requests.payment_plan_id',
            'currency_id' => 'requests.currency_id',
            'employee_id' => 'requests.employee_id',
            'request_budget' => 'requests.request_budget',
            'request_state' => 'requests.request_state',
            'request_priority' => 'requests.request_priority',
            'request_type' => 'requests.request_type',
            'comments' => 'requests.comments'
        ];

        $requestModel = new RequestModel();

        $request = $requestModel->select('request_id, client_id, location_id, payment_plan_id, currency_id, employee_id, request_budget, request_state, request_priority, request_type, comments, created_at, updated_at')
            ->where('employee_id', $employee_id)
            ->paginate($rowsPerPage);

        $pager = $requestModel->pager;



        return view('template/header', ['role' => $role])
            . view('requests/requests', ['employee_id' => $employee_id, 'requests' => $request, 'pager' => $pager])
            . view('template/footer');
    }

    public function add()
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');
        $name = $session->get('name');

        $currencyModel = new CurrenciesModel();
        $currencies = $currencyModel->findAll();


        return view('template/header', ['role' => $role])
        . view('requests/addRequest', ['employee_id' => $employee_id, 'employee_name' => $name, 'currencies' => $currencies])
        . view('template/footer');
    }
}
