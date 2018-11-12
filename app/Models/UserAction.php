<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    //
    protected $table = 'user_actions';

    protected $guarded = [];


    CONST INVITE = "Пригласить друга";
    CONST PLAY100 = "Сыграть на 100р";
    CONST GENERATE = "Сгенерировать ссылку";
    CONST VIEW = "Просмотр игры";
    CONST PAYMENT = "Пополнение баланса";

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
