<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ChatController extends Controller
{
    //

    public function getFriends()
    {
        $user = Auth::user();
//        $users = User::whereHas('duels', function ($q) use ($user) {
//            $q->where('user_id', $user->id);
//        })->get();
        $users = User::where('id', '!=', auth()->id())->get();
        return UserResource::collection($users);
    }

    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->content]);

        $chat = $message->createForSend($session->id);
        $message->createForReceive($session->id, $request->to_user);

        broadcast(new PrivateChatEvent($message->content, $chat));

        return response($message, 200);
    }

    public function chats(Session $session)
    {
        return ChatResource::collection($session->chats->where('user_id', auth()->id()));
    }
}
