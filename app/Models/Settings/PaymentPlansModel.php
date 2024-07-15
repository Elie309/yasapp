<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class PaymentPlansModel extends Model
{

    // -- PaymentPlans TABLE
    // payment_plan_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    // payment_plan_name VARCHAR(255) NOT NULL UNIQUE

    protected $table            = 'PaymentPlans';
    protected $primaryKey       = 'payment_plan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Settings\PaymentPlansEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["payment_plan_id", "payment_plan_name"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];



    // Validation
    protected $validationRules = [
        'payment_plan_name' => 'required|is_unique[paymentplans.payment_plan_name]',
    ];

    protected $validationMessages = [
        'payment_plan_name' => [
            'required' => 'The payment plan name is required.',
            'is_unique' => 'The payment plan name must be unique.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
