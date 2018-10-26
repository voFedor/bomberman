<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Events\ChatMessage;
use App\Models\User;
use Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

public function sendMessage(Request $request)
{
$message = [
"id" => $request->userid,
"sourceuserid" => Auth::user()->id,
"name" => Auth::user()->name,
"message" => $request->message
];
event(new ChatMessage($message));
return "true";
}

public function chatPage()
{
$users = User::take(10)->get();
       return view('chat',['users'=> $users]);
}
}
