<?php

namespace App\Controllers\Requests;

use App\Controllers\BaseController;
use App\Entities\Requests\RequestEntity;
use App\Models\Requests\RequestModel;
use App\Models\Settings\CurrenciesModel;
use App\Models\Settings\Location\CityModel;
use App\Models\Settings\PaymentPlansModel;

class RequestController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $search = esc($this->request->getVar('search'));

        $searchParam = esc($this->request->getVar('searchParam'));

        $requestTypeParam = esc($this->request->getVar('requestType'));

        $requestStateParam = esc($this->request->getVar('requestState'));

        $requestPriorityParam = esc($this->request->getVar('requestPriority'));

        $startDateParam = esc($this->request->getVar('startDate'));

        $endDateParam = esc($this->request->getVar('endDate'));

        $param = [
            'city_name' => 'cities.city_name',
            'client_name' => 'clients.client_firstname',
            'payment_plan_name' => 'paymentplans.payment_plan_name',
            'employee_name' => 'employees.employee_name',
            'request_budget' => 'requests.request_budget',
            'comments' => 'requests.comments'
        ];

        $requestModel = new RequestModel();

        $request = $requestModel->select('requests.request_id, requests.client_id, CONCAT(clients.client_firstname, " ", clients.client_lastname) AS client_name, requests.city_id, cities.city_name, requests.payment_plan_id, paymentplans.payment_plan_name, requests.currency_id, CONCAT(requests.request_budget, " ", currencies.currency_symbol) AS request_fees, requests.employee_id, employees.employee_name, requests.request_state, requests.request_priority, requests.request_type, requests.comments, requests.created_at, requests.updated_at')
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('paymentplans', 'requests.payment_plan_id = paymentplans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->where('requests.employee_id', $employee_id);

        if (!empty($search) && !empty($searchParam) && isset($param[$searchParam])) {

            if ($searchParam === 'client_name') {
                $request = $request->like('clients.client_firstname', $search)
                    ->orLike('clients.client_lastname', $search);
            } else {
                $request->like($param[$searchParam], $search);
            }
        }

        if (!empty($requestTypeParam)) {
            $request = $request->where('requests.request_type', $requestTypeParam);
        }

        if (!empty($requestStateParam)) {
            $request = $request->where('requests.request_state', $requestStateParam);
        }

        if (!empty($requestPriorityParam)) {
            $request = $request->where('requests.request_priority', $requestPriorityParam);
        }

        if (!empty($startDateParam)) {
            $request = $request->where('requests.created_at >=', $startDateParam);
        }

        if (!empty($endDateParam)) {
            $request = $request->where('requests.created_at <=', $endDateParam);
        }


        $request = $request->paginate($rowsPerPage);

        $pager = $requestModel->pager;

        $requestTypes = ['normal', 'urgent'];
        $requestStates = ['pending', 'fulfilled', 'rejected', 'cancelled'];
        $requestPriorities = ['low', 'medium', 'high'];


        return view('template/header', ['role' => $role])
            . view('requests/requests', [
                'employee_id' => $employee_id,
                'requests' => $request,
                'requestTypes' => $requestTypes,
                'requestStates' => $requestStates,
                'requestPriorities' => $requestPriorities,
                'pager' => $pager
            ])
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
            . view('requests/saveRequest', [
                'method' => 'NEW_REQUEST',
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans
            ])
            . view('template/footer');
    }

    public function addRequest()
    {

        $session = service('session');

        $employee_id = $session->get('id');

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        try {


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
            return redirect()->back()->withInput()->with('errors', ['An error occurred']);
        }
    }

    public function view($id)
    {
        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');

        $requestModel = new RequestModel();

        if (empty($id) || empty($employee_id)) {
            return redirect()->back();
        }

        $request = $requestModel->select(
            'requests.request_id, requests.client_id, 
            CONCAT(clients.client_firstname, " ", clients.client_lastname) AS client_name, 
            clients.client_email,
            requests.city_id, cities.city_name, requests.payment_plan_id, 
            paymentplans.payment_plan_name, requests.currency_id, 
            CONCAT(requests.request_budget, " ", currencies.currency_symbol) AS request_fees,
            requests.employee_id, employees.employee_name, requests.request_state, 
            requests.request_priority, requests.request_type, requests.comments, 
            requests.created_at, requests.updated_at, 
            GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers'
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('phones', 'clients.client_id = phones.client_id')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('paymentplans', 'requests.payment_plan_id = paymentplans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->groupStart()
            ->where('requests.request_id', $id)
            ->where('requests.employee_id', $employee_id)
            ->groupEnd()
            ->groupBy('requests.request_id')
            ->first();

        if (!$request) {
            return redirect()->back();
        }

        return view('template/header', ['role' => $role])
            . view('requests/viewRequest', [
                'employee_id' => $employee_id,
                'request' => $request,
            ])
            . view('template/footer');
    }




    public function edit($id)
    {

        $session = service('session');

        $role = $session->get('role');
        $employee_id = $session->get('id');
        $name = $session->get('name');

        $id = esc($id);

        $requestModel = new RequestModel();

        $request = $requestModel->select(
            'requests.*, clients.*,
            GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as client_phone,
            paymentplans.payment_plan_name,
            currencies.currency_symbol,
            employees.employee_name
            '
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('phones', 'clients.client_id = phones.client_id')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->join('paymentplans', 'requests.payment_plan_id = paymentplans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->groupStart()
            ->where('requests.request_id', $id)
            ->where('requests.employee_id', $employee_id)
            ->groupEnd()
            ->groupBy('requests.request_id')
            ->first();
        

        if (!$request) {
            return redirect()->back();
        }

        //Get the country, region and subregion to the city id
        $cityModel = new CityModel();

        $city = $cityModel->select('cities.*, subregions.subregion_name, regions.region_name, countries.country_name')
            ->join('subregions', 'cities.subregion_id = subregions.subregion_id')
            ->join('regions', 'subregions.region_id = regions.region_id')
            ->join('countries', 'regions.country_id = countries.country_id')
            ->where('cities.city_id', $request->city_id)
            ->first();


        $currencyModel = new CurrenciesModel();
        $currencies = $currencyModel->findAll();

        $paymentPlans = new PaymentPlansModel();
        $paymentPlans = $paymentPlans->findAll();

        $paymentPlans = array_map(function ($paymentPlan) {
            return [
                'id' => $paymentPlan->payment_plan_id,
                'name' => $paymentPlan->payment_plan_name
            ];
        }, $paymentPlans);


        return view('template/header', ['role' => $role])
            . view('requests/saveRequest', [
                'method' => 'UPDATE_REQUEST',
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'city' => $city,
                'request' => $request,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans
            ])
            . view('template/footer');
    }


    public function updateRequest()
    {

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        try {

            $requestEntity->fill($this->request->getPost());

            $isValid = $requestEntity->isValid();
            if ($isValid !== true) {
                return redirect()->back()->withInput()->with('errors', [$isValid->getMessage()]);
            }

            if ($requestModel->update($requestEntity->request_id, $requestEntity)) {
                return redirect()->to('/requests');
            } else {
                return redirect()->back()->withInput()->with('errors', $requestModel->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['An error occurred']);
        }
    }
}
