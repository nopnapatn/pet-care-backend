<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PetController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::middleware(["auth:api"])->group(function () {

    Route::post('/rooms/booking', [BookingController::class, 'store']);
    Route::post('/pets/create-pet', [PetController::class, 'store']);

    // Route::get('/pets', [PetController::class, 'index']);
    // Route::get('/pets/{pet}', [PetController::class, 'show']);
    // Route::get('/pets/{pet}/edit', [PetController::class, 'edit']);
    // Route::put('/pets/{pet}', [PetController::class, 'update']);
    // Route::delete('/pets/{pet}', [PetController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
