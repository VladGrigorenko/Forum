<?php

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
#user
Route::get('/profile/{user}', 'UserController@show')->name('profile');

Route::post('profile/photo', 'UserController@updateAvatar')->name('profile_avatar');

Route::post('profile/{user}', 'UserController@updatePassword')->name('change_password');

Route::get('user', function (){
    return auth()->user()->id;
});
#thread
Route::get('/thread/create', 'ThreadController@create')->name('create');

Route::post('/thread/create', 'ThreadController@store');

Route::get('/thread/{thread}', 'ThreadController@index');

Route::delete('thread/delete/{id}', 'ThreadController@destroy')->name('delete_thread');

Route::get('getthread/{id}', 'ThreadController@show');

Route::post('thread/edit', 'ThreadController@update');
#sub
Route::get('subscribe/{id}', 'SubscriberController@store')->name('subscribe');

Route::get('unsubscribe/{id}', 'SubscriberController@destroy')->name('unsubscribe');
#comment
Route::get('comment/{id}', 'CommentController@index');

Route::post('comment', 'CommentController@store');

Route::post('comment/edit', 'CommentController@update');

Route::delete('comment/{id}', 'CommentController@destroy');
#like
Route::post('like', 'LikeController@store');

Route::delete('like/{id}', 'LikeController@destroy');



