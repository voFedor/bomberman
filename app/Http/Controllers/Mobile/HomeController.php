<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Models\Game;
use Auth;
use App\Models\UserAction;
use App\Http\Controllers\Controller;


class HomeController extends MobileController
{
    //
    public function getIndex()
    {
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
        return view('home.content', compact('games', 'hash', 'name'))

    }

    public function getGame(Request $request)
    {
        $game = Game::where('slug', $request->slug)->first();
        $user = Auth::user();
        if ($user)
        {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => $game->id, 'action' => UserAction::VIEW])->first();
            if ($action == null)
            {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = $game->id;
                $action->action =  UserAction::VIEW;
                $action->amount = 1;
                $action->save();
            } else {
                $action->amount = $action->amount + 1;
                $action->update();
            }
        }
        return view('games.content', compact('game'));
    }



    public function inviteFriend(Request $request)
    {
        $game = Game::find($request->id);
        $user = Auth::user();
        if ($user)
        {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => $game->id, 'action' => UserAction::INVITE])->first();
            if ($action == null)
            {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = $game->id;
                $action->action =  UserAction::INVITE;
                $action->amount = 1;
                $action->save();
            } else {
                $action->amount = $action->amount + 1;
                $action->update();
            }
        }
    }


    public function generateGameUrl(Request $request)
    {
        $game = Game::where('slug', $request->slug)->first();
        $user = Auth::user();
        if ($user)
        {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => $game->id, 'action' => UserAction::INVITE])->first();
            if ($action == null)
            {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = $game->id;
                $action->action =  UserAction::INVITE;
                $action->amount = 1;
                $action->save();
            } else {
                $action->amount = $action->amount + 1;
                $action->update();
            }
        }
    }


    public function checkBalance(Request $request)
    {
        $balance = Auth::user()->credits;

        $user = Auth::user();
        if ($user)
        {
            $action = UserAction::where(['user_id' => $user->id, 'game_id' => $request->id, 'action' => UserAction::INVITE])->first();
            if ($action == null)
            {
                $action = new UserAction();
                $action->user_id = $user->id;
                $action->game_id = $request->id;
                $action->action =  UserAction::INVITE;
                $action->amount = 1;
                $action->save();
            } else {
                $action->amount = $action->amount + 1;
                $action->update();
            }
        }


        return response()->json(['result' => $balance]);
    }
}
