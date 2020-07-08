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

use App\Models\Page;

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

        Route::get('categories/items', 'CategoryController@items')->name('category.items');
        Route::resource('categories', 'CategoryController');

        Route::get('pages/items', 'PageController@items')->name('page.items');
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

/*Route::get('/{category}', 'ArticleController@category')->name('category');

Route::get('/{category}/{page}', 'ArticleController@page')->name('page');*/

Route::group(
    [
        'namespace' => '\\Whitemore\\Menu\\Controllers',
    ],
    function () {
        //Route::get('/{menu1}/{menu2?}/{menu3?}/{menu4?}/{menu5?}', 'MenuController@item');
        //Route::get('/{path?}', 'MenuController@item')->name('menu.item')->where('path', '.+');

        Route::get('/{path?}', function ($path) {
            $chunks = explode('/', $path);

            $last = array_pop($chunks);

            $menu = \Whitemore\Menu\Models\Menu::where('slug', '=', $last)->get();

            foreach ($menu as $item) {
                if ($item->getUrl() == $path) {
                    return app(\Whitemore\Menu\Controllers\MenuController::class)->item($item);
                }
            }

            $page = Page::where('slug', '=', $last)->firstOrFail();

            $value = implode('/', $chunks);
            $last = array_pop($chunks);
            $menu = \Whitemore\Menu\Models\Menu::where('slug', '=', $last)->get();

            foreach ($menu as $item) {
                if ($item->getUrl() == $value) {
                    return app(\Whitemore\Menu\Controllers\MenuController::class)->page($page, $item);
                }
            }


            return null;
        })->name('menu.item')->where('path', '.+');
    }
);

Route::get('/{path?}/{page}', 'ArticleController@page')->name('page');
