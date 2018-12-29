<?php

namespace App\Http\Resources;

use App\Models\Session;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'online' => false,
            'session' => $this->session_details($this->id),
            'uuid' => $this->uuid,
            'photo' => $this->photo
            //'openGameSession' => $this->checkOpenSession()
        ];
    }

    private function session_details($id)
    {
        $session = Session::whereIn('user1_id', [auth()->id(), $id])->whereIn('user2_id', [auth()->id(), $id])
            ->first();
        return new SessionResource($session);
    }

//    private function checkOpenSession($friend_id)
//    {
//        $user_id = Auth::user()->id;
//        $userCount = [$user_id, $friend_id];
//        $games = GameSession::where(['winner_id' => null])->whereHas('users_sessions', function ($query) use ($user_id) {
//            $query->where('user_id', $user_id);
//        })->get();
//        return count($games);
//    }
}
