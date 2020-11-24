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

Route::get('/', 'UsersController@index');
//Route::get('show','UsersController@show')->name('users.show');

Route::get('index','HoopsController@index')->name('hoops.index');

Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware'=>['auth']],function(){
    //index,showはログインユーザの縛りを外す
    Route::resource('users','UsersController'/*,['except' => ['show',]]*/);
    Route::resource('shoes','ShoesController');
    Route::resource('pictures','PicturesController');
    
    Route::group(['prefix'=>'picture/{id}'],function(){
        Route::post('like','NiceController@like')->name('like.picture');
        Route::delete('not','NiceController@not_so')->name('not.picture');
        Route::get('nice','NiceController@take_nice')->name('nice.picture');
    });
    
    Route::get('create','HoopsController@create')->name('hoops.create');
    Route::post('store','HoopsController@store')->name('hoops.store');
    //Route::group(['prefix'=>'hoops/{id}'],function(){});
});