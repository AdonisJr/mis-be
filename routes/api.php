<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix('mis')->group(function () {
    Route::get('/', function (Request $request) {
        return 'HELLO';
    });

    Route::post('/login', [AuthController::class, 'userLogin']);

    // middleware to allow authenticated access
    Route::group(['middleware' => ['auth-mis']], function () {

        // ✅ authenticated role based
        Route::middleware(['role:admin,registrar'])->group(function () {
            Route::get('/user', function (Request $request) {
                return $request->user();
            });
        });

        Route::middleware(['role:high_school'])->group(function () {
            Route::get('/userst', function (Request $request) {
                return $request->user();
            });
        });

        // role for college
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
