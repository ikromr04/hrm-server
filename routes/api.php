<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LaborActivityController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
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
Route::get('/auth/login', [AuthController::class, 'check']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::delete('/auth/login', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/employees', [UserController::class, 'index']);
  Route::get('/employees/{id}', [UserController::class, 'show']);
  Route::put('/employees/{id}', [UserController::class, 'update']);

  // Route::put('/employees', [UserController::class, 'update']);
  // Route::put('/employees/{id}/avatar', [UserController::class, 'updateAvatar']);
  // Route::delete('/employees/{id}/avatar', [UserController::class, 'deleteAvatar']);
  // Route::put('/employees/{id}/languages', [UserController::class, 'updateLanguages']);

  // Route::get('/employees/{employeeId}/personal', [UserController::class, 'personalData']);
  // Route::put('/employees/{employeeId}/personal', [UserController::class, 'updatePersonalData']);
  // Route::get('/employees/{employeeId}/educations', [UserController::class, 'educations']);
  // Route::post('/employees/{employeeId}/educations', [UserController::class, 'storeEducation']);
  // Route::get('/employees/{employeeId}/activities', [UserController::class, 'activities']);
  // Route::post('/employees/{employeeId}/activities', [UserController::class, 'storeActivity']);

  // Route::put('/educations/{educationId}', [EducationController::class, 'update']);
  // Route::delete('/educations/{educationId}', [EducationController::class, 'delete']);

  // Route::put('/labor-activities/{activityId}', [LaborActivityController::class, 'update']);
  // Route::delete('/labor-activities/{activityId}', [LaborActivityController::class, 'delete']);

  Route::get('/jobs', [JobController::class, 'index']);

  // Route::get('/positions', [PositionController::class, 'index']);

  // Route::get('/languages', [LanguageController::class, 'index']);

});
