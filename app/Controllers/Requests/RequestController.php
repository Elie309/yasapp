<?php

namespace App\Controllers\Requests;

use App\Controllers\BaseController;
use App\Entities\Requests\RequestEntity;
use App\Models\Requests\RequestModel;
use App\Models\Settings\CurrenciesModel;
use App\Models\Settings\PaymentPlansModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Log\Logger;

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
        $searchParam = trim($searchParam);

        $param = [
            'city_name' => 'cities.city_name',
            'client_name' => 'clients.client_firstname',
            'payment_plan_name' => 'paymentplans.payment_plan_name',
            'currency_id' => 'currencies.currency_id',
            'employee_name' => 'employees.employee_name',
            'request_budget' => 'requests.request_budget',
            'request_state' => 'requests.request_state',
            'request_priority' => 'requests.request_priority',
            'request_type' => 'requests.request_type',
            'comments' => 'requests.comments'
        ];

        $requestModel = new RequestModel();

        $request = $requestModel->select('requests.request_id, requests.client_id, CONCAT(clients.client_firstname, " ", clients.client_lastname) AS client_name,, requests.city_id, cities.city_name, requests.payment_plan_id, paymentplans.payment_plan_name, requests.currency_id, currencies.currency_code, requests.employee_id, employees.employee_name, requests.request_budget, requests.request_state, requests.request_priority, requests.request_type, requests.comments, requests.created_at, requests.updated_at')
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('paymentplans', 'requests.payment_plan_id = paymentplans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->where('requests.employee_id', $employee_id);

        if (!empty($search) && !empty($searchParam) && isset($param[$searchParam])) {

            if ($searchParam === 'client_name') {
                log_message('error', 'Searching by client name');
                $request = $request->like('clients.client_firstname', $search)
                    ->orLike('clients.client_lastname', $search);
            } else {
                $request->like($param[$searchParam], $search);
            }
        }

        $request = $request->paginate($rowsPerPage);

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

        $paymentPlans = new PaymentPlansModel();
        $paymentPlans = $paymentPlans->findAll();

        //Transform the id and name
        $paymentPlans = array_map(function ($paymentPlan) {
            return [
                'id' => $paymentPlan->payment_plan_id,
                'name' => $paymentPlan->payment_plan_name
            ];
        }, $paymentPlans);


        return view('template/header', ['role' => $role])
            . view('requests/addRequest', [
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans
            ])
            . view('template/footer');
    }

    public function addRequest()
    {

        // Get posts element

        $session = service('session');

        $employee_id = $session->get('id');

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        try{


        $requestEntity->fill($this->request->getPost());
        $requestEntity->employee_id = $employee_id;


        $isValid = $requestEntity->isValid();
        if ($isValid !== true) {
            return redirect()->back()->withInput()->with('errors', [$isValid->getMessage()]);
        }


        if ($requestModel->save($requestEntity)) {
            return redirect()->to('/requests');
        } else {
            return redirect()->back()->withInput()->with('errors', $requestModel->errors());
        }

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['An error occurred']);
        }
    }
}
