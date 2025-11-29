<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Handle RFID scan and save attendance.
     */
    public function scan(Request $request)
    {
        $request->validate([
            'rfid' => 'required|string',
        ]);

        $rfid = $request->input('rfid');

        // Find student by RFID
        $student = Student::where('rfid', $rfid)->first();

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        // Get current school year (adjust as needed)
        $schoolYearId = 1; // Example: you can fetch active school year from DB

        $today = Carbon::today();

        // Check if student already has an attendance record today
        $attendance = StudentAttendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYearId)
            ->whereDate('created_at', $today)
            ->first();

        $timeNow = Carbon::now()->format('H:i:s');

        if (!$attendance) {
            // First scan of the day -> mark time_in
            $attendance = StudentAttendance::create([
                'student_id' => $student->id,
                'school_year_id' => $schoolYearId,
                'time_in' => $timeNow,
                'status' => 'present',
            ]);
        } else {
            // Already scanned -> mark time_out
            $attendance->update([
                'time_out' => $timeNow,
            ]);
        }

        // Return student info and today's attendance
        return response()->json([
            'student' => $student,
            'attendance' => $attendance,
        ]);
    }
}
