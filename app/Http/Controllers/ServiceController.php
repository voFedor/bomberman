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
            return response()->json(['message' => "Заполните все поля", 'result' => 'error']);
        }


            \Mail::send('lobby.email.feedback', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('info@playfor.tech', 'Gamechainger');
                $message->subject('форма обратной свзи - '.$data_val['questionType']);
            });


        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }

    public function cashOutRequest(Request $request)
    {
        $data_val = $request->all();
        $data_val['email'] = \Auth::user()->email;
        \Mail::send('lobby.email.cashOut', $data_val, function ($message) use ($data_val) {
            $message->to(env('EMAIL'));
            $message->from('info@playfor.tech', 'Gamechainger');
            $message->subject('Новое сообщение с сайта - вывод средств');
        });

        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }



    public function newGame(Request $request)
    {
        $data_val = $request->all();

            \Mail::send('lobby.email.newGame', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('info@playfor.tech', 'Gamechainger');
                $message->subject('Новое сообщение с сайта - предложение по играм');
            });



        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }

    public function callToAction(Request $request)
    {
        $data_val = $request->all();

        if ($data_val['email'] == null || $data_val['name'] == null || $data_val['comment'] == null){

            return response()->json(['message' => "Заполните все поля", 'result' => 'error']);
        }

        try {
            \Mail::send('lobby.email.feedback', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from('mail@example.com', 'Example');
                $message->subject('Новое сообщение с сайта');
            });

        } catch (\Exception $exception) {
        }
        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }

}
