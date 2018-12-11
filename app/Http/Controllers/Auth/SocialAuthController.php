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

        if ($provider == "facebook")
        {
            $existUser = User::where('name', $user->getName())->first();
        } else {
            $accessTokenResponseBody = $user->accessTokenResponseBody;
            $existUser = User::where('email', $accessTokenResponseBody['email'])->first();
        }


        if ($existUser != null)
        {
            Auth::loginUsingId($existUser->id, TRUE);
        } else {
            if ($provider == "facebook")
            {
                $newUser = new User();
                $newUser->first_name = $user->getName();
                $newUser->name = $user->getName();
                $newUser->photo = $user->getAvatar();
                $newUser->network = "facebook";
                $newUser->email = $user->getEmail();

                $newUser->password = Hash::make(str_random(8));
                $newUser->role = 2;
                $newUser->uuid = str_random(5);
                $newUser->save();
            } else {
                $newUser = new User();
                $newUser->uid = $user->user['id'];
                $newUser->first_name = $user->user['first_name'];
                $newUser->name = $user->user['first_name'];
                $newUser->last_name = $user->user['last_name'];
                $newUser->photo = $user->user['photo'];
                $newUser->network = "vk";
                $newUser->email = $accessTokenResponseBody['email'];


                $newUser->password = Hash::make(str_random(8));
                $newUser->role = 2;
                $newUser->uuid = str_random(5);
                $newUser->save();
            }
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
