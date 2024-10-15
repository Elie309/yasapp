<?php

namespace App\Entities\Settings;

use App\Models\Settings\PaymentPlansModel;
use CodeIgniter\Entity\Entity;

class PaymentPlansEntity extends Entity
{

    protected $datamap = [];
    // protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'payment_plan_id' => 'integer',
        'payment_plan_name' => 'string',
    ];


    public function getPaymentPlans(){

        //Get all payment plans
        $paymentPlansModel = new PaymentPlansModel();
        $paymentPlans = $paymentPlansModel->findAll();

        $paymentPlans = array_map(function ($paymentPlan) {
            return [
                'id' => $paymentPlan->payment_plan_id,
                'name' => $paymentPlan->payment_plan_name
            ];
        }, $paymentPlans);


        return $paymentPlans;

    }
}
