<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Socialite;
use Auth;
use Hash;
use Storage;
use Session;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function vkontakteCallback(Request $request)
    {
        $userVk = Socialite::driver('vkontakte')->user();
        //Storage::put('file.txt', '<?php $arr = ' . var_export($user, true) . ';');
        $email = $userVk->accessTokenResponseBody['email'];

        $existUser = User::where('email', $email)->first();
        $existUser2 = User::where('name', $email)->first();

        if ($existUser != null)
        {
            Auth::loginUsingId($existUser->id, TRUE);
        } elseif ($existUser2 != null) {
            Auth::loginUsingId($existUser2->id, TRUE);

        } else
         {
            $newUser = new User();
            $newUser->uid = $userVk->user['id'];
            $newUser->first_name = $userVk->user['first_name'];
            $newUser->name = $userVk->user['first_name'];
            $newUser->last_name = $userVk->user['last_name'];
            $newUser->photo = $userVk->user['photo'];
            $newUser->network = "vk";
            $newUser->email = $email != null ? $email : $newUser->name;
            $newUser->password = Hash::make(str_random(8));
            $newUser->role = 2;
            $newUser->uuid = str_random(5);
            $newUser->save();

            $credentials = ['email' => $newUser->email, 'password' => $newUser->password];

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                Auth::loginUsingId($newUser->id, TRUE);
                return redirect('/');
            }
        }

        return redirect('/');

    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public static $fields = [
        'login' => [
            'email' => 'log',
            'name' => 'log',
            'password' => 'pwd'
        ],
        'remember' => [
            'email' => 'user_login_remember'
        ],
        'register' => [
            'email' => 'user_login'
        ]
    ];





    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyForm(Request $request)
    {
        switch ($request->input('login-with-ajax')){
            case 'login':
                return $this->login($request);
            case 'remember':
                return $this->remember($request);
            case 'register':
                return $this->register($request);
            default:
                return response()->json([
                    'result' => 'error',
                    'message' => 'Пользователь с таким email не найден',
                    'action' => $request->input('login-with-ajax')
                ]);
        }
    }

    /**
     * @param $json
     * @return string
     */
    public function prefix($json)
    {
        return response(). '(' . json_encode($json) . ')';
    }

    /**
     * @return array
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            self::$fields['register']['email'] => 'required|email|max:255|unique:users,email',
        ]);

        $validator->setCustomMessages([
            self::$fields['register']['email'] . '.required' => 'Пожалуйста, укажите свой Email',
            self::$fields['register']['email'] . '.email' => 'Пожалуйста, укажите реальный Email',
            self::$fields['register']['email'] . '.unique' => 'Пользователь с таким Email уже зарегистрирован',
        ]);

        if ($validator->fails()) {
            if ($validator->fails()) {
                $errorMessage = '<strong>ERROR</strong>';

                foreach($validator->errors()->all() as $error){
                    if(is_string($error) && isset($error)){
                        $errorMessage .= ' ' . $error;
                    }
                }
                return [
                    'result' => 'error',
                    'message' => $errorMessage,
                    'action' => $request->input('login-with-ajax')
                ];
            }
        }

        $partOfEmail = explode("@", $request->input(self::$fields['register']['email']));
        $username = $partOfEmail[0];

        $invitation_user_id = 0;
        $uuid_invitation_user = Session::get('uuid');
        if ($uuid_invitation_user != null)
        {
            $invitation_user = User::where('uuid', $uuid_invitation_user)->first();

            if($invitation_user != null)
            {
                $invitation_user_id = $invitation_user->id;
            }
        }
        $password = str_random(5);
        $user = new User();
        $user->email = $request->input(self::$fields['register']['email']);
        $user->name = $username;
        $user->first_name = $username;
        $user->credits = 0;
        $user->password = bcrypt($password);
        $user->role_id = User::GAMER;
        $user->token = str_random(20);
        $user->uuid = str_random(5);
        $user->invited_user_id = $invitation_user_id;
        $user->save();
//        $user = User::create([
//            'email' => $request->input(self::$fields['register']['email']),
//            'name' => $username,
//            'credits' => 0,
//            'password' => bcrypt($password),
//            'role_id' => User::GAMER,
//            'token' => str_random(20),
//            'uuid' => str_random(30),
//            'invited_user_id' => $invitation_user_id
//        ]);
        if($user){
            $email = $request->input(self::$fields['register']['email']);

           Mail::send('emails.register', [
                'login' => $email,
                'password' => $password
            ], function ($message) use ($email) {
                $message->to($email, 'Успешная регистрация')->subject('Успешная регистрация')->from(env('MAIL_SENDER'));
            });
    

            return [
                'result' => 'success',
                'message' => 'Пароль выслан вам на почту',
                'action' => $request->input('login-with-ajax'),
                'alert' => "тыц"
            ];
        }else{
            return [
                'message' => '<strong>ERROR!</strong>' . ' user not saved',
                'result' => 'error',
                'action' => $request->input('login-with-ajax')
            ];
        }

    }

    /**
     * @return array
     */
    public function remember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            self::$fields['remember']['email'] => 'required|email|max:255',
        ]);

        $validator->setCustomMessages([
            self::$fields['remember']['email'] . '.required' => 'Email required',
            self::$fields['remember']['email'] . '.email' => 'Email not correct',
        ]);

        if ($validator->fails()) {
            if ($validator->fails()) {
                $errorMessage = '<strong>ERROR</strong>';

                foreach($validator->errors()->all() as $error){
                    if(is_string($error) && isset($error)){
                        $errorMessage .= ' ' . $error;
                    }
                }

                return [
                    'result' => 'error',
                    'message' => $errorMessage,
                    'action' => $request->input('login-with-ajax')
                ];
            }
        }

        $user = User::where('email', $request->input(self::$fields['remember']['email']))->get()->first();
        if ($user) {
            $password = str_random(10);
            $user->update([
                'password' => bcrypt($password)
            ]);

            $email = $request->input(self::$fields['remember']['email']);
            Mail::send('emails.forgot', ['password' => $password], function ($message) use ($email) {
                $message->to($email, 'Восстановление пароля')->subject('Восстановление пароля')->from(env('MAIL_SENDER'));
            });


            return [
                'result' => 'success',
                'message' => 'Пароль отправлен вам на почту',
                'action' => $request->input('login-with-ajax')
            ];
        }

        return [
            'message' => '<strong>ERROR</strong>User not found',
            'result' => 'error',
            'action' => $request->input('login-with-ajax')
        ];
    }

    /**
     * @return array
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            self::$fields['login']['email'] => 'required|max:255',
            self::$fields['login']['password'] => 'required',
        ]);

        $validator->setCustomMessages([
            self::$fields['login']['password'] . '.required' => 'Password required',
            self::$fields['login']['email'] . '.required' => 'Email required',
            self::$fields['login']['email'] . '.email' => 'Email not correct',
        ]);

        if ($validator->fails()) {
            $errorMessage = '<strong>ERROR</strong>';

            foreach($validator->errors()->all() as $error){
                if(is_string($error) && isset($error)){
                    $errorMessage .= ' ' . $error;
                }
            }

            return [
                'result' => 'error',
                'message' => $errorMessage,
                'action' => $request->input('login-with-ajax')
            ];
        }


        /**
         * @var User $user
         */
        $user = User::where('email', $request->input(self::$fields['login']['email']))->orWhere('name', $request->input(self::$fields['login']['email']))->get()->first();

        if ($user && Hash::check($request->input(self::$fields['login']['password']), $user->password)) {
            Auth::loginUsingId($user->id);

            $game_id = $request->game_id;
            if($game_id != null)
            {
                $game = Game::find($game_id);
                return [
                    'result' => 'url',
                    'email' => $user->email,
                    'credits' => $user->credits,
                    'url' => env("APP_URL").'/game/'.$game->slug,
                    'action' => $request->input('login-with-ajax')
                ];
            }

            return [
                'result' => 'success',
                'email' => $user->email,
                'credits' => $user->credits,
                'action' => $request->input('login-with-ajax')
            ];

        }

        return [
            'message' => 'Not correct login or password',
            'result' => 'error',
            'action' => $request->input('login-with-ajax')
        ];
    }


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest', ['except' => 'logout']);
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function networkAuth($network)
    {
        return Socialite::with('vkontakte')->redirect();
    }

    public static function telegramPay(Request $request)
    {
		if(!Auth::check()){
			$user = User::where('telegram_id', $request->id)->get()->first();		
			//if ($user) Auth::loginUsingId($user->id);
			if ($user) {
				$games = \App\Models\Game::all();
				return view('lobby.payment_form', compact('games', 'payment_history'))->with(['user_id' => $user->id]);
			}
		}
        return redirect()->to('/payments');
    }

    public static function telegramAuth()
    {
		if(!Auth::check()){
			$games = \App\Models\Game::all();
			return view('lobby.auth_telegram', compact('games', 'auth_telegram'));
		}
		return redirect()->to('/payments');
    }
}
