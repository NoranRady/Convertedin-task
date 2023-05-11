<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Auth\AuthenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/authenticate', [AuthenticationController::class, 'authenticate']);

Route::middleware(['jwt.verify'])->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
});

Route::middleware(['jwt.verify'])->prefix('statistics')->group(function () {

    Route::get('/top-users-with-task-counts/{count}', [StatisticController::class, 'getTopUsersWithTaskCounts'])->where('count', 10);    
});