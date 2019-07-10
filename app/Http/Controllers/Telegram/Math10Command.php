<?php

namespace App\Http\Controllers\Telegram;

use App\Models\GameBet;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class Math10Command extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "tournament";
    protected $game_id = 1;

    /**
     * @var string Command Description
     */
    protected $description = "Участвовать в турнире";

    /**
     * @inheritdoc
     */
    public function handle()
    {		
		$reply_markup = Keyboard::make()
		->inline()
		->row(
			Keyboard::inlineButton(['text' => "Участвовать", 'callback_game' => ['game_short_name' => 'quickmath_10']])
			//Keyboard::inlineButton(['text' => $this->description, 'switch_inline_query' => 'quickmath_10'])
		);
        $data = [
            'game_short_name' => 'quickmath_10',
			'reply_markup' => $reply_markup
        ];

        $this->replyWithGame($data);
    }

}