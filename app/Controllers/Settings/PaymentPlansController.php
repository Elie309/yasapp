<?php

namespace App\Controllers\Settings;

use App\Controllers\BaseController;
use \App\Models\Settings\PaymentPlansModel;
use \CodeIgniter\Database\Exceptions\DatabaseException;

class PaymentPlansController extends BaseController
{

    public function index()
    {
        $session = service('session');

        $paymentPlansModel = new PaymentPlansModel();
        $paymentPlans = $paymentPlansModel->findAll();

        return view("template/header", ['role' => $session->get('role')]) .
            view('settings/payment-plans', ['paymentPlans' => $paymentPlans]) .
            view("template/footer");
    }

    public function addPaymentPlan()
    {

        $paymentPlansModel = new PaymentPlansModel();

        $data = [
            'payment_plan_name' => $this->request->getPost('payment_plan_name')
        ];

        if ($paymentPlansModel->save($data)) {
            return redirect()->to('/settings/payment-plans')->with('success', 'Payment plan added successfully');
        } else {
            return redirect()->to('/settings/payment-plans')->with('errors', $paymentPlansModel->errors());
        };
    }

    public function updatePaymentPlan()
    {

        $paymentPlansModel = new PaymentPlansModel();

        $data = [
            'payment_plan_name' => $this->request->getPost('payment_plan_name')
        ];

        if ($paymentPlansModel->update($this->request->getPost('payment_plan_id'), $data)) {
            return redirect()->to('/settings/payment-plans')->with('success', 'Payment plan updated successfully');
        } else {
            return redirect()->to('/settings/payment-plans')->with('errors', $paymentPlansModel->errors());
        };
    }

    public function deletePaymentPlan()
    {
        try {

            $paymentPlansModel = new PaymentPlansModel();

            if($paymentPlansModel->delete($this->request->getPost('payment_plan_id'))){
                return redirect()->to('/settings/payment-plans')->with('success', 'Payment plan deleted successfully');
            } else {
                return redirect()->to('/settings/payment-plans')->with('errors', $paymentPlansModel->errors());
            };

        } catch (DatabaseException $e) {
            return redirect()->back()->with('errors', ['Payment plan cannot be deleted']);
        }
    }
}
