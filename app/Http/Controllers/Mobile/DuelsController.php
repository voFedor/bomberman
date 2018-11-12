<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DuelsController extends MobileController
{
    //
    public function getDuel()
    {

        return redirect('/pvp/lobby/');
    }
}
