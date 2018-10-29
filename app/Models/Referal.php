<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'referals';
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'invited_id',
        'status',
        'refill_amount',
        'percentage'
    ];

    CONST OPEN = 1;
    CONST VIEWED = 2;
    CONST APLLY = 3;
}
