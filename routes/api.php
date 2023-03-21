<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CancelPreviousRequest;

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

//These pages don't need the user to be signed in.
Route::post('login', [AuthController::class, 'login']);
Route::get('tickets', [TicketController::class, 'index']);
Route::get('tickets/{ticket}', [TicketController::class, 'show']);

Route::get('users', [UserController::class, 'index']);
Route::get('responses', [ResponseController::class, 'index']);
Route::get('statuses', [StatusController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}',[CategoryController::class, 'show']);



//Todo: Remove pages that do not require login.
//These pages require the user to be signed in.
Route::middleware(['auth'])->group(function () {
    // Login
    Route::get('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // Tickets
    Route::post('tickets',[TicketController::class, 'store']);
    Route::put('tickets/{ticket}',[TicketController::class, 'update']);
    Route::put('tickets/{ticket}/update-ticket-status', [TicketController::class, 'updateStatus']);
    Route::put('tickets/{ticket}/update-ticket-assignment', [TicketController::class, 'updateAssignedTo']);

    // Responses
    Route::post('responses/{ticket}', [ResponseController::class, 'store']);
    Route::put('responses/{ticket}/update', [ResponseController::class, 'update']);

    // Categories
    Route::post('categories',[CategoryController::class, 'store']);

    Route::put('categories/{category}',[CategoryController::class, 'update']);
    Route::delete('categories/{category}',[CategoryController::class, 'destroy']);

});
