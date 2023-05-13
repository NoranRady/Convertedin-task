<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StatisticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    
    Route::middleware(['auth.session'])->prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'show'])->name('tasks.index');
        Route::get('/create', [TaskController::class, 'store'])->name('tasks.create');
    });

    Route::get('/statistics', [StatisticsController::class, 'statistics'])->name('tasks.statistics');
});