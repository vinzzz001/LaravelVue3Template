<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
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
| POST = new resources. PUT updating resources.
|
*/

//These pages don't need the user to be signed in.
Route::put('auth/login', [AuthController::class, 'login']);
Route::put('auth/forgot', [AuthController::class, 'forgot']);
Route::put('auth/reset', [AuthController::class, 'reset']);

Route::get('tickets', [TicketController::class, 'index']);
Route::get('tickets/{ticket}', [TicketController::class, 'show']); //todo: use a resource here?

Route::get('users', [UserController::class, 'index']);
Route::get('responses', [ResponseController::class, 'index']);
Route::get('statuses', [StatusController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}',[CategoryController::class, 'show']);

//User Create function. Has a different name so as that the factorystore won't reach it.
 Route::post('users/create', [UserController::class, 'store']);

//Todo: Remove pages that do not require login.
//These pages require the user to be signed in.
Route::middleware(['auth'])->group(function () {
    // Login
    Route::get('auth/me', [AuthController::class, 'me']); //The user should be able to check if anyone is logged in, even if there isn't.
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::put('auth/refresh', [AuthController::class, 'refresh']);

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
    Route::put('categories/{category}/delete',[CategoryController::class, 'destroy']);

    //Notes
    Route::get('notes', [NoteController::class, 'index']);
    Route::post('notes/{ticket}', [NoteController::class, 'store']);

    //Users
    Route::get('users/{user}',[UserController::class, 'show']);
    Route::put('users/{user}',[UserController::class, 'update']);
    Route::delete('users/{user}',[UserController::class, 'destroy', ]);


});
