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

Route::get('/', 'DefaultController@index')->name('index');

Route::get('/contacts', 'DefaultController@contacts')->name('contacts');

Route::get('/information', 'DefaultController@information')->name('information');

Auth::routes();

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('categories', 'CategoryController');
        Route::resource('pages', 'PageController');
        Route::put('pages/{page}/upload', 'PageController@upload')->name('page.upload');
        Route::get('pages/{page}/upload', 'PageController@getFiles')->name('page.files');
        Route::delete('pages/upload/{file}', 'PageController@deleteFile')->name('page.deleteFile');
    }
);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
