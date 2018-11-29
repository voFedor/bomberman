<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\SessionResource;
use App\Models\Session;
use App\Models\GameSessionUser;
use App\Models\GameSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{

    public function create(Request $request)
    {
        $session =  Session::create(['user1_id' => auth()->id(), 'user2_id' => $request->friend_id]);
        $modifiedSession = new SessionResource($session);
        broadcast(new SessionEvent($modifiedSession, auth()->id()));
        return $modifiedSession;
    }


    public function getUsersListForGame($game_id, $bet_id)
    {
        if (Auth::user() == null) {
            return redirect('/');
        }

        if ($game_id == null || $bet_id == null)
        {
            return back()->with('error', 'Невозможно начать игру');
        }


        return view('lobby.user_list')->with(['game_id' => $game_id, 'bet_id' => $bet_id]);
    }
}
