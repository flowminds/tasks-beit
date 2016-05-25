<?php

Route::get('auth/login', [
    'as'    => 'auth.login',
    'uses'  => 'Auth\AuthController@showLoginForm'
]);
Route::post('auth/login', [
    'as'    => 'auth.login',
    'uses'  => 'Auth\AuthController@login'
]);
Route::get('auth/logout', [
    'as'    => 'auth.logout',
    'uses'  => 'Auth\AuthController@logout'
]);

Route::get('auth/register', [
    'as'    => 'auth.register',
    'uses'  => 'Auth\AuthController@showRegistrationForm'
]);
Route::post('auth/register', [
    'as'    => 'auth.register',
    'uses'  => 'Auth\AuthController@register'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [
        'as'    => 'tasks.index',
        'uses'  => 'TasksController@index'
    ]);

    Route::post('tasks', [
        'as'    => 'tasks.store',
        'uses'  => 'TasksController@store'
    ]);

    Route::put('tasks/{tasks}', [
        'as'    => 'tasks.update',
        'uses'  => 'TasksController@update'
    ]);

    Route::post('tasks/{tasks}/complete', [
        'as'    => 'tasks.complete',
        'uses'  => 'TasksController@complete'
    ]);

    Route::post('tasks/{tasks}/incomplete', [
        'as'    => 'tasks.incomplete',
        'uses'  => 'TasksController@incomplete'
    ]);
});
