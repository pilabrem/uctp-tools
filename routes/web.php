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


    Route::get('/{problemViewForm}/rooms', 'ProblemViewFormsController@rooms')
        ->name('problem_view_forms.problem_view_form.rooms')->where('id', '[0-9]+');
    Route::get('/{problemViewForm}/courses', 'ProblemViewFormsController@courses')
        ->name('problem_view_forms.problem_view_form.courses')->where('id', '[0-9]+');
    Route::get('/{problemViewForm}/distributions', 'ProblemViewFormsController@distributions')
        ->name('problem_view_forms.problem_view_form.distributions')->where('id', '[0-9]+');
    Route::get('/{problemViewForm}/students', 'ProblemViewFormsController@students')
        ->name('problem_view_forms.problem_view_form.students')->where('id', '[0-9]+');
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

Route::group([
    'prefix' => 'problems',
], function () {
    Route::get('/', 'ProblemsController@index')
        ->name('problems.problem.index');
    Route::get('/create', 'ProblemsController@create')
        ->name('problems.problem.create');
    Route::get('/show/{problem}', 'ProblemsController@show')
        ->name('problems.problem.show')->where('id', '[0-9]+');
    Route::get('/{problem}/edit', 'ProblemsController@edit')
        ->name('problems.problem.edit')->where('id', '[0-9]+');
    Route::post('/', 'ProblemsController@store')
        ->name('problems.problem.store');
    Route::put('problem/{problem}', 'ProblemsController@update')
        ->name('problems.problem.update')->where('id', '[0-9]+');
    Route::delete('/problem/{problem}', 'ProblemsController@destroy')
        ->name('problems.problem.destroy')->where('id', '[0-9]+');


    // SUB

    // Rooms
    Route::get('/{problem}/rooms', 'ProblemsController@rooms')
        ->name('problems.problem.rooms')->where('id', '[0-9]+');

    // Courses
    Route::get('/{problem}/courses', 'ProblemsController@courses')
        ->name('problems.problem.courses')->where('id', '[0-9]+');

    // distributions
    Route::get('/{problem}/distributions', 'ProblemsController@distributions')
        ->name('problems.problem.distributions')->where('id', '[0-9]+');

    // students
    Route::get('/{problem}/students', 'ProblemsController@students')
        ->name('problems.problem.students')->where('id', '[0-9]+');

    // Download XML
    Route::get('/{problem}/xml', 'ProblemsController@xml')
        ->name('problems.problem.xml')->where('id', '[0-9]+');

    // Download XML
    Route::get('/{problem}/generate-randomly', 'ProblemsController@generateRandomly')
        ->name('problems.problem.generate_randomly')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'problem/{problem_id}/rooms',
], function () {
    Route::get('/', 'RoomsController@index')
        ->name('rooms.room.index');
    Route::get('/create', 'RoomsController@create')
        ->name('rooms.room.create');
    Route::get('/show/{room}', 'RoomsController@show')
        ->name('rooms.room.show')->where('id', '[0-9]+');
    Route::get('/{room}/edit', 'RoomsController@edit')
        ->name('rooms.room.edit')->where('id', '[0-9]+');
    Route::post('/', 'RoomsController@store')
        ->name('rooms.room.store');
    Route::put('room/{room}', 'RoomsController@update')
        ->name('rooms.room.update')->where('id', '[0-9]+');
    Route::delete('/room/{room}', 'RoomsController@destroy')
        ->name('rooms.room.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'room/{room_id}/travel',
], function () {
    Route::get('/', 'TravelController@index')
        ->name('travel.travel.index');
    Route::get('/create', 'TravelController@create')
        ->name('travel.travel.create');
    Route::get('/show/{travel}', 'TravelController@show')
        ->name('travel.travel.show')->where('id', '[0-9]+');
    Route::get('/{travel}/edit', 'TravelController@edit')
        ->name('travel.travel.edit')->where('id', '[0-9]+');
    Route::post('/', 'TravelController@store')
        ->name('travel.travel.store');
    Route::put('travel/{travel}', 'TravelController@update')
        ->name('travel.travel.update')->where('id', '[0-9]+');
    Route::delete('/travel/{travel}', 'TravelController@destroy')
        ->name('travel.travel.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'room/{room_id}/room_unavailables',
], function () {
    Route::get('/', 'RoomUnavailablesController@index')
        ->name('room_unavailables.room_unavailable.index');
    Route::get('/create', 'RoomUnavailablesController@create')
        ->name('room_unavailables.room_unavailable.create');
    Route::get('/show/{roomUnavailable}', 'RoomUnavailablesController@show')
        ->name('room_unavailables.room_unavailable.show')->where('id', '[0-9]+');
    Route::get('/{roomUnavailable}/edit', 'RoomUnavailablesController@edit')
        ->name('room_unavailables.room_unavailable.edit')->where('id', '[0-9]+');
    Route::post('/', 'RoomUnavailablesController@store')
        ->name('room_unavailables.room_unavailable.store');
    Route::put('room_unavailable/{roomUnavailable}', 'RoomUnavailablesController@update')
        ->name('room_unavailables.room_unavailable.update')->where('id', '[0-9]+');
    Route::delete('/room_unavailable/{roomUnavailable}', 'RoomUnavailablesController@destroy')
        ->name('room_unavailables.room_unavailable.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'problem/{problem_id}/courses',
], function () {
    Route::get('/', 'CoursesController@index')
        ->name('courses.course.index');
    Route::get('/create', 'CoursesController@create')
        ->name('courses.course.create');
    Route::get('/show/{course}', 'CoursesController@show')
        ->name('courses.course.show')->where('id', '[0-9]+');
    Route::get('/{course}/edit', 'CoursesController@edit')
        ->name('courses.course.edit')->where('id', '[0-9]+');
    Route::post('/', 'CoursesController@store')
        ->name('courses.course.store');
    Route::put('course/{course}', 'CoursesController@update')
        ->name('courses.course.update')->where('id', '[0-9]+');
    Route::delete('/course/{course}', 'CoursesController@destroy')
        ->name('courses.course.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'course/{course_id}/configs',
], function () {
    Route::get('/', 'ConfigsController@index')
        ->name('configs.config.index');
    Route::get('/create', 'ConfigsController@create')
        ->name('configs.config.create');
    Route::get('/show/{config}', 'ConfigsController@show')
        ->name('configs.config.show')->where('id', '[0-9]+');
    Route::get('/{config}/edit', 'ConfigsController@edit')
        ->name('configs.config.edit')->where('id', '[0-9]+');
    Route::post('/', 'ConfigsController@store')
        ->name('configs.config.store');
    Route::put('config/{config}', 'ConfigsController@update')
        ->name('configs.config.update')->where('id', '[0-9]+');
    Route::delete('/config/{config}', 'ConfigsController@destroy')
        ->name('configs.config.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'config/{config_id}/subparts',
], function () {
    Route::get('/', 'SubpartsController@index')
        ->name('subparts.subpart.index');
    Route::get('/create', 'SubpartsController@create')
        ->name('subparts.subpart.create');
    Route::get('/show/{subpart}', 'SubpartsController@show')
        ->name('subparts.subpart.show')->where('id', '[0-9]+');
    Route::get('/{subpart}/edit', 'SubpartsController@edit')
        ->name('subparts.subpart.edit')->where('id', '[0-9]+');
    Route::post('/', 'SubpartsController@store')
        ->name('subparts.subpart.store');
    Route::put('subpart/{subpart}', 'SubpartsController@update')
        ->name('subparts.subpart.update')->where('id', '[0-9]+');
    Route::delete('/subpart/{subpart}', 'SubpartsController@destroy')
        ->name('subparts.subpart.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'subpart/{subpart_id}/classes',
], function () {
    Route::get('/', 'ClassesController@index')
        ->name('classes.classe.index');
    Route::get('/create', 'ClassesController@create')
        ->name('classes.classe.create');
    Route::get('/show/{classe}', 'ClassesController@show')
        ->name('classes.classe.show')->where('id', '[0-9]+');
    Route::get('/{classe}/edit', 'ClassesController@edit')
        ->name('classes.classe.edit')->where('id', '[0-9]+');
    Route::post('/', 'ClassesController@store')
        ->name('classes.classe.store');
    Route::put('classe/{classe}', 'ClassesController@update')
        ->name('classes.classe.update')->where('id', '[0-9]+');
    Route::delete('/classe/{classe}', 'ClassesController@destroy')
        ->name('classes.classe.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'classe/{classe_id}/class_possible_rooms',
], function () {
    Route::get('/', 'ClassPossibleRoomsController@index')
        ->name('class_possible_rooms.class_possible_room.index');
    Route::get('/create', 'ClassPossibleRoomsController@create')
        ->name('class_possible_rooms.class_possible_room.create');
    Route::get('/show/{classPossibleRoom}', 'ClassPossibleRoomsController@show')
        ->name('class_possible_rooms.class_possible_room.show')->where('id', '[0-9]+');
    Route::get('/{classPossibleRoom}/edit', 'ClassPossibleRoomsController@edit')
        ->name('class_possible_rooms.class_possible_room.edit')->where('id', '[0-9]+');
    Route::post('/', 'ClassPossibleRoomsController@store')
        ->name('class_possible_rooms.class_possible_room.store');
    Route::put('class_possible_room/{classPossibleRoom}', 'ClassPossibleRoomsController@update')
        ->name('class_possible_rooms.class_possible_room.update')->where('id', '[0-9]+');
    Route::delete('/class_possible_room/{classPossibleRoom}', 'ClassPossibleRoomsController@destroy')
        ->name('class_possible_rooms.class_possible_room.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'classe/{classe_id}/class_possible_times',
], function () {
    Route::get('/', 'ClassPossibleTimesController@index')
        ->name('class_possible_times.class_possible_time.index');
    Route::get('/create', 'ClassPossibleTimesController@create')
        ->name('class_possible_times.class_possible_time.create');
    Route::get('/show/{classPossibleTime}', 'ClassPossibleTimesController@show')
        ->name('class_possible_times.class_possible_time.show')->where('id', '[0-9]+');
    Route::get('/{classPossibleTime}/edit', 'ClassPossibleTimesController@edit')
        ->name('class_possible_times.class_possible_time.edit')->where('id', '[0-9]+');
    Route::post('/', 'ClassPossibleTimesController@store')
        ->name('class_possible_times.class_possible_time.store');
    Route::put('class_possible_time/{classPossibleTime}', 'ClassPossibleTimesController@update')
        ->name('class_possible_times.class_possible_time.update')->where('id', '[0-9]+');
    Route::delete('/class_possible_time/{classPossibleTime}', 'ClassPossibleTimesController@destroy')
        ->name('class_possible_times.class_possible_time.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'problem/{problem_id}/distributions',
], function () {
    Route::get('/', 'DistributionsController@index')
        ->name('distributions.distribution.index');
    Route::get('/create', 'DistributionsController@create')
        ->name('distributions.distribution.create');
    Route::get('/show/{distribution}', 'DistributionsController@show')
        ->name('distributions.distribution.show')->where('id', '[0-9]+');
    Route::get('/{distribution}/edit', 'DistributionsController@edit')
        ->name('distributions.distribution.edit')->where('id', '[0-9]+');
    Route::post('/', 'DistributionsController@store')
        ->name('distributions.distribution.store');
    Route::put('distribution/{distribution}', 'DistributionsController@update')
        ->name('distributions.distribution.update')->where('id', '[0-9]+');
    Route::delete('/distribution/{distribution}', 'DistributionsController@destroy')
        ->name('distributions.distribution.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'distribution/{distribution_id}/distribution_classes',
], function () {
    Route::get('/', 'DistributionClassesController@index')
        ->name('distribution_classes.distribution_class.index');
    Route::get('/create', 'DistributionClassesController@create')
        ->name('distribution_classes.distribution_class.create');
    Route::get('/show/{distributionClass}', 'DistributionClassesController@show')
        ->name('distribution_classes.distribution_class.show')->where('id', '[0-9]+');
    Route::get('/{distributionClass}/edit', 'DistributionClassesController@edit')
        ->name('distribution_classes.distribution_class.edit')->where('id', '[0-9]+');
    Route::post('/', 'DistributionClassesController@store')
        ->name('distribution_classes.distribution_class.store');
    Route::put('distribution_class/{distributionClass}', 'DistributionClassesController@update')
        ->name('distribution_classes.distribution_class.update')->where('id', '[0-9]+');
    Route::delete('/distribution_class/{distributionClass}', 'DistributionClassesController@destroy')
        ->name('distribution_classes.distribution_class.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'problem/{problem_id}/students',
], function () {
    Route::get('/', 'StudentsController@index')
        ->name('students.student.index');
    Route::get('/create', 'StudentsController@create')
        ->name('students.student.create');
    Route::get('/show/{student}', 'StudentsController@show')
        ->name('students.student.show')->where('id', '[0-9]+');
    Route::get('/{student}/edit', 'StudentsController@edit')
        ->name('students.student.edit')->where('id', '[0-9]+');
    Route::post('/', 'StudentsController@store')
        ->name('students.student.store');
    Route::put('student/{student}', 'StudentsController@update')
        ->name('students.student.update')->where('id', '[0-9]+');
    Route::delete('/student/{student}', 'StudentsController@destroy')
        ->name('students.student.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'student/{student_id}/student_courses',
], function () {
    Route::get('/', 'StudentCoursesController@index')
        ->name('student_courses.student_course.index');
    Route::get('/create', 'StudentCoursesController@create')
        ->name('student_courses.student_course.create');
    Route::get('/show/{studentCourse}', 'StudentCoursesController@show')
        ->name('student_courses.student_course.show')->where('id', '[0-9]+');
    Route::get('/{studentCourse}/edit', 'StudentCoursesController@edit')
        ->name('student_courses.student_course.edit')->where('id', '[0-9]+');
    Route::post('/', 'StudentCoursesController@store')
        ->name('student_courses.student_course.store');
    Route::put('student_course/{studentCourse}', 'StudentCoursesController@update')
        ->name('student_courses.student_course.update')->where('id', '[0-9]+');
    Route::delete('/student_course/{studentCourse}', 'StudentCoursesController@destroy')
        ->name('student_courses.student_course.destroy')->where('id', '[0-9]+');
});
