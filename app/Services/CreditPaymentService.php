<?php

namespace App\Services;

use App\Jobs\NotifyUser;
use App\Models\Credit;
use App\Models\CreditPayment;

class CreditPaymentService
{
    public function createMonthlyInstallment($data)
    {
        $amount = data_get($data, 'monthly_installment');
        $credit = Credit::where('credit_number', data_get($data, 'credit_number'))->first();
        if ($amount > $credit->amount) {
            $amount = $credit->amount;
        }


        $payment = CreditPayment::create([
            'credit_number' => data_get($data, 'credit_number'),
            'monthly_installment' => $amount
        ]);

        NotifyUser::dispatch($payment);

        return $payment;
    }
}
