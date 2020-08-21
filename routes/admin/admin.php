<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){

    //login to show, name is every route name
    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login','LoginController@login')->name('admin.login');

//    Route::group(['middleware'=>['ckAdmin']], function(){
        Route::get('index','IndexController@index')->name('admin.index');
        Route::get('welcome','IndexController@welcome')->name('admin.welcome');
//    });




});
