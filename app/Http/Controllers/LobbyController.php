<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Lobby\OpenSessionRequest;
use App\Http\Requests\Lobby\CloseSessionRequest;
use App\Http\Resources\UserResource;
use App\Models\GameBet;
use App\Models\Game;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GameSession;
use App\Models\GameSessionUser;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;
use App\Models\Tournament;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use App\Models\UserAction;

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
        //return UserResource::collection(User::all());
        return view('lobby.index', compact('games'));
    }

    public function getGamePlay(Request $request)
    {
        $uuid = str_random(8);
        if (GameSession::where('uuid', $uuid)->first() != null) {
            while (GameSession::where('uuid', $uuid)->first() != null) {
                $uuid = str_random(8);
            }
        }

        $gameSession = new GameSession();
        $gameSession->bet_id = $request->bet_id;
        $gameSession->game_id = $request->game_id;
        $gameSession->started_at = Carbon::now();
        $gameSession->uuid = $uuid;
        $gameSession->save();

        $gameSessionUser = new GameSessionUser();
        $gameSessionUser->user_id = $request->friend_id;
        $gameSessionUser->session_id = $gameSession->id;
        $gameSessionUser->credits_before = User::find($request->friend_id)->credits;
        $gameSessionUser->save();

        $gameSessionUser = new GameSessionUser();
        $gameSessionUser->user_id = Auth::user()->id;
        $gameSessionUser->session_id = $gameSession->id;
        $gameSessionUser->credits_before = Auth::user()->credits;
        $gameSessionUser->save();

         return response()->json(['data' => env('GAME_HOST')."/?$uuid/".Auth::user()->id]);
    }


    public function saveScore(Request $request)
    {
        $gameSession = GameSession::where('uuid', $request->uuid)->first();
        $gameSessionUserCheck = GameSessionUser::where(['session_id' => $gameSession->id, 'score' => $request->score])->first();
        $gameSessionUser = GameSessionUser::where(['session_id' => $gameSession->id, 'user_id' => $request->user_id])->first();

        if ($gameSessionUserCheck != null)
        {
            if ($gameSessionUserCheck->score > $request->score)
            {
                $gameSession->winner_id = $gameSessionUserCheck->user_id;
                $gameSessionUserCheck->credits_after = $gameSessionUserCheck->credits_after + $gameSession->bet->bet;
                $winner = User::find($gameSessionUserCheck->user_id);
                $winner->credits = $winner->credits + $gameSession->bet->bet;
                $winner->update();
                $looser = User::find($gameSessionUser->user_id);
                $looser->credits = $looser->credits - $gameSession->bet->bet;
                $looser->update();
            } else {
                $gameSession->winner_id = $gameSessionUser->user_id;
                $gameSessionUser->credits_after = $gameSessionUser->credits_after + $gameSession->bet->bet;
                $winner = User::find($gameSessionUser->user_id);
                $winner->credits = $winner->credits + $gameSession->bet->bet;
                $winner->update();
                $looser = User::find($gameSessionUserCheck->user_id);
                $looser->credits = $looser->credits - $gameSession->bet->bet;
                $looser->update();
            }
            $gameSession->ended_at = Carbon::now();
            $gameSession->update();
        }

        $gameSessionUser->score = $request->score;
        $gameSessionUser->update;

        return response()->json(['data' => env('APP_URL')]);
    }


    public function getLobby()
    {
        return view('lobby.lobby');
    }


    public function getUsers(Request $request)
    {
        return  UserResource::collection(User::where('id', '!=', Auth::user()->id)->get());
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


    public function statistic()
    {
        return view('lobby.statistic')->with(['actions' => \App\Models\UserAction::all(), 'users' => \App\Models\User::all()]);
    }


    public function getGame($slug)
    {
        $game = Game::where('slug', $slug)->first();
        $user = Auth::user();
        if ($user) {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => $game->id, 'action' => UserAction::VIEW ])->first();
            if ($action == null) {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = $game->id;
                $action->action = UserAction::VIEW;
                $action->amount = 1;
                $action->save();
            } else {
                $action->amount = $action->amount + 1;
                $action->update();
            }
        }
        $games = Game::all();
        return view('lobby.game', compact('game', 'games'));
    }


    public function invitation()
    {
        $user = Auth::user();
        if ($user->email == null) {
           do {
                $user->name = "gamer-". rand(100, 1000);
            } while (null != User::where('name', $user->name)->first());
            $password = str_random(8);
            $user->password = Hash::make($password);
            $user->update();
            $new_user = true;
            $new_user_name = $user->name;
        } else {
            $new_user = false;
        }
        
        $games = Game::all();
        $games = Game::all();
        $agent = new Agent();
        if ($agent->isMobile() || $agent->isTablet()){
            return redirect('/');
        } else {
            return view('lobby.invitation', compact('user', 'games', 'new_user', 'password', 'new_user_name'));
        }
    }


    public function profileSave(Request $request)
    {
        if ($request->email == null || $request->email == "")
        {
            return back()->with('error', 'Поле email не может быть пустым');
        }

        $user = User::find($request->id);
        $user->fill($request->all());
        $user->update();
        return back()->with('success', 'Данные сохранены');
    }



    public function profile()
    {
        $games = Game::all();
        return view('lobby.profile', compact('games'));
    }


    public function gameHistory()
    {
        $users_sessions = GameSessionUser::where(['user_id' => Auth::id()])->get();
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
