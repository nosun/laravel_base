<?php

// Admin

Route::group(['middleware' => 'web'],function(){

    Route::get('test','Test@index');
    Route::get('/', ['as' => 'index', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login','Auth\AuthController@login');
    Route::get('logout','Auth\AuthController@logout');
    // Admin

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware'=>'auth'], function()
    {
        Route::get('/', 'AdminHomeController@index');
        Route::get('profile','ProfileController@show');
        Route::put('profile','ProfileController@update');

        Route::get('admin',['as' => 'adminList', 'uses' =>'AdminController@index']);
        Route::post('admin','AdminController@store');
        Route::put('admin/{id}','AdminController@update');
        Route::delete('admin/{id}','AdminController@destroy');

        Route::get('permission','PermissionController@index');
        Route::post('permission','PermissionController@store');
        Route::put('permission/{id}','PermissionController@update');
        Route::delete('permission/{id}','PermissionController@destroy');

        Route::get('role','RoleController@index');
        Route::post('role','RoleController@store');
        Route::put('role/{id}','RoleController@update');
        Route::get('role/permission/{id}','RoleController@pget');
        Route::put('role/permission/{id}','RoleController@pset');
        Route::delete('role/{id}','RoleController@destroy');

    });

});

