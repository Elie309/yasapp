<?php

namespace App\Controllers\Requests;

use App\Controllers\BaseController;
use App\Entities\Clients\ClientEntity;
use App\Entities\Clients\PhoneEntity;
use App\Entities\Requests\RequestEntity;
use App\Models\Clients\ClientModel;
use App\Models\Clients\PhoneModel;
use App\Models\Requests\RequestModel;
use App\Models\Settings\CurrenciesModel;
use App\Models\Settings\EmployeeModel;
use App\Models\Settings\Location\CityModel;
use App\Models\Settings\Location\CountryModel;
use App\Models\Settings\PaymentPlansModel;

use CodeIgniter\Database\Exceptions\DatabaseException;

class RequestController extends BaseController
{
    private $requestStates = ['pending', 'processing',  'on-hold', 'fulfilled', 'rejected', 'cancelled'];
    private $requestPriorities = ['low', 'medium', 'high'];

    public function index()
    {

        $employee_id = $this->session->get('id');

        $rowsPerPage = esc($this->request->getVar('rowsPerPage')) ?? 10;

        $requestModel = new RequestModel();

        if ($this->session->get('role') === 'admin') {
            $employeeModel = new EmployeeModel();
            $agents = $employeeModel->select('employee_id as agent_id, employee_name as agent_name')
                ->findAll();
        } else {
            $agents = [];
        }

        $request = $this->_applyFilters($requestModel, $employee_id);

        $request = $request->paginate($rowsPerPage);

        $pager = $requestModel->pager;

        return view('template/header')
            . view('requests/requests', [
                'employee_id' => $employee_id,
                'requests' => $request,
                'agents' => $agents,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
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

        $countries = new CountryModel();
        $countries = $countries->findAll();

        $employeeModel = new EmployeeModel();
        $agents = $employeeModel->select('employee_id as agent_id, employee_name as agent_name')
            ->findAll();

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
                'countries' => $countries,
                'agents' => $agents,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
            ])
            . view('template/footer');
    }

