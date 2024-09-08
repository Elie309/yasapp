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

    private $requestTypes = ['normal', 'urgent'];
    private $requestStates = ['pending', 'fulfilled', 'rejected', 'cancelled'];
    private $requestPriorities = ['low', 'medium', 'high'];
    private $requestVisibilities = ['public', 'private'];

    public function index()
    {

        $employee_id = $this->session->get('id');

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $requestModel = new RequestModel();

        $request = $this->_applyFilters($requestModel, $employee_id);

        $request = $request->paginate($rowsPerPage);

        $pager = $requestModel->pager;

        return view('template/header')
            . view('requests/requests', [
                'employee_id' => $employee_id,
                'requests' => $request,
                'requestTypes' => $this->requestTypes,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
                'requestVisibilities' => $this->requestVisibilities,
                'pager' => $pager
            ])
            . view('template/footer');
    }

    public function add()
    {


        $employee_id = $this->session->get('id');
        $name = $this->session->get('name');

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


        return view('template/header')
            . view('requests/saveRequest', [
                'method' => 'NEW_REQUEST',
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans,
                'requestTypes' => $this->requestTypes,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
                'requestVisibilities' => $this->requestVisibilities,
            ])
            . view('template/footer');
    }

    public function addRequest()
    {


        $employee_id = $this->session->get('id');

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

        $employee_id = $this->session->get('id');

        $requestModel = new RequestModel();

        if (empty($id) || empty($employee_id)) {
            return redirect()->back()->with('errors', ['Invalid request']);
        }

        $request = $requestModel->select(
            'requests.*,  clients.*,
            CONCAT(clients.client_firstname, " ", clients.client_lastname) AS client_name, 
            cities.city_name,
            payment_plans.payment_plan_name,
            CONCAT(requests.request_budget, " ", currencies.currency_symbol) AS request_fees,
            employees.employee_id,
            employees.employee_name,
            GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers'
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('phones', 'clients.client_id = phones.client_id')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->where('requests.request_id', $id);

        $request = $request->groupBy('requests.request_id')->first();
        if (!$request) {
            return redirect()->back()->with('errors', ['You are not allowed to view this request']);
        }

        // Check if the visibility is public
        if ($request->request_visibility !== 'public') {
            if ($request->employee_id !== $employee_id) {
                //Redirect to requests page
                return redirect()->to('/requests')->with('errors', ['You are not allowed to view this request']);
            }
        }


        return view('template/header')
            . view('requests/viewRequest', [
                'employee_id' => $employee_id,
                'request' => $request,
            ])
            . view('template/footer');
    }




    public function edit($id)
    {


        $employee_id = $this->session->get('id');
        $name = $this->session->get('name');

        $id = esc($id);

        $requestModel = new RequestModel();

        $request = $requestModel->select(
            'requests.*, clients.*,
            GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as client_phone,
            payment_plans.payment_plan_name,
            currencies.currency_symbol,
            employees.employee_id,
            employees.employee_name
            '
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('phones', 'clients.client_id = phones.client_id')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->groupStart()
            ->where('requests.request_id', $id)
            ->where('requests.employee_id', $employee_id)
            ->groupEnd()
            ->groupBy('requests.request_id')
            ->first();


        if (!$request) {
            return redirect()->back()->with('errors', ['You are not allowed to edit this request']);
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


        return view('template/header')
            . view('requests/saveRequest', [
                'method' => 'UPDATE_REQUEST',
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'city' => $city,
                'request' => $request,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans,
                'requestTypes' => $this->requestTypes,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
                'requestVisibilities' => $this->requestVisibilities,
            ])
            . view('template/footer');
    }


    public function updateRequest($id)
    {

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        try {
            $requestEntity->fill($this->request->getPost());

            $isValid = $requestEntity->isValid();
            if ($isValid !== true) {
                return redirect()->back()->withInput()->with('errors', [$isValid->getMessage()]);
            }

            if ($requestModel->update($id, $requestEntity)) {
                return redirect()->to('/requests');
            } else {
                return redirect()->back()->withInput()->with('errors', $requestModel->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['An error occurred']);
        }
    }


    public function delete($id)
    {
        $requestModel = new RequestModel();

        $request = $requestModel->find($id);

        if(!$request){
            return redirect()->back()->with('errors', ['Request not found']);
        }

        if($request->employee_id !== $this->session->get('id')){
            return redirect()->back()->with('errors', ['You are not allowed to delete this request']);
        }

        if ($requestModel->delete($id)) {
            return redirect()->to('/requests')->with('success', 'Request deleted successfully');
        } else {
            return redirect()->back()->with('errors', $requestModel->errors());
        }
    }

    public function export()
    {

        helper('excel');

        $employee_id = $this->session->get('id');

        $requestModel = new RequestModel();
        $requests = $this->_applyFilters($requestModel, $employee_id);

        $requests = $requests->findAll();

        $filename = 'requests_export_' . date('Ymd') . '.xlsx';
        $header = ['request_id' => 'Request ID', 
        'client_name' => 'Client Name', 
        'city_name' => 'City Name', 
        'payment_plan_name' => 'Payment Plan Name',
        'request_visibility' => 'Visibility',
        'request_budget' => 'Request Budget', 
        'request_type' => 'Request Type',
        'request_state' => 'Request State',
        'request_priority' => 'Request Priority',
        'employee_name' => 'Employee Name', 
        'comments'=> 'Comments',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
    ];

        export_to_excel($filename, $header, $requests);
    }

    private function _applyFilters($requestModel, $employee_id)
    {

        $search = esc($this->request->getVar('search'));

        $searchParam = esc($this->request->getVar('searchParam'));

        $requestTypeParam = esc($this->request->getVar('requestType'));

        $requestStateParam = esc($this->request->getVar('requestState'));

        $requestPriorityParam = esc($this->request->getVar('requestPriority'));

        $startDateParam = esc($this->request->getVar('startDate'));

        $endDateParam = esc($this->request->getVar('endDate'));

        $requestVisibilityParam = esc($this->request->getVar('requestVisibility'));

        $param = [
            'city_name' => 'cities.city_name',
            'client_name' => 'clients.client_firstname',
            'payment_plan_name' => 'payment_plans.payment_plan_name',
            'employee_name' => 'employees.employee_name',
            'request_budget' => 'requests.request_budget',
            'comments' => 'requests.comments'
        ];


        $request = $requestModel->select('requests.*,
                    CONCAT(clients.client_firstname, " ", clients.client_lastname) AS client_name, 
                    cities.city_name, 
                    payment_plans.payment_plan_name, 
                    CONCAT(FORMAT(requests.request_budget, 0), " ", currencies.currency_symbol) AS request_fees,
                    employees.employee_name
                    ')
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->groupStart()
            ->where('requests.employee_id', $employee_id)
            ->orWhere('requests.request_visibility', 'public')
            ->groupEnd()
            ->groupBy('requests.request_id');


        if (!empty($search) && !empty($searchParam) && isset($param[$searchParam])) {

            if ($searchParam === 'client_name') {
                $request = $request->like('clients.client_firstname', $search)
                    ->orLike('clients.client_lastname', $search);
            } else if ($searchParam === 'request_budget') {
                $search = str_replace(',', '', $search);
                $search = str_replace(' ', '', $search);

                if (!is_numeric($search)) {
                    return redirect()->back()->withInput()->with('errors', ['Invalid search value']);
                }

                $request = $request->where('requests.request_budget >=', $search);
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

        if (!empty($requestVisibilityParam)) {
            $request = $request->where('requests.request_visibility', $requestVisibilityParam);
        }


        return $request;
    }
}
