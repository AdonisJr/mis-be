<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/scan', [AttendanceController::class, 'scan']);
Route::post('/rfid/scan', [RfidController::class, 'requestRfid']);

Route::prefix('mis')->group(function () {
    Route::get('/', function (Request $request) {
        return 'HELLO';
    });

    Route::post('/login', [AuthController::class, 'userLogin']);

    // middleware to allow authenticated access
    Route::group(['middleware' => ['auth-mis']], function () {

        // ✅ authenticated role based

        // Route::middleware(['role:admin'])->group(function () {
        //     Route:
        // });

        Route::middleware(['role:admin,registrar'])->group(function () {
            Route::get('/user', function (Request $request) {
                return $request->user();
            });

            // School year
            Route::get('/school-years', [SchoolYearController::class, 'index']);
            Route::post('/school-years', [SchoolYearController::class, 'create']);
            Route::put('/school-years/{id}', [SchoolYearController::class, 'update']);
            Route::delete('/school-years/{id}', [SchoolYearController::class, 'delete']);
            Route::put('/school-years/set-active/{id}', [SchoolYearController::class, 'setActiveSchoolYear']);
            Route::get('/school-years/get-active', [SchoolYearController::class, 'getActiveSchoolYear']);

            // students
            Route::get('/students', [StudentController::class, 'index']);
            Route::get('/students/{id}', [StudentController::class, 'updateStudent']);
            Route::put('/students/rfid/{id}', [StudentController::class, 'updateStudentRfid']);

            // User
            Route::get('/getCurrentUserInfo', [UserController::class, 'getCurrentUserInfo']);

            //RFID Channel Management
            Route::post('/rfid/open', [RfidController::class, 'openRfidChannel']);
            Route::post('/rfid/close', [RfidController::class, 'closeRfidChannel']);
        });

        // high school students
        Route::middleware(['role:high_school'])->group(function () {
            Route::get('/userst', function (Request $request) {
                return $request->user();
            });
        });

        // college students
        Route::middleware(['role:college'])->group(function () {
            Route::get('/usersCollege', function (Request $request) {
                return $request->user();
            });
        });

        Route::get('/users', function (Request $request) {
            return $request->user();
        });
    });
});

//Route for Document API

Route::get('/home',[DocumentController::class,'index']);
Broadcast::routes();
