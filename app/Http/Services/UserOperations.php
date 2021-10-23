<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserOperations
{

    private $user;

    /**
     * @param User
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Register User
     *
     * @param Request $request
     * @return User
     */
    public function register(Request $request)
    {
        $this->user->name = $request->input('name');
        $this->user->email = $request->input('email');
        $plainPassword = $request->input('password');
        $this->user->password = app('hash')->make($plainPassword);

        $this->user->save();
        return $this->user;
    }
}
