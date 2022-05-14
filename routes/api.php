<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use App\Http\Controllers\Offre\OffreController;
use App\Http\Controllers\AuthApi\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Employeur\EmployeurController;
use App\Http\Controllers\OfferPostulatedController;
use App\Http\Controllers\OfferRejectedController;


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
Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//recommandation routes
Route::get('getRecommandedOffres/{id}', [EmployerController::class, 'getRecommandedOffresForUser']);
Route::get('getRecommandedOffresWithExperience/{id}', [EmployerController::class, 'getRecommandedOffresForUserWithExperience']);


//employers routes
Route::get('getEmployers', [EmployerController::class, 'getEmployers']);
Route::get('getUserEmail/{id}', [EmployerController::class, 'getUserEmail']);
Route::get('getEmployerByUserId/{id}', [EmployerController::class, 'getEmployerByUserID']);
Route::get('getEmployerByID/{id}', [EmployerController::class, 'getEmployerByID']);
Route::post('createEmployer', [EmployerController::class, 'createEmployer']);
Route::put('updateEmployer/{id}', [EmployerController::class, 'updateEmployer']);
Route::delete('deleteEmployer/{id}', [EmployerController::class, 'deleteEmployer']);
Route::get('downloadCvByEmployeID/{id}', [EmployerController::class, 'downloadCvByEmployeID']);


//candidate routes
Route::post('createCandidate', [EmployerController::class, 'createCandidate']);
Route::get('getCandidateByID/{id}', [EmployerController::class, 'getCandidateByID']);
Route::get('getCandidateByOffreID/{id}', [EmployerController::class, 'getCandidateByOffreID']);
Route::get('getCandidates', [EmployerController::class, 'getCandidates']);
Route::delete('deleteCandidate/{id}', [EmployerController::class, 'deleteCandidate']);
Route::post('validateCandidate', [EmployerController::class, 'validateCandidate']);

//offerRejected routes
Route::post('createOfferRejected', [OfferRejectedController::class, 'createOfferRejected']);
Route::get('getOfferRejectedByID/{id}', [OfferRejectedController::class, 'getOfferRejectedByID']);
Route::get('getOfferPostulatedByID/{id}', [OfferPostulatedController::class, 'getOfferPostulatedByID']);
Route::get('getOfferRejectedByEmployerID/{id}', [OfferRejectedController::class, 'getOfferRejectedByEmployerID']);
Route::get('getOfferRPostulatedByEmployerID/{id}', [OfferPostulatedController::class, 'getOfferRPostulatedByEmployerID']);
Route::get('getOffersRejected', [OfferRejectedController::class, 'getOffersRejected']);
Route::get('getOfferPostulatedByEmployerID/{id}', [OfferPostulatedController::class, 'getOfferPostulatedByEmployerID']);
Route::delete('deleteOfferRejected/{id}', [OfferRejectedController::class, 'deleteOfferRejected']);

//employeurs routes
Route::get('getEmployeurs', [EmployeurController::class, 'getEmployeurs']);
Route::get('getEmployeurByUserId/{id}', [EmployeurController::class, 'getEmployeurByUserID']);
Route::get('getRecommandedProfilsForOffer/{id}', [EmployeurController::class, 'getRecommandedProfilsForOffer']);
Route::get('getEmployeurByID/{id}', [EmployeurController::class, 'getEmployeurByID']);
Route::post('createEmployeur', [EmployeurController::class, 'createEmployeur']);
Route::put('updateEmployeur/{id}', [EmployeurController::class, 'updateEmployeur']);
Route::delete('deleteEmployeur/{id}', [EmployeurController::class, 'deleteEmployeur']);

//offres routes
Route::get('getOffres', [OffreController::class, 'getOffres']);
Route::get('getOffre/{id}', [OffreController::class, 'getOffreByID']);
Route::get('getOffresByEmployeurId/{id}', [OffreController::class, 'getOffresByEmployeurId']);
Route::post('createOffre', [OffreController::class, 'createOffre']);
Route::post('updateOffre/{id}', [OffreController::class, 'updateOffre']);
Route::delete('deleteOffre/{id}', [OffreController::class, 'deleteOffre']);
Route::get('findOffersByKeyWords/{keyWords}', [EmployerController::class, 'findOffersByKeyWords']);
Route::get('findEmployeByKeyWords/{keyWords}', [EmployerController::class, 'findEmployeByKeyWords']);

//file Routes
Route::get('downloadCV/{id}', [CvController::class, 'download']);
Route::post('uploadCv', [CvController::class, 'upload']);
Route::get('downloadImg', [CvController::class, 'downloadImg']);
Route::post('uploadImg', [CvController::class, 'uploadImg']);
