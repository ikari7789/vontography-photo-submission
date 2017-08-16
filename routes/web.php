<?php

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
    return redirect('photo-submissions');
});

Auth::routes();

Route::resource('photos', 'PhotoController', ['only' => [
    'show',
]]);

Route::resource('photo-submissions', 'PhotoSubmissionController', ['only' => [
    'index',
    'create',
    'store',
    'show',
    'destroy',
]]);
