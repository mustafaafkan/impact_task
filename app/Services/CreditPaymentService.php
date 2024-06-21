<?php

namespace App\Services;

use App\Jobs\NotifyUser;
use App\Models\CreditPayment;

class CreditPaymentService
{
    public function createMonthlyInstallment($data)
    {
        $amount = data_get($data, 'monthly_installment');
        

        $payment = CreditPayment::create([
            'credit_number' => data_get($data, 'credit_number'),
            'monthly_installment' => data_get($data, 'monthly_installment')
        ]);

        NotifyUser::dispatch($payment);

        return $payment;
    }
}
