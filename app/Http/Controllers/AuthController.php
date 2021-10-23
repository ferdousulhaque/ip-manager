<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\RegistrationRequest;
use App\Http\Services\UserOperations;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Register new user
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {

        //validate incoming request 
        $this->validate($request, RegistrationRequest::rules());

        try {
            $userService = new UserOperations;
            $add = $userService->register($request);

            //return successful response
            return response()->json(['user' => $add, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }
}
