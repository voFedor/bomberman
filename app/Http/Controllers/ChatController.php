<?php

namespace App\Http\Controllers;

use App\Events\PrivateNotifyEvent;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Game;
use Auth;
use App\Models\User;
use App\Events\MessageSent;


class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();

        return view('lobby.chat', compact('games'));
    }


    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->content]);
        return response($message, 200);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
