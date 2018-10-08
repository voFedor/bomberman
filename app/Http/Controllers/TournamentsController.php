<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Tournament;

class TournamentsController extends Controller
{
    //
    public function tournamentRegistration(Request $request)
    {
        $user = Auth::user();
        if ($user == null)
        {
            return response()->json([
                'result' => 'error',
                'message' => 'Вам необходимо авторизироваться на сайте'
            ]);
        }

        if($user->credits < env('BANK'))
        {
            return response()->json([
                'result' => 'error',
                'message' => 'На вашем счету недостаточно денег'
            ]);
        } else {
            $data['name'] = $user->name;
            $data['email'] = $user->email;

            $reg = Tournament::where('user_id', $user->id)->first();
            if ($reg == null)
            {
                $reg = new Tournament();
                $reg->user_id = $user->id;
                $reg->save();

                \Mail::send('lobby.email.tournament', $data, function ($message) use ($data) {
                    $message->to(env('EMAIL'));
                    $message->from('info@playfor.tech', 'Gamechainger');
                    $message->subject('Новое регистрация на турнир');
                });
                return response()->json([
                    'result' => 'success',
                    'message' => 'Вы зарегистрировались в турнире'
                ]);
            } else {
                return response()->json([
                    'result' => 'error',
                    'message' => 'Вы уже зарегистрировались в турнире'
                ]);
            }


        }
    }
}
