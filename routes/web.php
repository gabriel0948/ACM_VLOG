<?php

use App\Http\Controllers\PostController;
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



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/uploads', function () {
    return view('uploads');
})->name('upload');


Route::resource('posts', PostController::class);

Route::post('/submit-form', [PostController::class, 'StoredPost'])->name('submit.form');
