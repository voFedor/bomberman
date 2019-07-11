<?php
/* Запускаем VPN
* Для запуска локально нужен ngrok
* Запуск ngrok http --host-header=mvp 80
*/
namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramBot extends Model
{
	static $telegram_id;
	static $username;
	static $first_name;
	static $last_name;
	static $arrEditUser = ['first_name', 'last_name'];
	static $arrEditUserText = ['Введите ваше имя', 'Введите вашу фамилию', "Изменения сохранены"];
	static $arrMainCommands = ['menu', 'information', 'games', 'deposit', 'withdrawal', 'my_profile', 'history', 'support', 'tournament'];
	static $arrGameCommands = ['back', 'math100', 'play_math'];
	static $arrTourCommands = ['deposit', 'leaders', 'my_profile', 'play_math', 'back'];

	
	protected $table = 'telegram_steps';
	
	protected $fillable = [
        'telegram_id',
        'step',
    ];
	
	public static function menuButton($arr_name = false)
    {
		Telegram::removeCommand('start');
		
		if($arr_name == 'games') Telegram::removeCommands(self::$arrMainCommands);
		if(!$arr_name) Telegram::removeCommands(self::$arrGameCommands);
		
		$commands = Telegram::getCommands();

		$count = count($commands);
		$keyboard = array();
		$a = 0; $b = 0;
		
        foreach ($commands as $name => $command) { 
			$keyboard[$a][$b] = sprintf('/%s' . PHP_EOL, $name);
			$b++;
			//if($name == 'start') {$a=0; $b=0;}
			if($b == 3) {$a++; $b=0;}
        }

		$params = [
			'keyboard' => $keyboard, 
			'resize_keyboard' => true, 
			'one_time_keyboard' => false
		];
		$reply_markup = Keyboard::make($params);			
		
		return $reply_markup;
	}
	
	public static function menuText()
    {
		Telegram::removeCommand('back');
		Telegram::removeCommand('start');
		$commands = Telegram::getCommands();

        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }
		
		return $response;
	}
	
    public static function checkDatabase($request)
    {
        self::$telegram_id = $request['from']['id'] ?? null;
        self::$username = $request['from']['username'] ?? null;
        self::$first_name = $request['from']['first_name'] ?? null;
        self::$last_name = $request['from']['last_name'] ?? null;
		
		$user = User::where('telegram_id', self::$telegram_id)->first();

		if(isset($user->id)){
			return $user;
		}else{
			$new_user = self::saveNewUser();
			return $new_user;
		}
    }
	
	public static function saveNewUser()
    {
        $pass = str_random(8);
		
		$user = new User();
		$user->name 	  = self::$username;
		$user->last_name  = self::$last_name;
		$user->first_name = self::$first_name;
		$user->role 	  = User::GAMER;
		$user->password   = Hash::make($pass);
		$user->telegram_id = self::$telegram_id;
		$user->save();
		
        return ['user' => $user, 'pass' => $pass];
    }
	
	public static function getStep($telegram_id)
    {
		return self::where('telegram_id', $telegram_id)->value('step');
	}
}
