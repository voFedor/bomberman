<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoldCredits extends Model
{
    protected $table = 'hold_credits';
	
	protected $fillable = [
        'user_id',
        'hold',
        'session_id',
    ];
	
	public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
