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

Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/auth/vk', 'LoginController@loginVK')->name('vkLogin');
Route::get('/auth/vk/response', 'LoginController@responseVK')->name('vkResponse');

/*Route::get('/auth/google', 'LoginController@loginGoogle')->name('googleLogin');
Route::get('/auth/google/response', 'LoginController@responseGoogle')->name('googleResponse');*/

Route::get('/auth/fb', 'LoginController@loginFB')->name('fbLogin');
Route::get('/auth/fb/response', 'LoginController@responseFB')->name('fbResponse');

Route::match(['get', 'post'],'/myProfile/{user?}', 'ProfileController@modify')->name('myProfile');

Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'is_admin']
], function () {
    Route::resource('users', 'UserController')
        ->parameters(['admin' => 'user'])
        ->except(['show', 'create', 'store']);

    Route::resource('news', 'NewsController')
        ->parameters(['admin' => 'news']);

    Route::resource('resources', 'ResourceController')
        ->parameters(['admin' => 'resource'])
        ->except(['show']);

    Route::get('/parser', 'ParserController@index')->name('parser');

    Route::get('/index', 'IndexController@index')->name('index');
});



Route::group(
    [
        'prefix' => 'news',
        'as' => 'news.',
    ], function () {
    Route::get('/all', 'NewsController@news')->name('all');
    Route::get('/categories', 'NewsController@categories')->name('categories');
    Route::get('/category/{id}', 'NewsController@categoryId')->name('categoryId');
    Route::get('/{news}', 'NewsController@newsOne')->name('one');
}
);

/*Route::get('/', [
   'uses' => 'HomeController@index'
]);*/




