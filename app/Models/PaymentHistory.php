<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @package App
 * @property string $title
 */
class PaymentHistory extends Model
{
    //
    CONST PAID = 1;
    CONST PANGING = 0;

    protected $table = 'payment_histories';
    public $timestamps = true;

    protected $fillable = ['token', 'user_id', 'price', 'status'];
    protected $hidden = [];
}
