<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthController::class,'loginform']);
Route::post('login',[AuthController::class,'login'])->name('login');

Route::group(['prefix'=>'tasks','middleware'=>'auth'],function(){
    Route::get('/',[TaskController::class,'index'])->name('tasks.index');
    Route::get('create',[TaskController::class,'create'])->name('tasks.create');
    Route::post('store',[TaskController::class,'store'])->name('tasks.store');
    Route::get('{id}',[TaskController::class,'show'])->name('tasks.show');
    Route::get('{id}/edit',[TaskController::class,'edit'])->name('tasks.edit');
    Route::post('{id}',[TaskController::class,'update'])->name('tasks.update');
    Route::delete('{id}',[TaskController::class,'destroy'])->name('tasks.destroy');
});