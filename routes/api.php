<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationController;
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
  Route::get('/employees/{id}/educations', [UserController::class, 'educations']);
  Route::get('/employees/{id}/activities', [UserController::class, 'activities']);
  Route::get('/employees/{id}/equipments', [UserController::class, 'equipments']);

  Route::get('/jobs', [JobController::class, 'index']);

  Route::get('/positions', [PositionController::class, 'index']);

  Route::get('/languages', [LanguageController::class, 'index']);

  Route::get('/departments', [DepartmentController::class, 'index']);
  Route::get('/departments/tree', [DepartmentController::class, 'tree']);

  Route::group(['middleware' => ['abilities:admin']], function () {
    Route::post('/employees', [UserController::class, 'store']);
    Route::post('/employees/export', [UserController::class, 'export']);
    Route::put('/employees/{id}', [UserController::class, 'update']);
    Route::put('/employees/{id}/avatar', [UserController::class, 'updateAvatar']);
    Route::delete('/employees/{id}/avatar', [UserController::class, 'deleteAvatar']);

    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{id}', [JobController::class, 'update']);
    Route::delete('/jobs/{id}', [JobController::class, 'delete']);

    Route::post('/positions', [PositionController::class, 'store']);
    Route::put('/positions/{id}', [PositionController::class, 'update']);
    Route::delete('/positions/{id}', [PositionController::class, 'delete']);

    Route::post('/languages', [LanguageController::class, 'store']);
    Route::put('/languages/{id}', [LanguageController::class, 'update']);
    Route::delete('/languages/{id}', [LanguageController::class, 'delete']);

    Route::post('/departments', [DepartmentController::class, 'store']);
    Route::put('/departments/{id}', [DepartmentController::class, 'update']);
    Route::delete('/departments/{id}', [DepartmentController::class, 'delete']);

    Route::post('/educations', [EducationController::class, 'store']);
    Route::put('/educations/{id}', [EducationController::class, 'update']);
    Route::delete('/educations/{id}', [EducationController::class, 'delete']);

    Route::post('/activities', [ActivityController::class, 'store']);
    Route::put('/activities/{id}', [ActivityController::class, 'update']);
    Route::delete('/activities/{id}', [ActivityController::class, 'delete']);

    Route::get('/equipments', [EquipmentController::class, 'get']);
    Route::post('/equipments', [EquipmentController::class, 'store']);
    Route::put('/equipments/{id}', [EquipmentController::class, 'update']);
    Route::delete('/equipments/{id}', [EquipmentController::class, 'delete']);

    Route::get('/vacations', [VacationController::class, 'get']);
    Route::put('/vacations', [VacationController::class, 'update']);
  });
});
