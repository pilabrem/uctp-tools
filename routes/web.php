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

/**
 *
 *      Admin routes
 *
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'permission.check']], function () {

    Route::get('/', function () {

        return view('dashboard');
    })->name('dashboard');
});

Route::group([
    'prefix' => 'admin/settings',
], function () {
    Route::get('/', 'SettingsController@index')
         ->name('settings.setting.index');
    Route::get('/create','SettingsController@create')
         ->name('settings.setting.create');
    Route::get('/show/{setting}','SettingsController@show')
         ->name('settings.setting.show')->where('id', '[0-9]+');
    Route::get('/{setting}/edit','SettingsController@edit')
         ->name('settings.setting.edit')->where('id', '[0-9]+');
    Route::post('/', 'SettingsController@store')
         ->name('settings.setting.store');
    Route::put('setting/{setting}', 'SettingsController@update')
         ->name('settings.setting.update')->where('id', '[0-9]+');
    Route::delete('/setting/{setting}','SettingsController@destroy')
         ->name('settings.setting.destroy')->where('id', '[0-9]+');
});