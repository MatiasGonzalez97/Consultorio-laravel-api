<?php

use App\Http\Controllers\DentistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::Resource('user', UserController::class)->except(['create','edit']);
Route::Resource('patient', PatientController::class)->except(['create','edit']);
Route::Resource('dentist', DentistController::class)->except(['create','edit']);
Route::Resource('treatments', TreatmentController::class)->except(['create','edit']);