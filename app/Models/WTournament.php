<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Profit;
use App\Models\GameSession;

class WTournament extends Model
{
    protected $table = 'tournament';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'bet_id',
        'message_id',
        'score',
        'credits',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
	
	public function gameBet()
    {
        return $this->belongsTo('App\Models\GameBet');
    }
	
	/**
	 * @param $telegram_id, $game_short_name
     * @return $session['message']
     */	
	public static function open($user, $game_short_name, $message_id)
    {
		$session = array();
		$date_end = new Carbon(env('TOURNAMENT_DATE'));
		if(Carbon::today() > $date_end){
			$session['message'] = "Турнир закончен!";
			return $session;
		}
		
		$session = null;
		$game = GameSession::getGameByGameShortName($game_short_name);
		if(empty($game)) {
			$session['message'] = "Игры не существует";
			return $session;
		}

		$balance = User::getCredits($user->id);
		if((float)$balance < (float)$game->bet) {
			$session['message'] = "На вашем счету не хватает средств! Текущий баланс: {$balance} cr. Для пополнения баланса перейдите в бота @gamechainger_bot";
			return $session;
		}

		$torn = self::create([
			'user_id' => $user->id,
			'bet_id' => $game->bet_id,
			'message_id' => $message_id,
			'credits' => $game->bet,
		]);
		
		User::where('id', $user->id)->update(['credits' => DB::raw("credits - {$game->bet}")]);
		
		Profit::create([
			'user_id' => $user->id,
			'credits' => $game->bet,
		]);
		
		return $session;
	}
	
	public static function close($data)
    {
		$raw = self::where('message_id', $data['message_id'])->latest()->first();
		$raw->score = $data['score'];
		$raw->save();
		return "Вы набрали {$data['score']} баллов";
	}
	
	public static function getLeaders()
    {
		$raws = DB::table(DB::raw('(SELECT user_id, MAX(score) as score FROM tournament GROUP BY user_id) as q, (select @i:=0) AS z'))
				->select([DB::raw('(@i := @i + 1) as position'), DB::raw("(SELECT CONCAT(COALESCE(first_name, ''),' ',COALESCE(last_name, ''),' (',COALESCE(name, ''),')') FROM users WHERE id=user_id) as name"), 'score'])
				->orderBy('score', 'DESC')->get();
		return $raws;
	}
}
