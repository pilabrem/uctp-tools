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
    Route::get('/test', "WelcomeController@test");

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    /**
     *
     *      Admin routes
     *
     */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
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

Route::group([
    'prefix' => 'problem_view_forms',
], function () {
    Route::get('/', 'ProblemViewFormsController@index')
        ->name('problem_view_forms.problem_view_form.index');
    Route::get('/create', 'ProblemViewFormsController@create')
        ->name('problem_view_forms.problem_view_form.create');
    Route::get('/show/{problemViewForm}', 'ProblemViewFormsController@show')
        ->name('problem_view_forms.problem_view_form.show')->where('id', '[0-9]+');
    Route::get('/{problemViewForm}/edit', 'ProblemViewFormsController@edit')
        ->name('problem_view_forms.problem_view_form.edit')->where('id', '[0-9]+');
    Route::post('/', 'ProblemViewFormsController@store')
        ->name('problem_view_forms.problem_view_form.store');
    Route::put('problem_view_form/{problemViewForm}', 'ProblemViewFormsController@update')
        ->name('problem_view_forms.problem_view_form.update')->where('id', '[0-9]+');
    Route::delete('/problem_view_form/{problemViewForm}', 'ProblemViewFormsController@destroy')
        ->name('problem_view_forms.problem_view_form.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'solution_view_forms',
], function () {
    Route::get('/', 'SolutionViewFormsController@index')
        ->name('solution_view_forms.solution_view_form.index');
    Route::get('/create', 'SolutionViewFormsController@create')
        ->name('solution_view_forms.solution_view_form.create');
    Route::get('/show/{solutionViewForm}', 'SolutionViewFormsController@show')
        ->name('solution_view_forms.solution_view_form.show')->where('id', '[0-9]+');
    Route::get('/{solutionViewForm}/edit', 'SolutionViewFormsController@edit')
        ->name('solution_view_forms.solution_view_form.edit')->where('id', '[0-9]+');
    Route::post('/', 'SolutionViewFormsController@store')
        ->name('solution_view_forms.solution_view_form.store');
    Route::put('solution_view_form/{solutionViewForm}', 'SolutionViewFormsController@update')
        ->name('solution_view_forms.solution_view_form.update')->where('id', '[0-9]+');
    Route::delete('/solution_view_form/{solutionViewForm}', 'SolutionViewFormsController@destroy')
        ->name('solution_view_forms.solution_view_form.destroy')->where('id', '[0-9]+');
});
