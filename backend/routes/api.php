<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\TaskAPIController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register',[AuthAPIController::class,'register']);
Route::post('login',[AuthAPIController::class,'login']);
Route::post('logout',[AuthAPIController::class,'logout'])
  ->middleware('auth:sanctum');

Route::get('tasks',[TaskAPIController::class,'index']);
Route::post('tasks',[TaskAPIController::class,'store']);
Route::get('tasks/{id}',[TaskAPIController::class,'show']);
Route::post('tasks/{id}',[TaskAPIController::class,'update']);
Route::delete('tasks/{id}',[TaskAPIController::class,'destroy']);