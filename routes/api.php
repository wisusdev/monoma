<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\LeadController;
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

Route::post('/auth', LoginController::class);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/leads', [LeadController::class, 'index']);
    Route::apiResource('lead', LeadController::class)->only(['store', 'show']);
});
