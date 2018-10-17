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

Route::get('/', 'PhotoController@index')->name('photos.index');

Route::resource('photos', 'PhotoController', ['except' => [
    'index',
]]);

Route::namespace('Uploads')->prefix('uploads')->group(function () {
    Route::get('photos/{photo}', 'PhotoController@show')->name('uploads.photos.show');
});

Route::get('terms', 'TermsController@show')->name('terms.show');

Auth::routes();
