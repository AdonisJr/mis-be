<?php

namespace App\DataAccessLayer\Student;

use App\Utilities\Helper;

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
        try {

        }catch (\Throwable $th) {
            
        }
    }
}
