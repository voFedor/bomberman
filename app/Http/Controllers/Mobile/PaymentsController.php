<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAction;

class PaymentsController extends MobileController
{
    //
    public function getIndex()
    {
        return view('payments.content');
    }


    public function getPayments(Request $request)
    {
        if ($request->sum == null || $request->sum <= 0)
        {
            return back('error', "Укажите сумму");
        }
        $user = \Auth::user();
        if ($user)
        {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => null, 'action' => UserAction::PAYMENT])->first();
            if ($action == null)
            {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = null;
                $action->action =  UserAction::PAYMENT;
                $action->sum = $request->sum;
                $action->save();
            } else {
                $action->sum = $action->sum + $request->sum;
                $action->update();
            }
        }
       abort(403);
    }
}
