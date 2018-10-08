<?php
Route::get('/', 'LobbyController@getIndex');
Route::get('/games', ['as' => 'games', 'uses' => 'LobbyController@getGames']);
Route::get('/history', 'LobbyController@gameHistory');


Route::get('login/yandex', 'Auth\LoginController@redirectToProvider');
Route::get('login/yandex/callback', 'Auth\LoginController@handleProviderCallback');


Route::post('/feedback', 'ServiceController@feedback');
Route::post('/new-game', 'ServiceController@newGame');

Route::get('/chat', 'ServiceController@chat')->name('chat');

Route::post('/tourReg', 'TournamentsController@tournamentRegistration');

// Payments Routes...
Route::get('/payments', 'PaymentsController@getPayments');
Route::get('/tournaments', 'LobbyController@tournaments');
Route::post('/get-bets', 'PaymentsController@getBets');
Route::post('/cash-out-request', 'ServiceController@cashOutRequest');
Route::post('/check-balance', 'PaymentsController@checkBalance');


Route::post('/send-payment', ['as' => 'send-payment', 'uses' => 'PaymentsController@sendPayment']);
Route::post('/check-payment', 'PaymentsController@checkPayment');
Route::post('/check-payment-yandex', 'PaymentsController@checkPaymentYandex');

Route::get('/success-payment', 'PaymentsController@successPayment');
Route::post('/fail-payment', 'PaymentsController@failPayment');

// Authentication Routes...
Route::any('/register', 'Auth\LoginController@anyForm')->name('login');

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

