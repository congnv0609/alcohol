<?php

use App\Http\Controllers\Cms\IncentiveController;
use App\Http\Controllers\Cms\EmaController;
use App\Http\Controllers\Cms\SmokerController;
use App\Http\Controllers\Cms\ExportController;
use App\Http\Controllers\DeployController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::post('/login', [LoginController::class, 'login'])->withoutMiddleware('jwt.auth');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/refresh', [LoginController::class, 'refresh'])->middleware('jwt.refresh');

Route::get('/smokers/list', [SmokerController::class, 'list']);
Route::get('/smokers/detail/{id}', [SmokerController::class, 'detail']);
Route::put('/smokers/update/{id}', [SmokerController::class, 'updateSchedule']);
Route::get('/smokers/overview/user/{id}', [SmokerController::class, 'overview']);

Route::get('/incentive/list', [IncentiveController::class, 'list']);

//ema
Route::get('/ema/list', [EmaController::class, 'index']);

//export excel
Route::get('/smokers/export', [ExportController::class, 'export']);
Route::get('/smokers/export-personal/{id}', [ExportController::class, 'exportPersonal']);

//deploy api
Route::get('/deploy', [DeployController::class, 'index']);
