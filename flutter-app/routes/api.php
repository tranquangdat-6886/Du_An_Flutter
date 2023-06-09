<?php

use App\Http\Controllers\ApiController\AttendanceController;
use App\Http\Controllers\ApiController\EventController;
use App\Http\Controllers\ApiController\StudentController;
use App\Http\Controllers\ApiController\UserController as ApiControllerUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('students', StudentController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('attendances', AttendanceController::class);
Route::apiResource('users', ApiControllerUserController::class);