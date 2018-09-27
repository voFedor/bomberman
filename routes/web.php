<?php
Route::get('/', 'LobbyController@getIndex');
Route::get('/games', ['as' => 'games', 'uses' => 'LobbyController@getGames']);

// Payments Routes...
Route::get('/payments', 'PaymentsController@getPayments');
Route::post('/send-payment', ['as' => 'send-payment', 'uses' => 'PaymentsController@sendPayment']);
Route::post('/check-payment', ['as' => 'check-payment', 'uses' => 'PaymentsController@checkPayment']);
Route::post('/success-payment', ['as' => 'success-payment', 'uses' => 'PaymentsController@successPayment']);
Route::post('/fail-payment', ['as' => 'fail-payment', 'uses' => 'PaymentsController@failPayment']);

// Authentication Routes...
Route::any('/wp-admin/admin-ajax.php', 'Auth\LoginController@anyForm')->name('login');

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->get('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
//

