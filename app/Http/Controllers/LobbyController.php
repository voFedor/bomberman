<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Lobby\OpenSessionRequest;
use App\Http\Requests\Lobby\CloseSessionRequest;
use App\Models\GameBet;
use App\Models\Game;
use App\Models\GameSession;
use App\Models\GameSessionUser;
use DB;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;
use App\Models\Tournament;

class LobbyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $games = Game::all();

        $user = \Auth::user();
        if ($user != null)
        {
            $encodedChatId = '42bgw';
            $siteDomain = 'gamechainger.io';
            $siteUserExternalId = $user->id;
            $siteUserFullName = substr(Auth::user()->email, 0, strrpos(Auth::user()->email, '@'));
            $secretKey = env("CHAT_KEY");

            $signatureDataParts = $siteDomain.$siteUserExternalId.$siteUserFullName.$secretKey;
            $hash = md5($signatureDataParts);
            $name = substr(Auth::user()->email, 0, strrpos(Auth::user()->email, '@'));
        } else {
            $hash = null;
            $name = null;
        }

        return view('lobby.index', compact('games', 'hash', 'name'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGames()
    {
        return view('lobby.games');
    }

    public function gameHistory()
    {
        if (! Gate::allows('session_access')) {
            return abort(401);
        }

        $users_sessions = GameSessionUser::where(['user_id' => Auth::id()])
            ->get();

        $sessions = GameSessionUser::get();

        $games = Game::all();

        return view('lobby.history', compact('sessions', 'games', 'users_sessions'));
    }

    public function tournaments()
    {
        $bets = GameBet::with(['game'])
            ->get()
            ->all();

        $games = Game::all();
        $participants = Tournament::get();

        return view('lobby.tournaments', compact('bets', 'participants', 'games'));
    }

    public function removeUserFromSession()
    {

    }


}
