<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use App\Http\Controllers\Offre\OffreController;
use App\Http\Controllers\AuthApi\AuthController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employeur\EmployeurController;

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

//User Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//recommandation routes
Route::get('getRecommandedOffres/{id}', [EmployerController::class, 'getRecommandedOffresForUser']);

//employers routes
Route::get('getEmployers', [EmployerController::class, 'getEmployers']);
Route::get('getEmployer/{id}', [EmployerController::class, 'getEmployerByID']);
Route::post('createEmployer', [EmployerController::class, 'createEmployer']);
Route::put('updateEmployer/{id}', [EmployerController::class, 'updateEmployer']);
Route::delete('deleteEmployer/{id}', [EmployerController::class, 'deleteEmployer']);

//employeurs routes
Route::get('getEmployeurs', [EmployeurController::class, 'getEmployeurs']);
Route::get('getEmployeur/{id}', [EmployeurController::class, 'getEmployeurByID']);
Route::post('createEmployeur', [EmployeurController::class, 'createEmployeur']);
Route::put('updateEmployeur/{id}', [EmployeurController::class, 'updateEmployeur']);
Route::delete('deleteEmployeur/{id}', [EmployeurController::class, 'deleteEmployeur']);

//employeurs routes
Route::get('getOffres', [OffreController::class, 'getOffres']);
Route::get('getOffre/{id}', [OffreController::class, 'getOffreByID']);
Route::post('createOffre', [OffreController::class, 'createOffre']);
Route::put('updateOffre/{id}', [OffreController::class, 'updateOffre']);
Route::delete('deleteOffre/{id}', [OffreController::class, 'deleteOffre']);


//cv Routes
Route::get('cv/download', [CvController::class, 'download']);
Route::post('cv/upload', [CvController::class, 'upload']);
