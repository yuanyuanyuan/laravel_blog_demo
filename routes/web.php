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

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin.login']],function(){
    Route::get('index','IndexController@index');
    Route::any('pass','IndexController@pass');
    Route::resource('category', 'CategoryController');
    Route::post('cate/changeorder','CategoryController@changeOrder');
    Route::resource('article', 'ArticleController');
    // 图片上传的路由
    Route::any('upload', 'CommonController@upload');

});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::any('login','LoginController@login');
    Route::get('code','LoginController@code');
    Route::get('logout','LoginController@logout');
});

