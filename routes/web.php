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
//Route::group([])
Route::get('/test', ['as'=>'profile','uses'=>'IndexController@index']);


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::any('login','LoginController@login');
    Route::get('code','LoginController@code');
    Route::get('getcode','LoginController@getcode');
    Route::get('index','IndexController@index');
    Route::get('crypt','LoginController@crypt');
});

//Route::get('user/profile', 'UserController@showProfile')->name('profile');

Route::get('/', function () {
    return view('welcome');
});
