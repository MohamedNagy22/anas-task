<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/login',[UserController::class,'login']);

Route::delete('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::get('/all-products', [ProductController::class, 'allProducts'])->middleware('auth:sanctum');
//http://127.0.0.1:8000/api/all-products                 //returning the pagination for displaying all products


