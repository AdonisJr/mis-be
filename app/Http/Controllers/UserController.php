<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataAccessLayer\User\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // public function getUsers(Request $request)
    // {
    //     return $this->user->getUsers($request->all());
    // }

    public function getCurrentUserInfo(Request $request)
    {
        return $this->user->getCurrentUser($request);
    }
}
