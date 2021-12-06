<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Mail;

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

Route::post('/login', [LoginController::class, 'login1'])->withoutMiddleware('smoking');

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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    Mail::to('congnv69@gmail.com')->send(new \App\Mail\AlertMail($details));

    dd("Email is Sent.");
})->withoutMiddleware('smoking');;
