<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
	CONST PERCENT = 0.2;
	
	protected $table = 'profit';
	
	protected $fillable = [
        'user_id',
        'session_id',
        'credits',
    ];
	
	public static function setProfit($credits, $user)
    {
		$profit = $credits * self::PERCENT;
		self::create([
			'user_id' => $user->user_id, 
			'session_id' => $user->session_id, 
			'credits' => $profit
		]);
        return $profit;
    }
}
