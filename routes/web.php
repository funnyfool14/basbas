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
    Route::resource('users','UsersController');
    Route::resource('profile','ProfileController');
    Route::resource('shoes','ShoesController');
    Route::resource('pictures','PicturesController');
    Route::resource('teams','TeamsController');
    Route::post('invite','TeamsController@invite')->name('teams.invite');
    Route::get('invited','TeamsController@invited')->name('teams.invited');  
    Route::get('accept/{id}','TeamsController@accept')->name('teams.accept');
    Route::get('friend/{id}','FriendsController@index')->name('friend.index');
    
    
    Route::get('messages','MessageController@index')->name('messages.index');
    Route::get('message_to/{id}','MessageController@show')->name('messages.show');
    Route::post('message_to/{id}','MessageController@store')->name('messages.store');

    Route::group(['prefix'=>'users/{id}'], function () {
        Route::get('request','FriendsController@confirm')->name('request.friend');
        Route::post('request','FriendsController@send')->name('request.send');
        Route::delete('request','FriendsController@cancel')->name('request.cancel');
        Route::get('asked','FriendsController@asked')->name('request.asked');
        Route::post('accept','FriendsController@store')->name('request.accept');
        Route::get('accept_confirm','FriendsController@store_confirm')->name('accept.confirm');
        Route::delete('reject','FriendsController@reject')->name('request.reject');
        Route::get('reject','FriendsController@reject_confirm')->name('reject.confirm');
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