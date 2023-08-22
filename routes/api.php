<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function (){
    Route::post('/login', [AuthController::class, 'login']);

    //users
    Route::group((['prefix' => 'users']), function (){
      Route::get('/', [UserController::class, 'index'])->middleware(['auth:sanctum', 'ability:getUsers']);
      Route::get('/{id}', [UserController::class, 'show']); 
      Route::post('/', [UserController::class, 'store']);   
      Route::patch('/{id}', [UserController::class, 'update']); 
      Route::delete('/{id}', [UserController::class, 'destroy']); 
    });
    
    //apartments
    Route::group((['prefix' => 'apartments']), function (){
        Route::get('/', [ApartmentController::class, 'index']);
        Route::get('/{id}', [ApartmentController::class, 'show'])->middleware(['auth:sanctum', 'ability:getApartment']); 
        Route::post('/', [ApartmentController::class, 'store'])->middleware(['auth:sanctum', 'ability:createApartment']);   
        Route::patch('/{id}', [ApartmentController::class, 'update'])->middleware(['auth:sanctum', 'ability:editApartment']); 
        Route::delete('/{id}', [ApartmentController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteApartment']); 
      });
    //tenants
    Route::group((['prefix' => 'tenants']), function (){
    Route::get('/', [TenantController::class, 'index'])->middleware(['auth:sanctum', 'ability:getTenant']);
    Route::get('/{id}', [TenantController::class, 'show'])->middleware(['auth:sanctum', 'ability:getTenant']); 
    Route::post('/', [TenantController::class, 'store'])->middleware(['auth:sanctum', 'ability:createTenant']);   
    Route::patch('/{id}', [TenantController::class, 'update'])->middleware(['auth:sanctum', 'ability:editTenant']); 
    Route::delete('/{id}', [TenantController::class, 'destroy'])->middleware(['auth:sanctum', 'ability:deleteTenant']); 
    });

});

