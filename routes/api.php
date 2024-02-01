<?php

use App\Http\Controllers\APIController;
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

Route::get('/rooms/{id}', [APIController::class, 'fetchRooms']);

Route::get('/reports/{id}', [APIController::class, 'getReport']);

Route::put('/reports/{id}', [APIController::class, 'editReport']);

Route::post('/buildings', [APIController::class, 'createBuilding']);

Route::delete('/buildings/{id}', [APIController::class, 'destroyBuilding']);

Route::post('/rooms', [APIController::class, 'createRoom']);

Route::delete('/rooms/{id}', [APIController::class, 'destroyRoom']);

Route::delete('/users/{id}', [APIController::class, 'destroyUser']);


