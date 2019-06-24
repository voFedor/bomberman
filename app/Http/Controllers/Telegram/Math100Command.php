<?php

namespace App\Http\Controllers\Telegram;

use App\Models\GameBet;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class Math100Command extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "math100";
    protected $game_id = 1;

    /**
     * @var string Command Description
     */
    protected $description = "Игра QuickMath на 100";

    /**
     * @inheritdoc
     */
    public function handle()
    {
		//$bets = GameBet::getBets($this->game_id)->toArray();
		/*$arrKeys[] = Keyboard::inlineButton(['text' => $description, 'callback_game' => ['game_short_name' => 'QuickMath100']]);
		foreach($bets as $arr){
			$bet = (int)$arr['bet'];
			if($bet > 0 && $bet == 100) $arrKeys[] = Keyboard::inlineButton(['text' => "$bet", 'url' => 'https://t.me/gamechainger_bot?game=QuickMath']);
		}
		$keyboard = array("inline_keyboard" => [$arrKeys]);
		$replyMarkup = json_encode($keyboard);*/
		
		$reply_markup = Keyboard::make()
		->inline()
		->row(
			Keyboard::inlineButton(['text' => "Играть в соло", 'callback_game' => ['game_short_name' => 'quickmath']]),
			//Keyboard::inlineButton(['text' => $this->description, 'url' => 'https://t.me/gamechainger_bot?game=quickmath_100'])
			Keyboard::inlineButton(['text' => $this->description, 'switch_inline_query' => 'quickmath_100'])
		);
        $data = [
            'game_short_name' => 'quickmath',
			'reply_markup' => $reply_markup
        ];

        $this->replyWithGame($data);
    }

}