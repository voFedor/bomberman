<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duel;
use Auth;

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
                $message->from(env('EMAIL_SENDER'), 'Gamechainger');
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
            $message->from(env('EMAIL_SENDER'), 'Gamechainger');
            $message->subject('Новое сообщение с сайта - вывод средств');
        });

        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }



    public function newGame(Request $request)
    {
        $data_val = $request->all();

            \Mail::send('lobby.email.newGame', $data_val, function ($message) use ($data_val) {
                $message->to(env('EMAIL'));
                $message->from(env('EMAIL_SENDER'), 'Gamechainger');
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
                $message->from(env('EMAIL_SENDER'), 'Gamechainger');
                $message->subject('Новое сообщение с сайта');
            });

        } catch (\Exception $exception) {
        }
        return response()->json(['message' => "Сообщение отправлено", 'result' => 'success']);
    }


    

    public function saveEmail(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->update();
        return response()->json(['message' => "Статус обновлен", 'result' => 'success']);
    }




    public function refreshStatus(Request $request)
    {
    $duel_id = $request->duel_id;
    $duel = Duel::find($duel_id);
    if ($duel->status == 1) {
        $status = "Приглашение отправлено";
    } else if($duel->status == 2){
        $status = "Приглашение принято";
    } else if($duel->status == 3){
        $status = "Игра завершена";
    }
    
    $duel->update();
    return response()->json(['status' => $status, 'message' => "Статус обновлен", 'result' => 'success']);
    }




    public function getByToken($token)
    {

        if ($token == null) {
            return back()->with(['message' => "Не верный код приглашения в адресе =(", 'result' => 'error']);
        } else {
            $duel = Duel::where('token', $token)->first();
            if ($duel == null) {
                return back()->with(['message' => "Арена не найдена =(", 'result' => 'error']);
            } else {
                
                return redirect('/pvp/'.$token);
            }
        }
    }



    public function getUrlByTokenInGame(Request $request)
    {
        $token = $request->token;
        $duel = Duel::where(['token' => $token])->first();
        
        $url = $duel->bet->openUrl();
        return response()->json(['url' => $url,'message' => "Игра загружается", 'result' => 'success'])->header('Content-Type', 'text/html');
    }

}
