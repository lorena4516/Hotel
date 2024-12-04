<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AuthController;


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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {  
    Route::get('hotels', [HotelController::class, 'index']); // Obtener lista de hoteles
    Route::get('hotels/{id}', [HotelController::class, 'show']); // Obtener un hotel específico
    Route::post('hotels', [HotelController::class, 'store']); // Crear un nuevo hotel
    Route::put('hotels/{id}', [HotelController::class, 'update']); // Actualizar un hotel
    Route::delete('hotels/{id}', [HotelController::class, 'destroy']); // Eliminar un hotel
    // Obtener los tipos de habitación
    Route::get('room-types', [RoomTypeController::class, 'index']);
    Route::get('room-types/{id}', [RoomTypeController::class, 'getByRoomType']);
    
    // Obtener las acomodaciones por tipo de habitación
    Route::get('accommodations/{roomTypeId}', [AccommodationController::class, 'getByRoomType']);
    Route::post('/assign-room-type', [AccommodationController::class, 'store']);
    
    // Asignar tipos de habitación y acomodaciones a un hotel
    Route::post('assign-room-type', [HotelController::class, 'assignRoomType']);
    

});


