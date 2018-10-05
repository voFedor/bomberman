<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function feedback(Request $request)
    {
        $data_val = $request->all();

        if ($data_val['email'] == null || $data_val['name'] == null || $data_val['comment'] == null){
            return response()->json(['error' => 'Заполните все поля']);
        }


            \Mail::send('lobby.email.feedback', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('mail@example.com', 'Example');
                $message->subject($data_val['questionType']);
            });


        return response()->json(['success' => "Сообщение отправлено"]);
    }


    public function newGame(Request $request)
    {
        $data_val = $request->all();
        try {
            \Mail::send('lobby.email.newGame', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('mail@example.com', 'Example');
            });
            $message->subject('Новое сообщение с сайта - форма обратной свзи');
        } catch (\Exception $exception) {
        }

        return response()->json(['success' => "Сообщение отправлено"]);
    }

    public function callToAction(Request $request)
    {
        $data_val = $request->all();

        if ($data_val['email'] == null || $data_val['name'] == null || $data_val['comment'] == null){
            return response()->json(['error' => 'Заполните все поля']);
        }

        try {
            \Mail::send('lobby.email.feedback', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('mail@example.com', 'Example');
                $message->subject('Новое сообщение с сайта');
            });
        } catch (\Exception $exception) {
        }

        return response()->json(['success' => "Сообщение отправлено"]);
    }

}
