<?php

namespace App\Http\Controllers;

use App\Services\CreditPaymentService;
use Illuminate\Http\Request;
use Validator;

class CreditPaymentController extends Controller
{
    protected $service;

    public function __construct(CreditPaymentService $service)
    {
        $this->service = $service;
    }

    public function postMonthlyInstallment(Request $request)
    {
        Validator::make($request->input('formData'), [
            'credit_number' => 'required|integer|exists:credits',
            'monthly_installment' => 'required'
        ])->validate();

        $payment = $this->service->createMonthlyInstallment($request->input('formData'));
        
        return response()->json($payment->id, 201);
    }
}
