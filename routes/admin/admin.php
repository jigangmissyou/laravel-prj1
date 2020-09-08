<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){

    //login to show, name is every route name
    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login','LoginController@login')->name('admin.login');

    Route::group(['middleware'=>['ckAdmin'], 'as'=>'admin.'], function(){
        Route::get('index','IndexController@index')->name('index');
        Route::get('welcome','IndexController@welcome')->name('welcome');
        Route::get('logout','IndexController@logout')->name('logout');
        Route::get('user/index','UserController@index')->name('user.index');
        Route::get('user/add','UserController@create')->name('user.create');
        Route::post('user/store','UserController@store')->name('user.store');
        Route::get('user/edit/{id}','UserController@edit')->name('user.edit');
        Route::post('user/save/{id}','UserController@save')->name('user.save');
        Route::delete('user/del/{id}','UserController@del')->name('user.del');
        Route::delete('user/delAll}','UserController@delAll')->name('user.delAll');
        Route::get('user/appoint', 'NoticeController@demo')->name('notice.demo');
        Route::resource('role', 'RoleController');
        Route::resource('node', 'NodeController');
        Route::get('role/node/{role}','RoleController@node')->name('role.node');
        Route::post('role/node/{role}','RoleController@nodeSave')->name('role.node');
        // 给用户分配角色
        Route::match(['get', 'post'], 'user/role/{user}', 'UserController@role')->name('user.role');


    });




});
