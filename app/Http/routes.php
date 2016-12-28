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
Route::get('/','MainController@index')->name('main');
Route::get('/loginPage','MainController@showLoginPage');
Route::post('login','AuthController@login');
Route::get('logout','AuthController@logout');

Route::group(['middleware'=>'rbac'],function(){
    Route::get('/demo_RWD/R',[ 'resource'=>'demo_RWD', 'action'=>'READ', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RWD/W',[ 'resource'=>'demo_RWD', 'action'=>'WRITE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RWD/D',[ 'resource'=>'demo_RWD', 'action'=>'DELETE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RW/R',[ 'resource'=>'demo_RW', 'action'=>'READ', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RW/W',[ 'resource'=>'demo_RW', 'action'=>'WRITE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RD/D',[ 'resource'=>'demo_RD', 'action'=>'DELETE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_RD/R',[ 'resource'=>'demo_RD', 'action'=>'READ', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_WD/W',[ 'resource'=>'demo_WD', 'action'=>'WRITE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_WD/D',[ 'resource'=>'demo_WD', 'action'=>'DELETE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_R/R',[ 'resource'=>'demo_R', 'action'=>'READ', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_W/W',[ 'resource'=>'demo_W', 'action'=>'WRITE', 'uses'=>'MainController@displayAccess']);
    Route::get('/demo_D/D',[ 'resource'=>'demo_D', 'action'=>'DELETE', 'uses'=>'MainController@displayAccess']);
});



