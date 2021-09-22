<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\BookController;
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

Route::get('/', [BookController::class, 'front_end']);
Route::get('fetch_books', [BookController::class, 'fetch_books'])->name('fetch_books');
Route::get('edit/{id}', [BookController::class, 'edit'])->name('edit/');
Route::put('update/{id}', [BookController::class, 'update'])->name('update/');
Route::delete('delete_book/{id}', [BookController::class, 'destroy'])->name('delete_book/');