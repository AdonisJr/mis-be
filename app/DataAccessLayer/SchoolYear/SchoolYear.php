<?php

namespace App\DataAccessLayer\SchoolYear;

use App\Models\SchoolYear as SchoolYears;

use App\Utilities\Helper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SchoolYear
{

    public function getAllSchoolYear()
    {
        return SchoolYears::all();
    }

    public function createSchoolYear($request)
    {

        DB::beginTransaction();

        try {
            Log::info("message");
            $name = $request['name'];
            $active = $request['active'] ?? true;

            $schoolYear = SchoolYears::create([
                'name' => $name,
                'active' => $active
            ]);

            DB::commit();

            return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'School year created.', 'data' => $schoolYear], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 500, 'status' => 'failed', 'message' => $th->getMessage()]);
        }
    }

    public function updateSchoolYear($id, $request)
    {

        DB::beginTransaction();

        try {

            $schoolYear = SchoolYears::findOrFail($id);

            $name = $request['name'] ?? $schoolYear->name;
            $active = $request['active'] ?? $schoolYear->active;

            $schoolYear->update(['name' => $name, 'active' => $active,]);

            DB::commit();

            return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'School year updated.', 'data' => $schoolYear], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 500, 'status' => 'failed', 'message' => $th->getMessage()]);
        }
    }

    public function deleteSchoolYear($id)
    {
        DB::beginTransaction();

        try {

            $schoolYear = SchoolYears::findOrFail($id);

            // Check related records before deletion
            if (method_exists($schoolYear, 'classes') && $schoolYear->classes()->exists()) {
                return response()->json([
                    'statuscode' => 400,
                    'status' => 'failed',
                    'message' => 'Cannot delete this school year because it is linked to existing classes.'
                ], 400);
            }

            $schoolYear->delete();

            DB::commit();

            return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'School year deleted successfully.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 404, 'status' => 'error', 'message' => 'School year not found.'], 404);
        }
    }

    public function setActiveSchoolYear($id)
    {
        DB::beginTransaction();

        try {

            $schoolYear = SchoolYears::findOrFail($id);

            // update all to false
            SchoolYears::where('active', true)->update(['active' => false]);

            $schoolYear->update(['active' => true]);

            DB::commit();

            return response()->json(['statuscode' => 200, 'status' => 'success', 'message' => 'School year updated.', 'data' => $schoolYear], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 500, 'status' => 'failed', 'message' => $th->getMessage()]);
        }
    }

    public function getActiveSchoolYear()
    {
        try {
            $schoolYear = SchoolYears::where('active', true)->first();

            if (!$schoolYear) {

                return response()->json(['statuscode' => 404, 'status' => 'failed', 'message' => 'No active school year found.'], 404);
            }

            return response()->json(['statuscode' => 200, 'status' => 'success', 'data' => $schoolYear], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Error during user registration', ['error' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['statuscode' => 500, 'status' => 'failed', 'message' => $th->getMessage()]);
        }
    }
}
