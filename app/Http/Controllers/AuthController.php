<?php

namespace App\Http\Controllers;

use App\Enum\AuditEnum;
use App\Enum\StatusEnum;
use App\Events\LoginEvent;
use App\Http\Controllers\Requests\LoginRequest;
use App\Http\Controllers\Requests\RegistrationRequest;
use App\Http\Services\UserOperations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $userService = new UserOperations(new User);
            $add = $userService->register($request);

            //return successful response
            return response()->json(['user' => $add, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

    /**
     * Login with JWT
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, LoginRequest::rules());

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            event(new LoginEvent($request, AuditEnum::LOGIN_ACTIVITY, StatusEnum::FAIL));
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        event(new LoginEvent($request, AuditEnum::LOGIN_ACTIVITY, StatusEnum::SUCCESS));
        return $this->respondWithToken($token);
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }
}
