<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Lobby\OpenSessionRequest;
use App\Http\Requests\Lobby\ExitSessionRequest;
use App\Http\Requests\Lobby\CloseSessionRequest;
use App\Http\Requests\Lobby\StartSessionRequest;
use App\Models\GameBet;
use App\Models\Game;
use App\Models\GameSession;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @param OpenSessionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function getOpenSession(OpenSessionRequest $request)
    {
        $bet = GameBet::where('id', $request->input('bet_id'))->first();
        $id = GameSession::open($request->input('bet_id'), Auth::id(), $request->duel_id);
        $url = env('GAME_HOST', '') . '/?session_id=' . $id . '&user_id=' . Auth::id() . '&bet=' . $bet->bet;
        
        return response([
            'session_id' => $id, 'user_id' => Auth::id(),
            'bet' => $bet->bet,'result' => 'ok', 'url' => $url
        ]);
    }
    /**
     * @param StartSessionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStartSession(StartSessionRequest $request)
    {
        GameSession::start($request->input('session_id'));
        return response()->json([
            'result' => 'success'
        ]);
    }
    /**
     * @param CloseSessionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCloseSession(CloseSessionRequest $request)
    {
        GameSession::close($request->input('session_id'), $request->input('user_id'));
        return response()->json([
            'result' => 'success'
        ]);
    }
    /**
     * @param ExitSessionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExitSession(ExitSessionRequest $request)
    {
        GameSession::exit($request->input('session_id'), $request->input('user_id'));

        $duel = Duel::where($request->duel_id)->first();

        if ($duel != null) {
            $duel->status = 3;
            $duel->update();
        }

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
            $password = null;
            $new_user_name = null;
        }
        
        $games = Game::all();
        

        return response()->json([
            'result' => 'success',
            'user' => $user,
            'new_user' => $new_user,
            'password' => $password,
            'new_user_name' => $new_user_name
        ]);
    }
    public function closeWindow(ExitSessionRequest $request)
    {
        //GameSession::exit($request->input('session_id'), $request->input('user_id'));
        return response([
            'session_id' => $request->input('session_id'), 'user_id' => $request->input('user_id'), 'result' => 'closeWindows'
        ]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListSessions()
    {
        $sessions = GameSession::select([
            'gs.id',
            'gs.started_at',
            'gs.ended_at',
            'gb.bet',
            DB::raw('(SELECT COUNT(`gsu2`.`id`) FROM `game_sessions` as `gs2`
                left join `game_sessions_users` as `gsu2` on `gs2`.`id` = `gsu2`.`session_id` 
                WHERE `gs2`.`id` = `gs`.`id`
                GROUP BY `gs2`.`id`
                ) as count'),
            'u.email'
        ])
            ->from('game_sessions as gs')
            ->leftJoin('users as u', function ($j){
                $j->on('gs.winner_id', '=', 'u.id');
            })->leftJoin('game_bets as gb', function ($j){
                $j->on('gs.bet_id', '=', 'gb.id');
            })->leftJoin('games as g', function ($j){
                $j->on('gb.game_id', '=', 'g.id');
            })
            ->get()
            ->toArray();
        //dd($sessions);
    }
}
