<?php
/* Запускаем VPN
* Для запуска локально нужен ngrok
* Запуск ngrok http --host-header=mvp 80
*/
namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class TelegramBot extends Model
{
	static $telegram_id;
	static $username;
	static $first_name;
	static $last_name;
	static $arrEditUser = ['first_name', 'last_name'];
	static $arrEditUserText = ['Введите ваше имя', 'Введите вашу фамилию', "Изменения сохранены"];
	
	protected $table = 'telegram_steps';
	
	protected $fillable = [
        'telegram_id',
        'step',
    ];
	
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
