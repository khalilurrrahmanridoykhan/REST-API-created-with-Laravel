<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::get('/apitest', function(){
    return 'this is api text only.';
});



Route::post('/user/regiser', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/studentget', [StudentController::class, 'index']);


Route::middleware('auth.session')->group(function(){
    Route::get('/studentget', [StudentController::class, 'index']);
    Route::post('/student/create', [StudentController::class, 'create']);
    Route::delete('student/delete/{id}', [StudentController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
});
