<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PublicController::class, 'index']);

Route::get('/reports', [PublicController::class, 'search']);

Route::get('/create', [PublicController::class, 'create'])->middleware('auth');

Route::post('/create', [PublicController::class, 'store'])->middleware('auth');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'registerIndex'])->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/download', [DashboardController::class, 'download'])->middleware('auth');

Route::get('/admin/buildings', [DashboardController::class, 'buildingIndex'])->middleware('auth');

Route::get('/admin/rooms', [DashboardController::class, 'roomIndex'])->middleware('auth');

Route::get('/admin/users', [DashboardController::class, 'userIndex'])->middleware('auth');

Route::get('/activate', function () {
    Artisan::call('storage:link');
});
