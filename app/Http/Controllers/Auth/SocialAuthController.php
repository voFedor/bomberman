<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\SocialAccountService;
use Illuminate\Http\Reqauest;
use Socialite;
use App\Models\User;
use Auth;
use Hash;

class SocialAuthController extends Controller
{
    //
    public function redirect($provider)
    {
        return Socialite::with($provider)->redirect();
        //return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        dd($user);
        if ($provider == "facebook")
        {
            // OAuth Two Providers
            $token = $user->token;
            $refreshToken = $user->refreshToken; // not always provided
            $expiresIn = $user->expiresIn;

            // OAuth One Providers
            $token = $user->token;


            $user = Socialite::driver('facebook');
            //$user = Socialite::driver('github')->userFromToken($token);
            dd($user);

            // All Providers
            $user->getId();
            $user->getNickname();
            $user->getName();
            $user->getEmail();
            $user->getAvatar();
            dd($user);
            //$existUser = User::where('email', $user->getEmail())->first();
        } else {
            $accessTokenResponseBody = $user->accessTokenResponseBody;
            $existUser = User::where('email', $accessTokenResponseBody['email'])->first();
        }


        if ($existUser != null)
        {
            Auth::loginUsingId($existUser->id, TRUE);
        } else {
            $newUser = new User();
            $newUser->uid = $user->user['id'];
            $newUser->first_name = $user->user['first_name'];
            $newUser->name = $user->user['first_name'];
            $newUser->last_name = $user->user['last_name'];
            $newUser->photo = $user->user['photo'];
            $newUser->network = "vk";
            if ($provider == "facebook")
            {
                $newUser->email = $user->getEmail();
            } else {
                $newUser->email = $accessTokenResponseBody['email'];
            }

            $newUser->password = Hash::make(str_random(8));
            $newUser->role = 2;
            $newUser->uuid = str_random(5);
            $newUser->save();
        }

        return redirect('/');


//        dd($accessTokenResponseBody['email']);
//        $user = $service->createOrGetUser(Socialite::driver('vkontakte')->user());
//
//        auth()->login($user);
//
//        return redirect()->to('/');
    }


    //dynamic
    public function redirectToSocial($social)
    {
        return Socialite::with($social)->redirect();
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
