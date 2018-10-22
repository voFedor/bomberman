<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Duel;
use App\Models\Game;

class PvpController extends Controller
{
    //

    public function getIndex($token = null)
    {
        if ($token == null || $token == "") {
            return view('lobby.pvp-nogame');
        }

        $user = Auth::user();
        if ($user == null) {
            $user = User::where('token', $token)->first();
            if($user == null){
                $user = User::createNewUserByToken($token);
            } else {
                Auth::login($user);
            }
        }

        return view('lobby.pvp-game');
    }

    public function getGame($token = null, $url = null)
    {
    	if ($token == null || $token == "") {
    		return view('lobby.pvp-nogame');
    	}

    	$user = Auth::user();
    	if ($user == null) {
    		$user = User::where('token', $token)->first();
    		if($user == null){
    			$user = User::createNewUserByToken($token);
                Auth::login($user);
    		} else {
    			Auth::login($user);
    		}
    	}

        return view('lobby.pvp-game')->with('url', $url);
    }



    public function getLobby($game_id = null, $bet_id = null)
    {
    	
        if ($game_id != null && $bet_id != null) {
            $token = str_random(20);
            $duel = new Duel();
            $duel->user_id = Auth::user()->id;
            $duel->game_id = $game_id;
            $duel->bet_id = $bet_id;
            $duel->token = $token;
            $duel->status = Duel::OPEN;
            $duel->save();
        } else {
            $token = null;
        }
    	
        $games = Game::all();
        $duels = Duel::where('user_id', Auth::user()->id)->get();
        return view('lobby.duels')->with(['duels' => $duels, 'token' => $token, 'games' => $games]);
    }
}
