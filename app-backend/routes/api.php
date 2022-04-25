<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\TreatmentController;
use App\Http\Controllers\API\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh'])->middleware('auth:sanctum');
        Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    });

    Route::resource('patients', PatientController::class)->middleware('auth:sanctum');

    Route::get('departments', [DepartmentController::class, 'index'])->middleware('auth:sanctum');

    Route::prefix('treatment')->middleware('auth:sanctum')->group(function () {
        Route::post('checkin', [TreatmentController::class, 'store']);
    });

    Route::prefix('reports')->middleware('auth:sanctum')->middleware('auth:sanctum')->group(function () {
        Route::get('departments', [ReportController::class, 'departments']);
        Route::post('', [ReportController::class, 'filter']);
    });

});
