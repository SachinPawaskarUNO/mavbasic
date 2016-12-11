<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 * @category   Application Routes
 * @package    MavBasic-Routes
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
*/

Route::get('/', function () {
    return view('welcome');
});

// The following two routes are for development & testing purposes only.
// They should be removed. Having these is a security violation.
Route::get('php-version', function()
{
    return phpinfo();
});

Route::get('laravel-version', function()
{
    $laravel = app();
    return 'Your Laravel Version is '.$laravel::VERSION;
});

// Authentication Routes
Auth::routes();
Route::get( 'password/change', 'Auth\ChangePasswordController@showChangePasswordForm');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword');

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');

Route::resource('settings', 'SettingsController');
Route::get( 'users/{user}/settings', 'UsersController@showSettings');
Route::post('users/{user}/updateSettings', 'UsersController@updateSettings');

Route::get( 'audits', ['as' => 'audits.index', 'uses' => 'AuditsController@index']);
Route::get( 'audits/{audit}', ['as' => 'audits.show', 'uses' => 'AuditsController@show']);
Route::get( 'audits/{audit}/restore', ['as' => 'audits.restore', 'uses' => 'AuditsController@restore']);

//    Route::delete('/comments/{comment}', 'CommentsController@destroy');
//    Route::resource('comments', 'CommentsController');
//    Route::get('comments/{student}/addforstudent', ['as' => 'comments.addforstudent',
//        'uses' => 'CommentsController@addforstudent']);
//    Route::get('comments/{planofstudy}/addforplanofstudy', ['as' => 'comments.addforplanofstudy',
//        'uses' => 'CommentsController@addforplanofstudy']);
