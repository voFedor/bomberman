<?php

Route::get('/', 'LobbyController@getIndex');
Route::get('/challenge', 'LobbyController@getChallenge');
Route::get('/sdfksdhjfksdjfgjhds', 'LobbyController@statistic');
Route::get('/invitation/{uuid}', 'LobbyController@getNewUser');

Route::get('/lobby', 'LobbyController@getLobby');
Route::post('/getUsers', 'LobbyController@getUsers');
Route::post('/getCurrentUsers', 'LobbyController@getCurrentUsers');
Route::post('/checkGameSession', 'LobbyController@checkGameSession');
Route::post('/getGamePlay', 'LobbyController@getGamePlay');
Route::get('/play', 'LobbyController@play');
Route::get('/save-game-result', 'LobbyController@saveScore');
Route::post('/session/create', 'SessionController@create');
Route::post('/send/{session}', 'ChatController@send');

Route::get('/games', ['as' => 'games', 'uses' => 'LobbyController@getGames']);
Route::get('/history', 'LobbyController@gameHistory');
Route::get('/game/{slug}', 'LobbyController@getGame');
Route::get('/invitation', 'LobbyController@invitation');

Route::get('/profile', 'LobbyController@profile');
Route::post('/profile/save', 'LobbyController@profileSave');

Route::get('login/yandex', 'Auth\LoginController@redirectToProvider');
Route::get('login/yandex/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/redirect/{facebook}', 'Auth\SocialAuthController@redirect');
//Route::get('/callback', 'Auth\SocialAuthController@callback');

Route::get('/auth/social/vkontakte', 'Auth\SocialAuthController@redirectToVkontakte');
//Route::get('/auth/vkontakte/callback', 'Auth\loginController@vkontakteCallback');

Route::get('/users-list/{game_id}/{bet_id}', 'SessionController@getUsersListForGame');

Route::get('/game-by-token/{token}', 'ServiceController@getByToken');
Route::post('/game-url-by-token', 'ServiceController@getUrlByTokenInGame');
Route::post('/feedback', 'ServiceController@feedback');
Route::post('/new-game', 'ServiceController@newGame');
Route::post('/save-email', 'ServiceController@saveEmail');


Route::get('/chat', 'ServiceController@chat')->name('chat');

Route::post('/tourReg', 'TournamentsController@tournamentRegistration');
Route::post('/refresh-status', 'ServiceController@refreshStatus');

Route::post('/ulogin', 'Auth\LoginController@ulogin');
Route::get('/redirectToSocial/{provider}', 'Auth\SocialAuthController@redirectToSocial');
Route::get('/auth/{network}/callback', 'Auth\SocialAuthController@callback');
//Route::post('/socialAuth/{network}', 'Auth\AuthController@socialAuth');

// Payments Routes...
Route::get('/payments', 'PaymentsController@getPayments');
Route::get('/tournaments', 'LobbyController@tournaments');
Route::post('/get-bets', 'PaymentsController@getBets');
Route::post('/cash-out-request', 'ServiceController@cashOutRequest');
Route::post('/check-balance', 'PaymentsController@checkBalance');

Route::get('/cash', 'ServiceController@cash');

Route::post('/send-payment', ['as' => 'send-payment', 'uses' => 'PaymentsController@sendPayment']);
Route::post('/check-payment', 'PaymentsController@checkPayment');
Route::post('/check-payment-yandex', 'PaymentsController@checkPaymentYandex');

Route::get('/success-payment', 'PaymentsController@successPayment');
Route::post('/fail-payment', 'PaymentsController@failPayment');

// Authentication Routes...
Route::any('/register', 'Auth\LoginController@anyForm')->name('login');

$this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->get('login/{network}', 'Auth\LoginController@networkAuth')->name('login');
$this->post('/login', 'Auth\LoginController@login')->name('auth.login');
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

Route::get('/chat', 'ChatController@index');
Route::get('messages', 'ChatController@fetchMessages');
Route::post('messages', 'ChatController@sendMessage');


Route::prefix('/pvp')->group(function () {
	$this->get('/lobby/{duel_id?}', 'PvpController@getLobby')->name('pvpLobby');
	$this->post('/get-duel/{bet_id?}', 'PvpController@getDuel');
    $this->get('/{token}', 'PvpController@getGame')->name('pvp');
});



Route::post('/check-balance-mob', 'Mobile\HomeController@checkBalance');
Route::post('/generateGameUrl', 'Mobile\HomeController@generateGameUrl');
Route::post('/inviteFriend', 'Mobile\HomeController@inviteFriend');
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);


Route::get('mlogin', ['as' => 'mlogin', 'uses' => 'Mobile\LoginController@showLoginForm']);
Route::post('mlogin', 'Mobile\LoginController@login');


Route::get('mregister', 'Mobile\RegisterController@showRegistrationForm');
Route::post('mregister', 'Mobile\RegisterController@register');
Route::post('/makeDeposit', 'Mobile\PaymentsController@getPayments');


Route::prefix('/telegram')->group(function () {
	Route::get('/set-hook', function () {
		Telegram::setWebhook(['url' => 'https://'.env('TELEGRAM_NGROK').'.ngrok.io/telegram/' . env('TELEGRAM_BOT_TOKEN') . '/webhook']);
	});
	Route::post('/'.env('TELEGRAM_BOT_TOKEN') . '/webhook', 'TelegramBotController@handleRequest');
	Route::get('/test', 'TelegramBotController@test');
});
