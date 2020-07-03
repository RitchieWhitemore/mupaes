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

Route::get('/information', 'ArticleController@information')->name('information');

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

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'auth',
        'namespace' => '\\Whitemore\\Menu\\Controllers',
    ],
    function () {
        Route::resource('menu', 'MenuController');
        Route::get('menu/create/{parent?}', 'MenuController@create')->name('menu.create');
        Route::post('menu/order', 'MenuController@updateOrder')->name('menu.order');
    }
);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/{category}', 'ArticleController@category')->name('category');

Route::get('/{category}/{page}', 'ArticleController@page')->name('page');
