<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\RoomTypeController;
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

    // Route::post('/rooms/booking', [BookingController::class, 'store']);
    // Route::apiResource('payments', [PaymentController::class]);
    Route::post('/payments/store', [PaymentController::class, 'store']);


    Route::apiResource('booking-orders', BookingController::class);
    Route::get('booking-orders/{id}/my-bookings', [BookingController::class, 'myBookings']);
    Route::apiResource('booking', BookingController::class);
    Route::apiResource('booking-orders', BookingController::class);
    Route::apiResource('room-types', RoomTypeController::class);
    Route::post('room-types/{id}/book', [BookingController::class, 'store']);
    Route::post('booking-orders/{id}/check-out', [BookingController::class, 'checkOut']);
});

Route::get('room-types/cat-rooms', [RoomTypeController::class, 'getCatRooms']);
Route::get('room-types/dog-rooms', [RoomTypeController::class, 'getDogRooms']);
Route::apiResource('room-types', RoomTypeController::class);

Route::put(
    'room-types/{room_type}/in-use',
    [RoomTypeController::class, 'setInUseStatus']
)->name('room-types.in-use');

Route::put(
    'room-types/{room_type}/maintenance',
    [RoomTypeController::class, 'setMaintenanceStatus']
)->name('room-types.maintenance');

Route::post(
    'room-types/image-catalogues',
    [RoomTypeController::class, 'multipleUpload']
)->name('room-types.image-catalogues.store');

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
