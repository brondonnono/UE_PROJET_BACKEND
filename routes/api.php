<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//employers routes
Route::get('getEmployers', 'App\Http\Controllers\Employer\EmployerController@getEmployers');
Route::get('getEmployer/{id}', 'App\Http\Controllers\Employer\EmployerController@getEmployerByID');
Route::post('createEmployer', 'App\Http\Controllers\Employer\EmployerController@createEmployer');
Route::put('updateEmployer/{id}', 'App\Http\Controllers\Employer\EmployerController@updateEmployer');
Route::delete('deleteEmployer/{id}', 'App\Http\Controllers\Employer\EmployerController@deleteEmployer');

//employeurs routes
Route::get('getEmployeurs', 'App\Http\Controllers\Employeur\EmployeurController@getEmployeurs');
Route::get('getEmployeur/{id}', 'App\Http\Controllers\Employeur\EmployeurController@getEmployeurByID');
Route::post('createEmployeur', 'App\Http\Controllers\Employeur\EmployeurController@createEmployeur');
Route::put('updateEmployeur/{id}', 'App\Http\Controllers\Employeur\EmployeurController@updateEmployeur');
Route::delete('deleteEmployeur/{id}', 'App\Http\Controllers\Employeur\EmployeurController@deleteEmployeur');

//employeurs routes
Route::get('getOffres', 'App\Http\Controllers\Offre\OffreController@getOffres');
Route::get('getOffre/{id}', 'App\Http\Controllers\Offre\OffreController@getOffreByID');
Route::post('createOffre', 'App\Http\Controllers\Offre\OffreController@createOffre');
Route::put('updateOffre/{id}', 'App\Http\Controllers\Offre\OffreController@updateOffre');
Route::delete('deleteOffre/{id}', 'App\Http\Controllers\Offre\OffreController@deleteOffre');


//cv Routes
Route::get('cv/download', 'App\Http\Controllers\CvController@download');
Route::post('cv/upload', 'App\Http\Controllers\CvController@upload');
