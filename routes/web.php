<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::post('/home', 'HomeController@update')->name('home.update');

	Route::resource('user', 'UserController');
	Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@show']);
	Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile/edit', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::middleware('is_admin')->group(function () {
		Route::get('/admin', 'AdminController@admin')->name('admin');
		Route::resource('department', 'DepartmentController', ['except' => ['show']]);
		Route::resource('status', 'StatusController', ['except' => ['show']]);
		Route::resource('group', 'GroupController', ['except' => ['show']]);
	});
});

