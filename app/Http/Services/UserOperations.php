<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserOperations
{

    /**
     * Register User
     *
     * @param Request $request
     * @return User
     */
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        $user->save();
        return $user;
    }
}
