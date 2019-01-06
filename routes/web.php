<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('polls', 'Admin\PollsController');
    Route::post('polls_mass_destroy', ['uses' => 'Admin\PollsController@massDestroy', 'as' => 'polls.mass_destroy']);
    Route::post('polls_restore/{id}', ['uses' => 'Admin\PollsController@restore', 'as' => 'polls.restore']);
    Route::delete('polls_perma_del/{id}', ['uses' => 'Admin\PollsController@perma_del', 'as' => 'polls.perma_del']);
    Route::resource('questions', 'Admin\QuestionsController');
    Route::post('questions_mass_destroy', ['uses' => 'Admin\QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::post('questions_restore/{id}', ['uses' => 'Admin\QuestionsController@restore', 'as' => 'questions.restore']);
    Route::delete('questions_perma_del/{id}', ['uses' => 'Admin\QuestionsController@perma_del', 'as' => 'questions.perma_del']);
    Route::resource('questiontypes', 'Admin\QuestiontypesController');
    Route::post('questiontypes_mass_destroy', ['uses' => 'Admin\QuestiontypesController@massDestroy', 'as' => 'questiontypes.mass_destroy']);
    Route::resource('options', 'Admin\OptionsController');
    Route::post('options_mass_destroy', ['uses' => 'Admin\OptionsController@massDestroy', 'as' => 'options.mass_destroy']);
    Route::post('options_restore/{id}', ['uses' => 'Admin\OptionsController@restore', 'as' => 'options.restore']);
    Route::delete('options_perma_del/{id}', ['uses' => 'Admin\OptionsController@perma_del', 'as' => 'options.perma_del']);
    Route::resource('responses', 'Admin\ResponsesController');
    Route::post('responses_mass_destroy', ['uses' => 'Admin\ResponsesController@massDestroy', 'as' => 'responses.mass_destroy']);
    Route::post('responses_restore/{id}', ['uses' => 'Admin\ResponsesController@restore', 'as' => 'responses.restore']);
    Route::delete('responses_perma_del/{id}', ['uses' => 'Admin\ResponsesController@perma_del', 'as' => 'responses.perma_del']);
    Route::resource('votes', 'Admin\VotesController');



 
});
