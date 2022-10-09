<?php

use App\Http\Controllers\Api\SmokerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SendMailController;

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

Route::post('/login', [LoginController::class, 'loginApp'])->withoutMiddleware('smoking');

//Api
Route::get('/1.0/smoker/schedule', [App\Http\Controllers\Api\SmokerController::class, 'getSchedule']);
Route::post('/1.0/smoker/schedule', [App\Http\Controllers\Api\SmokerController::class, 'postSchedule']);
Route::put('/1.0/smoker/schedule', [App\Http\Controllers\Api\SmokerController::class, 'updateSchedule']);

//push notification
Route::post('/1.0/smoker/save-device-token', [App\Http\Controllers\Api\SmokerController::class, 'saveDeviceToken']);
Route::post('/1.0/smoker/send-notification', [App\Http\Controllers\Api\SmokerController::class, 'sendNotification'])->name('send.notification');

Route::put('/1.0/ema/{id}/update', [App\Http\Controllers\Api\EmaController::class, 'update']);
Route::put('/1.0/ema/{id}/set-attempt', [App\Http\Controllers\Api\EmaController::class, 'setAttemptTime']);
Route::get('/1.0/ema/get-next-survey', [App\Http\Controllers\Api\EmaController::class, 'getSurvey']);
Route::put('/1.0/ema/{id}/delay', [App\Http\Controllers\Api\EmaController::class, 'delay']);
Route::get('/1.0/ema/check-valid-ema', [App\Http\Controllers\Api\EmaController::class, 'checkValidEma']);

Route::get('/1.0/incentive/finished', [App\Http\Controllers\Api\IncentiveController::class, 'finished']);
Route::get('/1.0/incentive/progress', [App\Http\Controllers\Api\IncentiveController::class, 'progress']);

//send mail

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('send-mail', [SendMailController::class, 'sendTest'])->withoutMiddleware('smoking');

//upload images
Route::post('/1.0/photo/upload', [App\Http\Controllers\Api\UploadController::class, 'upload']);

Route::put('/1.0/account/delete', [SmokerController::class, 'deleteAccount']);
