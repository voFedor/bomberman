<?php

namespace App\Http\Controllers\Telegram;

use App\Models\GameBet;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class MathCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "math";
    /**
     * @var string Command Description
     */
    protected $description = "Игра QuickMath соло";

    /**
     * @inheritdoc
     */
    public function handle()
    {
		$reply_markup = Keyboard::make()
		->inline()
		->row(
			Keyboard::inlineButton(['text' => 'Играть соло', 'callback_game' => ['game_short_name' => 'quickmath']])
		);
        $data = [
            'game_short_name' => 'quickmath',
			'reply_markup' => $reply_markup
        ];
		
        $this->replyWithGame($data);
    }

}