    public function addRequest()
    {


        $employee_id = $this->session->get('id');

        $clientModel = new ClientModel();
        $clientEntity = new ClientEntity();

        $phoneModel = new PhoneModel();

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        try {

            $clientEntity->fill($this->request->getPost());
            $phones = $this->request->getPost('phone_number');
            $countries = $this->request->getPost('country_id');
            $requestEntity->fill($this->request->getPost());
            $requestEntity->employee_id = $employee_id;


            $isValid = $requestEntity->isValid();
            if ($isValid !== true) {
                return redirect()->back()->withInput()->with('errors', [$isValid->getMessage()]);
            }


            try {
                //Begin transaction

                $this->db->transException(true)->transStart();
                //Save the client
                if (!$clientModel->save($clientEntity)) {
                    return redirect()->back()->withInput()->with('errors', $clientModel->errors());
                }

                $client_id = $clientModel->getInsertID();
                $requestEntity->client_id = $client_id;

                //Phone numbers

                if (
                    is_array($phones) && is_array($countries) && count($phones) == count($countries)
                    && count($phones) > 0 && count($countries) > 0
                ) {
                    foreach ($phones as $key => $phone) {
                        $phoneData = [
                            'client_id' => $client_id,
                            'country_id' => $countries[$key],
                            'phone_number' => $phone
                        ];

                        if (!$phoneModel->save($phoneData)) {
                            return redirect()->back()->withInput()->with('errors', $phoneModel->errors());
                        }
                    }
                }


                if ($requestModel->save($requestEntity)) {
                    $this->db->transCommit();
                    return redirect()->to('/requests')->with('success', 'Request added successfully');
                } else {
                    return redirect()->back()->withInput()->with('errors', $requestModel->errors());
                }
            } catch (DatabaseException $e) {
                return redirect()->back()->withInput()->with('errors', ['An error occurred']);
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
            agents.employee_id as agent_id,
            agents.employee_name as agent_name,
            GROUP_CONCAT(CONCAT(countries.country_code, phones.phone_number) SEPARATOR ", ") as phone_numbers,
            requests.created_at as request_created_at,
            requests.updated_at as request_updated_at
            '
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('phones', 'clients.client_id = phones.client_id')
            ->join('countries', 'countries.country_id = phones.country_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->join('employees as agents', 'requests.agent_id = agents.employee_id')
            ->where('requests.request_id', $id)
            ->groupBy('requests.request_id')
            ->first();


        if (!$request) {
            return redirect()->back()->with('errors', ['You are not allowed to view this request']);
        }


        if (
            $this->session->get('role') !== 'admin' &&
            $request->employee_id !== $employee_id &&
            $request->agent_id !== $employee_id
        ) {
            return redirect()->to('/requests')->with('errors', ['You are not allowed to view this request']);
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
            payment_plans.payment_plan_name,
            currencies.currency_symbol,
            employees.employee_id,
            employees.employee_name,
            agents.employee_id as agent_id,
            agents.employee_name as agent_name,
            '
        )
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->join('employees as agents', 'requests.agent_id = agents.employee_id')
            ->where('requests.request_id', $id)
            ->groupStart()
            ->where('requests.employee_id', $employee_id)
            ->orWhere('requests.agent_id', $employee_id)
            ->groupEnd()
            ->groupBy('requests.request_id')
            ->first();


        if (!$request) {
            return redirect()->back()->with('errors', ['You are not allowed to edit this request']);
        }

        $phoneModel = new PhoneModel();
        $phones = $phoneModel->select('phones.*')
            ->where('phones.client_id', $request->client_id)
            ->findAll();

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

        $countries = new CountryModel();
        $countries = $countries->findAll();

        $employeeModel = new EmployeeModel();
        $agents = $employeeModel->select('employee_id as agent_id, employee_name as agent_name')
            ->findAll();

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
                'agents' => $agents,
                'countries' => $countries,
                'city' => $city,
                'phones' => $phones,
                'request' => $request,
                'currencies' => $currencies,
                'paymentPlans' => $paymentPlans,
                'requestStates' => $this->requestStates,
                'requestPriorities' => $this->requestPriorities,
            ])
            . view('template/footer');
    }


    public function updateRequest($id)
    {

        $requestModel = new RequestModel();
        $requestEntity = new RequestEntity();

        $clientModel = new ClientModel();
        $clientEntity = new ClientEntity();
        $phoneModel = new PhoneModel();

        try {

            $clientEntity->fill($this->request->getPost());
            $phones = $this->request->getPost('phone_number');
            $countries = $this->request->getPost('country_id');
            $requestEntity->fill($this->request->getPost());

            $isValid = $requestEntity->isValid();
            if ($isValid !== true) {
                return redirect()->back()->withInput()->with('errors', [$isValid->getMessage()]);
            }


            try {

                $this->db->transException(true)->transStart();


                $request = $requestModel->find($id);

                if (!$request) {
                    $this->db->transRollback();
                    return redirect()->back()->with('errors', ['Request not found']);
                }

                if ($request->employee_id !== $this->session->get('id') && $request->agent_id !== $this->session->get('id')) {
                    $this->db->transRollback();
                    return redirect()->back()->with('errors', ['You are not allowed to edit this request']);
                }

                //Update the client
                if (!$clientModel->update($request->client_id, $clientEntity)) {
                    $this->db->transRollback();
                    return redirect()->back()->withInput()->with('errors', $clientModel->errors());
                }

                //Update the phone numbers
                if ($phoneModel->where('client_id', $request->client_id)->delete()) {

                    if (is_array($phones)) {

                        foreach ($phones as $key => $phone) {
                            $phoneData = [
                                'client_id' => $request->client_id,
                                'country_id' => $countries[$key],
                                'phone_number' => $phone
                            ];

                            if (!$phoneModel->save($phoneData)) {

                                $this->db->transRollback();
                                return redirect()->back()->withInput()->with('errors', $phoneModel->errors());
                            }
                        }
                    } else {
                        $this->db->transRollback();
                        return redirect()->back()->withInput()->with('errors', ['Invalid phone number']);
                    }
                }

                if ($requestModel->update($id, $requestEntity)) {
                    $this->db->transCommit();
                    return redirect()->to('/requests')->with('success', 'Request updated successfully');
                } else {
                    $this->db->transRollback();
                    return redirect()->back()->withInput()->with('errors', $requestModel->errors());
                }
            } catch (DatabaseException $e) {
                $this->db->transRollback();
                return redirect()->back()->withInput()->with('errors', ['An error occurred']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['An error occurred']);
        }
    }


    public function delete($id)
    {
        $requestModel = new RequestModel();

        $request = $requestModel->find($id);

        if (!$request) {
            return redirect()->back()->with('errors', ['Request not found']);
        }

        if ($request->employee_id !== $this->session->get('id') && $request->agent_id !== $this->session->get('id')) {
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
        $header = [
            'request_id' => 'Request ID',
            'client_name' => 'Client Name',
            'city_name' => 'City Name',
            'payment_plan_name' => 'Payment Plan Name',
            'request_budget' => 'Request Budget',
            'request_state' => 'Request State',
            'request_priority' => 'Request Priority',
            'employee_name' => 'Employee Name',
            'agent_name' => 'Agent Name',
            'comments' => 'Comments',
            'request_created_at' => 'Created At',
            'request_updated_at' => 'Updated At'
        ];

        export_to_excel($filename, $header, $requests);
    }

    private function _applyFilters($requestModel, $employee_id)
    {

        $search = esc($this->request->getVar('search'));

        $searchParam = esc($this->request->getVar('searchParam'));

        $requestStateParam = esc($this->request->getVar('requestState'));

        $requestPriorityParam = esc($this->request->getVar('requestPriority'));

        $startDateParam = esc($this->request->getVar('startDate'));

        $endDateParam = esc($this->request->getVar('endDate'));

        $agent = esc($this->request->getVar('agent'));

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
                    employees.employee_name,
                    agents.employee_name as agent_name,
                    requests.created_at as request_created_at,
                    requests.updated_at as request_updated_at
                    ')
            ->join('clients', 'requests.client_id = clients.client_id')
            ->join('cities', 'requests.city_id = cities.city_id')
            ->join('payment_plans', 'requests.payment_plan_id = payment_plans.payment_plan_id')
            ->join('currencies', 'requests.currency_id = currencies.currency_id')
            ->join('employees', 'requests.employee_id = employees.employee_id')
            ->join('employees as agents', 'requests.agent_id = agents.employee_id');

        if ($this->session->get('role') !== 'admin') {
            $request = $request->groupStart()
                ->where('requests.employee_id', $employee_id)
                ->orWhere('requests.agent_id', $employee_id)
                ->groupEnd();
        }

        $request = $request->groupBy('requests.request_id');


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

        if (!empty($agent)) {
            $request = $request->where('agents.employee_name', $agent);
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



        //Order by created_at
        $request = $request->orderBy('requests.created_at', 'DESC');


        return $request;
    }
}
