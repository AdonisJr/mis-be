<?php

namespace App\DataAccessLayer\Student;

use App\Utilities\Helper;

use App\Models\Student as StudentUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Student {
    protected $helper;

    public function __construct (Helper $helper){
        $this->helper = $helper;
    }

    public function authenticateStudent($email, $password) {
        $student = StudentUser::where('email', $email)->first();

        if (!$student || !Hash::check($password, $student->password)) {
            return response()->json(['statuscode' => 401, 'status' => 'Unauthorized', 'message' => 'Invalid credentials.'], 401);
        }

        $token = $this->helper->generateAuthToken($student);

        return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'Successfully logged in.', 'user' => $student, 'token' => $token], 200);
    }
}
