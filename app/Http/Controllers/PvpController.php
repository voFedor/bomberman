<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Duel;
use App\Models\Game;
use App\Models\GameBet;
use Jenssegers\Agent\Agent;

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

        $agent = new Agent();
        if ($agent->isMobile() || $agent->isTablet()){
            return redirect('/');
        } else {
            return view('lobby.pvp-game');
        }
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

        if($duel)
        {
            $duel->status = Duel::REGISTERED;
            $duel->update();
            $bet = GameBet::with(['game'])
                ->where('id', $duel->bet_id)
                ->first();
            return view('lobby.pvp-game')->with(['url' => $url, 'games' => $games, 'bet' => $bet]);
        }
    }



    public function getLobby()
    {	
        $games = Game::all();
        $last_duel_token = Duel::where('user_id', Auth::id())->orderByDesc('created_at')->first();
        $duels = Duel::where('user_id', Auth::id())->get();
        $agent = new Agent();
        if ($agent->isMobile() || $agent->isTablet()){
            return redirect('/');
        } else {
            return view('lobby.duels')->with(['duels' => $duels, 'games' => $games, 'last_duel_token' => $last_duel_token]);
        }
    }



    public function getDuel(Request $request)
    {
        
            $token = str_random(20);
            $duel = new Duel();
            $duel->user_id = Auth::user()->id;
            $duel->game_id = $request->game_id;
            $duel->bet_id = 1;
            $duel->token = $token;
            $duel->status = Duel::OPEN;
            $duel->save();


            session()->put('token', $token);
        
        
        return redirect('/pvp/lobby/');
    }
}
