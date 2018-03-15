<?php

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/profile/{user}', 'UserController@show')->name('profile');

Route::post('profile/photo', 'UserController@updateAvatar')->name('profile_avatar');

Route::post('profile/{user}', 'UserController@updatePassword')->name('change_password');

Route::get('user', function (){
    return auth()->user()->id;
});

Route::get('/thread/create', 'ThreadController@create')->name('create');

Route::post('/thread/create', 'ThreadController@store');

Route::get('/thread/{thread}', 'ThreadController@index');

Route::get('/getthread/{thread}', 'ThreadController@show');

Route::delete('thread/delete/{thread}', 'ThreadController@destroy')->name('delete_thread');

Route::post('thread/edit/{thread}', 'ThreadController@update');

Route::get('subscribe/{id}', 'SubscriberController@store')->name('subscribe');

Route::get('unsubscribe/{thread}', 'SubscriberController@destroy')->name('unsubscribe');

Route::get('comment/{thread}', 'CommentController@index');

Route::post('comment', 'CommentController@store');

Route::post('comment/edit/{comment}', 'CommentController@update');

Route::delete('comment/{comment}', 'CommentController@destroy');

Route::post('like', 'LikeController@store');

Route::delete('like/{comment}', 'LikeController@destroy');