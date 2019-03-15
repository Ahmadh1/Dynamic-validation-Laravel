<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'UsersController@create')->name('create');
Route::post('/store', 'UsersController@store')->name('store');