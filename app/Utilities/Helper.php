<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Crypt;
use App\Models\User as SystemUser;


class Helper{
    public function generateAuthToken($user)
    {
        $token = $user->createToken('AuthToken')->plainTextToken;

        $mixer = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 5);

        return Crypt::encryptString($token.$mixer);
    }
}