<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    protected $table = 'invitations';
    public $timestamps = true;


    protected $fillable = [
        'user_id',
        'game_id',
        'token',
        'bet_id',
        'status'
    ];


    CONST OPEN = 1;
    CONST REGISTERED = 2;


    public function game()
    {
        return $this->belongsTo('App\MobileModels\Game');
    }

    public function bet()
    {
        return $this->belongsTo('App\MobileModels\GameBet');
    }
}
