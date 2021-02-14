<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
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

    Route::get('/', "WelcomeController@index");

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    /**
     *
     *      Admin routes
     *
     */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'permission.check']], function () {
        Route::get('/', "DashboardController@index")->name('dashboard');
    });

    Route::group([
        'prefix' => 'admin/settings',
    ], function () {
        Route::get('/', 'SettingsController@index')
            ->name('settings.setting.index');
        Route::get('/create', 'SettingsController@create')
            ->name('settings.setting.create');
        Route::get('/show/{setting}', 'SettingsController@show')
            ->name('settings.setting.show')->where('id', '[0-9]+');
        Route::get('/{setting}/edit', 'SettingsController@edit')
            ->name('settings.setting.edit')->where('id', '[0-9]+');
        Route::post('/', 'SettingsController@store')
            ->name('settings.setting.store');
        Route::put('setting/{setting}', 'SettingsController@update')
            ->name('settings.setting.update')->where('id', '[0-9]+');
        Route::delete('/setting/{setting}', 'SettingsController@destroy')
            ->name('settings.setting.destroy')->where('id', '[0-9]+');
    });

    Route::group([
        'prefix' => 'import_shema_from_xmls',
    ], function () {
        Route::get('/', 'ImportShemaFromXMLsController@index')
            ->name('import_shema_from_xmls.import_shema_from_xml.index');
        Route::get('/create', 'ImportShemaFromXMLsController@create')
            ->name('import_shema_from_xmls.import_shema_from_xml.create');
        Route::post('/', 'ImportShemaFromXMLsController@store')
            ->name('import_shema_from_xmls.import_shema_from_xml.store');
    });

    /**
     *      Gestion des permissions et des roles
     */
    Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('permissions', 'Admin\PermissionsController');
        Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
        Route::resource('roles', 'Admin\RolesController');
        Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
        Route::resource('users', 'Admin\UsersController');
        Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    });

    // Change Password Routes...
    Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
    Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password.patch');
});
