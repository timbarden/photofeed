<?php

use App\Http\Controllers\PhotosController;

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

Route::get('/', [PhotosController::class, 'index']);

// create routes for functions inside PhotosController
Route::resource('photos', 'PhotosController');
Auth::routes();

Route::get('/photos', 'PhotosController@index')->name('photos');