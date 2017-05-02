<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
get('/', 'StaticPagesController@home')->name('home');
get('/help', 'StaticPagesController@help')->name('help');
get('/about', 'StaticPagesController@about')->name('about');

get('signup','UsersController@create')->name('signup');

resource('users', 'UsersController');
get('login','SessionsController@create')->name('login');
post('login','SessionsController@store')->name('login');
delete('logout','SessionsController@destroy')->name('logout');

get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');


get('send','UsersController@send');

resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
get('/users/{id}/followings', 'UsersController@followings')->name('users.followings');
get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');

//关注用户
post('/users/followers/{id}', 'FollowersController@store')->name('followers.store');
//取消关注
delete('/users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');

get('/blog/{id}','StatusesController@blog')->name('blog');











//resource等同于
//get('/users', 'UsersController@index')->name('users.index');
//get('/users/{id}', 'UsersController@show')->name('users.show');
//get('/users/create', 'UsersController@create')->name('users.create');
//post('/users', 'UsersController@store')->name('users.store');
//get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
//patch('/users/{id}', 'UsersController@update')->name('users.update');
//delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');