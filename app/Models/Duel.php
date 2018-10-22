<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    //
    protected $table = 'duels';
    public $timestamps = true;


    protected $fillable = [
        'user_id',
        'game_id',
        'token',
        'status'
    ];
    
    
    CONST OPEN = 1;
    CONST REGISTERED = 2;


    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    public function bet()
    {
        return $this->belongsTo('App\Models\GameBet');
    }
}
