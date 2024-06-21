<?php

namespace App\Http\Controllers;

use App\Services\CreditService;
use Illuminate\Http\Request;
use Validator;

class CreditController extends Controller
{
    protected $service;

    public function __construct(CreditService $service)
    {
        $this->service = $service;
    }
    public function postCredit(Request $request)
    {
        Validator::make($request->input('formData'), [
            'user_id' => 'required|exists:users,id|unique:credits',
            'amount' => 'required|integer|between:1,80000',
            'term' => 'required|integer|between:3,120'
        ], [
            'user_id.unique' => 'The user has already active credit.',
            'user_id.exists' => 'The user is not registered in our system.'
        ])->validate();

        $credit = $this->service->createCredit($request->input('formData'));

        return response()->json($credit, 201);
    }
    public function getCredits()
    {
        $credits = $this->service->fetchCredits();
        return response()->json($credits);
    }
}
