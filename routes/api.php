<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('me', [AuthController::Class, 'me']);
    Route::get('logout', [AuthController::Class, 'logout']);
    Route::post('refresh', [AuthController::Class, 'refresh']);
});

Route::get('tickets', [TicketController::Class, 'index']);
Route::get('tickets/{ticket}', [TicketController::Class, 'show']);
Route::post('tickets',[TicketController::Class, 'store']);
// Route::get('tickets/create', [TicketController::Class, 'create']);


Route::get('users', [UserController::Class, 'index']);
Route::get('responses', [ResponseController::Class, 'index']);
Route::get('statuses', [StatusController::Class, 'index']);
Route::get('categories', [CategoryController::Class, 'index']);
