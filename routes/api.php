<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\BookController;

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

/*========== books route =============================================*/
Route::resource('v1/books/', BookController::class);
Route::get('v1/books/{book}', [BookController::class, 'show']);
Route::put('v1/books/{id}', [BookController::class, 'update']);
Route::delete('v1/books/{id}', [BookController::class, 'destroy']);
