<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::channel('chat', function ($user) {
    return Auth::user();
});

Broadcast::channel('Chat', function ($user){
    return $user;
});
//Broadcast::channel('Lobby', function ($user) {
//    return $user;
//});
