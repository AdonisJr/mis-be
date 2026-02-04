<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataAccessLayer\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StudentFormRequest;

class StudentController extends Controller
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        $id = Auth::user()->id; // sample to get current user id
        // return Student::where('id', '!=', $id )->get();
        return $this->student->getAllStudents();
    }

    public function updateStudent($id, StudentFormRequest $request)
    {
        return $this->student->updateStudent($id, $request);
    }

    public function updateStudentRfid($id, Request $request)
    {
        $validated = $request->validate([
            'rfid' => 'required|string|max:255',
        ]);

        return $this->student->studentRfidUpdate($id, $validated['rfid']);
    }
}
