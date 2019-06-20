<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Socialite;
use Auth;
use Hash;
use Storage;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/';

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function socialAuth($network)
    {
        return \Socialite::with($network)->redirect();
    }
	
    public function handleProviderCallback()
    {
        $user = \Socialite::driver('vkontakte')->user();
        \Storage::put('auth.txt', '<?php $arr = ' . var_export($user, true) . ';');
        $accessTokenResponseBody = $user->accessTokenResponseBody;
        \Storage::put('scope.txt', '<?php $arr = ' . var_export($accessTokenResponseBody, true) . ';');
        // $user->token;
    }
    
}
