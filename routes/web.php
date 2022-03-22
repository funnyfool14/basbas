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

Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware'=>['auth']],function(){
    Route::resource('users','UsersController');
    Route::get('search','UsersController@search')->name('users.search');
    Route::get('result','UsersController@result')->name('users.result');

    Route::resource('profile','ProfileController');
    Route::resource('shoes','ShoesController');
    Route::resource('pictures','PicturesController');

    Route::get('team/search','TeamController@search')->name('team.search');
    Route::get('team/result','TeamController@result')->name('team.result');

    Route::resource('team','TeamController');
    Route::put('accept_opponents/{id}','TeamController@accept_opponents')->name('team.accept_opponents');
    Route::put('reject_opponents/{id}','TeamController@reject_opponents')->name('team.reject_opponents');
    Route::put('accept_members/{id}','TeamController@accept_members')->name('team.accept_members');
    Route::put('reject_members/{id}','TeamController@reject_members')->name('team.reject_members');
    Route::get('chat/{team}','TeamController@chat')->name('team.chat');
    Route::post('chat/{team}','TeamController@message')->name('team.message');
    Route::get('contact/{team}','TeamController@contact')->name('team.contact');


    Route::resource('invitations','InvitationsController');
    Route::delete('invitations/quit/{id}','InvitationsController@quit')->name('invitations.quit');
    Route::get('invitations/reinvite/{id}','InvitationsController@reinvite')->name('invitations.reinvite');
    Route::post('invitations/reinvite/{id}','InvitationsController@restore')->name('invitations.restore');
    Route::get('friend/{id}','FriendsController@index')->name('friend.index');
    Route::resource('introduction','IntroductionController');
    //入部申込
    Route::get('apply/{id}','ApplicationsController@apply')->name('application.apply');
    Route::get('application/{id}','ApplicationsController@show')->name('application.show');
    Route::get('application/index/{application}','ApplicationsController@index')->name('application.index');
    Route::post('application/{application}','ApplicationsController@message')->name('application.message');
    Route::delete('application/{message}','ApplicationsController@destroy')->name('application.message_delete');
    Route::put('application/{message}','ApplicationsController@check')->name('application.message_check');
    Route::put('application/recheck/{message}','ApplicationsController@recheck')->name('application.message_recheck');
    Route::put('application/request/{id}','ApplicationsController@request')->name('application.request');
    Route::get('application/accept_check/{connect_id}','ApplicationsController@accept_check')->name('application.accept_check');
    Route::put('application/accept/{id}','ApplicationsController@accept')->name('application.accept');
    
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
    
Route::get('hoops','HoopsController@index')->name('hoops.index');
    Route::get('hoops/register','HoopsController@create')->name('hoops.create');
    Route::post('hoops','HoopsController@store')->name('hoops.store');
    Route::get('hoops/{hoop}','HoopsController@show')->name('hoops.show');
    //Route::group(['prefix'=>'hoops/{id}'],function(){});

});