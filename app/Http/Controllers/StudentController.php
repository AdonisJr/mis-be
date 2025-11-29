<?php

namespace App\Http\Controllers;

use App\Events\AssignRfid;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class StudentController extends Controller
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return Student::all();
    }
    

    public function scanRfid(Request $request)
    {
        $uid = $request->input('rfid');

        // Check if any student is waiting for scan
        $studentId = Cache::get('student_waiting_for_scan');

        if (!$studentId) {
            return response()->json([
                'status' => 'error',
                'message' => 'No student listening'
            ]);
        }

        event(new AssignRfid());

        $student = Student::find($studentId);
        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ]);
        }

        // Save RFID to student
        $student->rfid = $uid;
        $student->save();

        // Clear the listener
        Cache::forget('student_waiting_for_scan');

        return response()->json([
            'status' => 'success',
            'message' => 'RFID saved',
            'student' => $student
        ]);
    }

    // Called by Admin
    public function requestRfidScan($studentId)
    {
        // Set listener for this student, expires after 30 seconds
        Cache::put('student_waiting_for_scan', $studentId, 30);

        return response()->json([
            'status' => 'success',
            'message' => 'Ready to scan RFID'
        ]);
    }
}
