<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Duel;
use App\Models\Game;
use App\Models\GameBet;

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
        $games = Game::all();
        $duel = Duel::where('token', $token)->first();
        $duel->status = Duel::REGISTERED;
        $duel->update();
        $bet = GameBet::with(['game'])
            ->where('id', $duel->bet_id)
            ->first();

        return view('lobby.pvp-game')->with([
            'url' => $url, 
            'games' => $games,
            'bet' => $bet,
            'user'=> $user
        ]);
    }



    public function getLobby()
    {	
        $games = Game::all();
        $last_duel_token = Duel::where('user_id', Auth::user()->id)->orderByDesc('created_at')->first();
        $duels = Duel::where('user_id', Auth::user()->id)->get();
        return view('lobby.duels')->with(['duels' => $duels, 'games' => $games, 'last_duel_token' => $last_duel_token]);
    }



    public function getDuel(Request $request)
    {
        
            $token = str_random(20);
            $duel = new Duel();
            $duel->user_id = Auth::id();
            $duel->game_id = $request->game_id;
            $duel->bet_id = 1;
            $duel->token = $token;
            $duel->status = Duel::OPEN;
            $duel->save();


            session()->put('token', $token);
        
        
        return redirect('/pvp/lobby/');
    }
}
