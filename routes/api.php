<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\SectorController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sector route
Route::get('/sectors',[SectorController::class,'index']);
Route::post('/sectors',[SectorController::class,'store']);
Route::get('/sectors/{id}/edit',[SectorController::class,'edit']);
Route::put('/sectors/{id}/update',[SectorController::class,'update']);
Route::delete('/sectors/{id}/delete',[SectorController::class,'destroy']);
// Task route
Route::get('/tasks',[TaskController::class,'index']);
Route::post('/tasks',[TaskController::class,'store']);
Route::get('/tasks/{id}/edit',[TaskController::class,'edit']);
Route::put('/tasks/{id}/update',[TaskController::class,'update']);
Route::delete('/tasks/{id}/delete',[TaskController::class,'destroy']);
