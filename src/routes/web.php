<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class, 'index']);
Route::post('/search', [ProductController::class, 'search']);
Route::get('/register', [ProductController::class, 'register']);
Route::post('/store', [ProductController::class, 'store']);
Route::get('/detail', [ProductController::class, 'detail']);
Route::post('/update', [ProductController::class, 'update']);
Route::post('/delete', [ProductController::class, 'delete']);