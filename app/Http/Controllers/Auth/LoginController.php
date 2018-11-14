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

class LoginController extends Controller
{



    public function ulogin(Request $request)
    {
        //dd($request->all());
		var_dump($request->email);
        $data = $request->all();
        //file_put_contents('asdasdasdasd', '<?php $arr = ' . var_export($request, true) . ';');
        //Storage::put('file.txt', '<?php $arr = ' . var_export($request, true) . ';');
        //$data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['_token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($request, TRUE);
		
		
		 //Storage::put('file.txt', '<?php $arr = ' . var_export($data, true) . ';');
        //Storage::put('file2.txt', '<?php $arr = ' . var_export($user, true) . ';');
		
		
		//$data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['_token'] . '&host=' . $_SERVER['HTTP_HOST']);
        //$user = json_decode($data, TRUE);

        //$network = $data['network'];

        // Find user in DB.
        $userData = User::where('email', $user['email'])->first();

        // Check exist user.
        if (isset($userData->id)) {

            // Check user status.
            if ($userData) {

                // Make login user.
                Auth::loginUsingId($userData->id, TRUE);
            }
            // Wrong status.
            else {
                Session::flash('flash_message_error', trans('interface.AccountNotActive'));
            }

            return response()->json(['message' => "Спасибо за регистрацию", 'result' => 'success']);
        }
        // Make registration new user.
        else {
            $parts = explode("@", $request->email);
            $email = $parts[0];
            // Create new user in DB.
            $newUser = User::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'nickname' => $request->nickname,
                'network' => $request->network,
                'profile' => $request->profile,
                'name' => $email,
                'photo' => $request->photo,
                'email' => $request->email,
                'password' => Hash::make(str_random(8)),
                'role' => User::GAMER,
                'status' => User::REGISTERED,
                'ip' => $request->ip(),
                'credits' => 0,
                'token' => str_random(20)
            ]);

            // Make login user.
            Auth::loginUsingId($newUser->id, TRUE);

            Session::flash('flash_message', trans('interface.ActivatedSuccess'));

            return response()->json(['message' => "Спасибо за регистрацию", 'result' => 'success']);
        }
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
    public function anyForm()
    {
        switch (Request::input('login-with-ajax')){
            case 'login':
                return $this->login();
            case 'remember':
                return $this->remember();
            case 'register':
                return $this->register();
            default:
                return response()->json([
                    'result' => 'error',
                    'message' => 'Пользователь с таким email не найден',
                    'action' => Request::input('login-with-ajax')
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
    public function register()
    {
        $validator = Validator::make(Request::all(), [
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
                    'action' => Request::input('login-with-ajax')
                ];
            }
        }

        $partOfEmail = explode("@", Request::input(self::$fields['register']['email']));
        $username = $partOfEmail[0];

        $password = str_random(5);
        $user = User::create([
            'email' => Request::input(self::$fields['register']['email']),
            'name' => $username,
            'credits' => 0,
            'password' => bcrypt($password),
            'role_id' => User::GAMER,
            'token' => str_random(20)
        ]);

        if($user){
            $email = Request::input(self::$fields['register']['email']);

            Mail::send('emails.register', [
                'login' => $email,
                'password' => $password
            ], function ($message) use ($email) {
                $message->to($email, 'Успешная регистрация')->subject('Успешная регистрация')->from(env('MAIL_SENDER'));
            });


            return [
                'result' => 'success',
                'message' => 'Пароль выслан вам на почту',
                'action' => Request::input('login-with-ajax')
            ];
        }else{
            return [
                'message' => '<strong>ERROR</strong>' . ' user not saved',
                'result' => 'error',
                'action' => Request::input('login-with-ajax')
            ];
        }

    }

    /**
     * @return array
     */
    public function remember()
    {
        $validator = Validator::make(Request::all(), [
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
                    'action' => Request::input('login-with-ajax')
                ];
            }
        }

        $user = User::where('email', Request::input(self::$fields['remember']['email']))->get()->first();
        if ($user) {
            $password = str_random(10);
            $user->update([
                'password' => bcrypt($password)
            ]);

            $email = Request::input(self::$fields['remember']['email']);
            Mail::send('emails.forgot', ['password' => $password], function ($message) use ($email) {
                $message->to($email, 'Восстановление пароля')->subject('Восстановление пароля')->from(env('MAIL_SENDER'));
            });

            Mail::send('emails.register', [
                'login' => $email,
                'password' => $password
            ], function ($message) use ($email) {
                $message->to($email, 'Успешная регистрация')->subject('Успешная регистрация')->from(env('MAIL_SENDER'));
            });


            return [
                'result' => 'success',
                'message' => 'Пароль отправлен вам на почту',
                'action' => Request::input('login-with-ajax')
            ];
        }

        return [
            'message' => '<strong>ERROR</strong>User not found',
            'result' => 'error',
            'action' => Request::input('login-with-ajax')
        ];
    }

    /**
     * @return array
     */
    public function login()
    {
        $validator = Validator::make(Request::all(), [
            self::$fields['login']['email'] => 'required|email|max:255',
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
                'action' => Request::input('login-with-ajax')
            ];
        }


        /**
         * @var User $user
         */
        $user = User::where('email', Request::input(self::$fields['login']['email']))->get()->first();

        if ($user && Hash::check(Request::input(self::$fields['login']['password']), $user->password)) {
            Auth::loginUsingId($user->id);

            return [
                'result' => 'success',
                'email' => $user->email,
                'credits' => $user->credits,
                'action' => Request::input('login-with-ajax')
            ];

        }

        return [
            'message' => 'Not correct login or password',
            'result' => 'error',
            'action' => Request::input('login-with-ajax')
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
    
}
