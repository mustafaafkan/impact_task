<?php

namespace App\Http\Controllers;

use App\Services\RegisterService;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{
    protected $service;

    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }
    public function register(Request $request)
    {
        Validator::make($request->input('formData'), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users'
        ])->validate();

        $user = $this->service->register($request->input('formData'));

        return response()->json($user, 201);
    }
}
