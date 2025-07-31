<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="APIs For SRPHS",
 *    version="1.0.0",
 *    description="API documentation for SRPHS Management Information System"
 * ),
 * @OA\SecurityScheme(
 *    securityScheme="bearerAuth",
 *    in="header",
 *    name="bearerAuth",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="JWT"
 * )
 */

class DocumentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/mis/login",
     *     summary="Login user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="admin@gmail.com"),
     *             @OA\Property(property="password", type="string", example="123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials"
     *     )
     * ),

     * @OA\Get(
     *     path="/api/mis/school-years",
     *     summary="Get all school years",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all school years"
     *     )
     * ),
 
     * 
     * 
     * @OA\Post(
     *     path="/api/mis/school-years",
     *     summary="Create a new school year",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "start_date", "end_date"},
     *             @OA\Property(property="name", type="string", example="2025-2026"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-06-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2026-03-31")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="School year created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * ),
     * 
     * 
     * @OA\Put(
     *     path="/api/mis/school-years/{id}",
     *     summary="Update a specific school year",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "start_date", "end_date"},
     *             @OA\Property(property="name", type="string", example="2025-2026"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2025-06-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2026-03-31")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="School year updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="School year not found"
     *     )
     * ),
     * 
     * 
     * @OA\Delete(
     *     path="/api/mis/school-years/{id}",
     *     summary="Delete a school year",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="School year deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="School year not found"
     *     )
     * ),
     * 
     * 
     * @OA\Patch(
     *     path="/api/mis/school-years/set-active/{id}",
     *     summary="Set a school year as active",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Active school year set successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="School year not found"
     *     )
     * ),

     * @OA\Get(
     *     path="/api/mis/school-years/get-active",
     *     summary="Get the currently active school year",
     *     tags={"School Year"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Active school year data"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No active school year found"
     *     )
     * ),
     */
    public function index()
    {
        // Your logic here
    }
}
