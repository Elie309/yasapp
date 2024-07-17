<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use App\Models\Settings\CurrenciesModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class CurrenciesController extends BaseController
{
    public function index()
    {
        $session = service('session');

        $currenciesModel = new CurrenciesModel();
        $currencies = $currenciesModel->findAll();

        return view("template/header", ['role' => $session->get('role')]) .
            view('settings/currencies', ['currencies' => $currencies]) .
            view("template/footer");
    }

    public function addCurrency()
    {

        $currenciesModel = new CurrenciesModel();

        $data = [
            'currency_name' => $this->request->getPost('currency_name'),
            'currency_code' => $this->request->getPost('currency_code'),
            'currency_symbol' => $this->request->getPost('currency_symbol'),
        ];

        if ($currenciesModel->save($data)) {
            return redirect()->to('/settings/currencies')->with('success', 'Currency added successfully');
        } else {
            return redirect()->to('/settings/currencies')->with('errors', $currenciesModel->errors());
        }
    }

    public function updateCurrency()
    {

        $currenciesModel = new CurrenciesModel();
        // Check if the currency if some field hasn't changed
        $currency = $currenciesModel->find($this->request->getPost('currency_id'));

        $data = [
            'currency_name' => $this->request->getPost('currency_name'),
            'currency_code' => $this->request->getPost('currency_code'),
            'currency_symbol' => $this->request->getPost('currency_symbol'),
        ];

        if ($currency->currency_name == $data['currency_name'] && $currency->currency_code == $data['currency_code'] && $currency->currency_symbol == $data['currency_symbol']) {
            return redirect()->to('/settings/currencies')->with('errors', ['No changes made']);
        }

        //Update each field if it has changed

        if ($currency->currency_name == $data['currency_name']) {
            unset($data['currency_name']);
        }

        if ($currency->currency_code == $data['currency_code']) {
            unset($data['currency_code']);
        }

        if ($currency->currency_symbol == $data['currency_symbol']) {
            unset($data['currency_symbol']);
        }

        if ($currenciesModel->update($this->request->getPost('currency_id'), $data)) {
            return redirect()->to('/settings/currencies')->with('success', 'Currency updated successfully');
        } else {
            return redirect()->to('/settings/currencies')->with('errors', $currenciesModel->errors());
        }

        
    }

    public function deleteCurrency()
    {
        try {

            $currenciesModel = new CurrenciesModel();

            if($currenciesModel->delete($this->request->getPost('currency_id'))){
                return redirect()->to('/settings/currencies')->with('success', 'Currency deleted successfully');
            } else {
                return redirect()->to('/settings/currencies')->with('errors', $currenciesModel->errors());
            };

        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Payment plan cannot be deleted']);
        }
    }
}
