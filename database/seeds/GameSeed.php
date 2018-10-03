<?php

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\GameBet;

class GameSeed extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        for($i = 0; $i < $limit; $i++){
            $game1 = Game::create(
                [
                'name' => 'bomber',
                'ru_name' => 'Бомбермен',
                'logo' => 'bomber.png',
                'need_users' => 4,
                 'status' => true
                ]);
            $game2 = Game::create(
                [
                    'name' => 'sea-battle',
                    'ru_name' => 'Морской бой',
                    'logo' => 'sea-battle.png',
                    'need_users' => 2,
                    'status' => false
                ]);
            $game3 = Game::create(
                [
                    'name' => 'billiards',
                    'ru_name' => 'Бильярд',
                    'logo' => 'billiards.png',
                    'need_users' => 2,
                    'status' => false
                ]);
            $game4 = Game::create(
                [
                    'name' => 'cs-go',
                    'ru_name' => 'CS GO',
                    'logo' => 'cs-go.png',
                    'need_users' => 6,
                    'status' => false
                ]);
            $game5 = Game::create(
                [
                    'name' => 'checkers',
                    'ru_name' => 'Шашки',
                    'logo' => 'checkers.png',
                    'need_users' => 2,
                    'status' => false
                ]);

            $limitInner = rand(2, 6);
            for($k = 0; $k < $limitInner; $k++){
                $bet = rand(2, 15);
                $gameBet = GameBet::where('game_id', $game1->id)
                    ->where('bet', $bet)
                    ->first();

                if(!$gameBet){
                    GameBet::create([
                        'game_id' => $game1->id,
                        'bet' => $bet
                    ]);
                }
            }




    }
}
