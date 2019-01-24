<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/success-payment',
        '/fail-payment',
        '/check-payment',
        '/check-payment-yandex',
        '/game-url-by-token',
        '/pvp/get-duel',
        '/ulogin',
        '/getUsers',
        '/save-game-result',
        '/checkGameSession',
        '/getGamePlay',
        '/login',
        '/register',
        '/getUsers'
    ];
}
