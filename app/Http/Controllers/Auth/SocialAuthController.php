<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Illuminate\Http\Reqauest;
use Socialite;

class SocialAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/');
    }


    //dynamic
    public function redirectToVkontakte($social)
    {
        $params = array(
         'client_id'     => env('VKONTAKTE_KEY'),
         'redirect_uri'  => "https://gamechainger.ru/auth/vkontakte/callback",
         'response_type' => 'code'
        );
       $url = 'http://oauth.vk.com/authorize?'.urldecode(http_build_query($params));
       return redirect($url);
    }


    function handleSocialCallback(SocialAccountService $service, $social)
    {
        try {
            $user = $service->setOrGetUser(Socialite::driver($social));
            auth()->login($user);
            return redirect('/');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
