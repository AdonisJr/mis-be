<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataAccessLayer\User\User;
use App\Http\Requests\LoginFormRequest;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function userLogin(LoginFormRequest $request)
    {
        return $this->user->authenticateUser($request->validated(), 'user');
    }
}
