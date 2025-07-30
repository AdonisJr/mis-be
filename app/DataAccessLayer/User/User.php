<?php

namespace App\DataAccessLayer\User;

use App\Models\User as SystemUser;
use App\Models\Student as StudentUser;
use App\Utilities\Helper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User
{

    protected $helper;
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function authenticateStudent($email, $password)
    {
        $student = StudentUser::where('email', $email)->first();

        if (!$student || !Hash::check($password, $student->password)) {
            return response()->json(['statuscode' => 401, 'status' => 'Unauthorized', 'message' => 'Invalid credentials.'], 401);
        }

        $token = $this->helper->generateAuthToken($student);

        return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'Successfully logged in.', 'user' => $student, 'token' => $token], 200);
    }

    public function authenticateUser($request)
    {
        try {

            $email = $request['email'];
            $password = $request['password'];

            if (Auth::attempt(['email' => $email, 'password' => $password])) {

                $user = Auth::user();

                Log::error('User logged in: ' . $user);

                if ($user->isDeleted === 'Y') return response()->json(['statuscode' => 403, 'status' => 'Forbidden', 'message' => 'This user is deleted.'], 403);

                // if ($user->role === 'student') return response()->json(['statuscode' => 403, 'status' => 'Forbidden', 'message' => 'Students are not allowed to logged in.'], 403);

                $token = $this->helper->generateAuthToken($user);

                return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'Successfully logged in.', 'user' => $user, 'token' => $token], 200);
            }
            return $this->authenticateStudent($email, $password);
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 500, 'status' => 'failed', 'message' => $th->getMessage()]);
        }
    }
}
