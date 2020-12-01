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
//Route::get('users','UsersController@show')->name('users.show');

Route::get('hoops','HoopsController@index')->name('hoops.index');

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
    Route::get('friend.index','FriendsController@index')->name('friend.index');
    
    //Route::get('messages','MessageController@index')->name('messages.index');
    Route::get('/messages/{id}','MessageController@show')->name('messages.show');
    Route::post('messages/{id}','MessageController@store')->name('messages.store');
    Route::get('messages/create','MessageController@create')->name('messages.create');

    Route::group(['prefix'=>'users/{id}'], function () {
        Route::get('request','FriendsController@confirm')->name('request.friend');
        Route::post('request','FriendsController@send')->name('request.send');
        Route::delete('request','FriendsController@destroy')->name('request.cancel');
        Route::get('ask','FriendsController@ask')->name('request.ask');
        Route::get('asked','FriendsController@asked')->name('request.asked');
        Route::get('accept','FriendsController@store')->name('request.accept');
        Route::delete('release','FriendsController@release')->name('friend.release');
        
    });
    
    
    Route::group(['prefix'=>'picture/{id}'],function(){
        Route::post('like','NiceController@like')->name('like.picture');
        Route::delete('not','NiceController@not_so')->name('not.picture');
        Route::get('nice','NiceController@take_nice')->name('nice.picture');
    });
    
    Route::get('hoops/register','HoopsController@create')->name('hoops.create');
    Route::post('hoops','HoopsController@store')->name('hoops.store');
    //Route::group(['prefix'=>'hoops/{id}'],function(){});
});