<?php

namespace App\Cells\Settings\PaymentPlan;

use CodeIgniter\View\Cells\Cell;

class PaymentPlanCell extends Cell
{
    public $title = "Payment Plan";
    public $linkPostAdd = "/settings/payment-plans/add-payment-plan";
    public $linkPostEdit = "/settings/payment-plans/edit-payment-plan";
    public $linkPostDelete = "/settings/payment-plans/delete-payment-plan";

    public $selectedOptions = [];

    public $inputFormName = "payment_plan_name";
    public $inputFormId = "payment_plan_id";


}
