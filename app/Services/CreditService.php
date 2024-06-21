<?php

namespace App\Services;

use App\Models\Credit;

class CreditService
{
    public function calculateMonthlyPayment($loan, $annualInterestRate, $months)
    {
        $monthlyInterestRate = $annualInterestRate / 12;
        $monthlyPayment = ($loan * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months)) / (pow(1 + $monthlyInterestRate, $months) - 1);
        return $monthlyPayment;
    }
    public function createCredit($data)
    {
        $credit = Credit::create([
            'user_id' => data_get($data, 'user_id'),
            'amount' => data_get($data, 'amount'),
            'term' => data_get($data, 'term')
        ]);
        return $credit->id;
    }
    public function fetchCredits()
    {
        $data = [];
        $interestRate = 0.079;
        $credits = Credit::select('id', 'user_id', 'credit_number', 'amount', 'term')
            ->with('user:id,name')
            ->get();

        foreach ($credits as $key => $credit) {
            $data[$key] = [];
            // FULL CREDIT NUMBER
            $creditNumber = data_get($credit, 'credit_number');
            $fullCreditNumber = str_pad($creditNumber, 7, '0', STR_PAD_LEFT);

            // CALCULATE MONTHLY INSTALLMENT
            $amount = data_get($credit, 'amount');
            $term = data_get($credit, 'term');
            $monthlyPayment = $this->calculateMonthlyPayment($amount, $interestRate, $term);
            $data[$key]['credit_number'] = $fullCreditNumber;
            $data[$key]['credit_id'] = $creditNumber;
            $data[$key]['borrower_name'] = data_get($credit, 'user.name');
            $data[$key]['amount'] = $amount;
            $data[$key]['term'] = $term;
            $data[$key]['monthly_installment'] = (float) number_format($monthlyPayment, 2,'.','');
        }
        return $data;
    }
}
