<?php

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/thread/create', 'ThreadController@create')->name('create');

Route::post('/thread/create', 'ThreadController@store');

Route::get('/thread/{thread}', 'ThreadController@show');

Route::delete('thread/delete/{id}', 'ThreadController@deleteThread')->name('delete_thread');

Route::get('/profile/{user}', 'UserController@index')->name('profile');

Route::get('comment/{id}', 'CommentController@index');

Route::post('comment', 'CommentController@create');

Route::post('like', 'LikeController@store');

Route::delete('like/{id}', 'LikeController@delete');

Route::delete('comment/{id}', 'CommentController@delete');

Route::get('comment/edit/{id}', 'CommentController@edit');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('profile/photo', 'UserController@updateAvatar')->name('profile_avatar');

Route::post('profile/{user}', 'UserController@changePassword')->name('change_password');

Route::get('subscribe/{id}', 'SubscriberController@create')->name('subscribe');

Route::get('unsubscribe/{id}', 'SubscriberController@unsub')->name('unsubscribe');

Route::post('comment/edit', 'CommentController@edit');

Route::get('getthread/{id}', 'ThreadController@getThread');

Route::post('thread/edit', 'ThreadController@edit');

Route::get('user', function (){
   return auth()->user()->id;
});
