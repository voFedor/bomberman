<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

use App\Models\TelegramBot;

class TournamentCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "tournament";

    /**
     * @var string Command Description
     */
    protected $description = "Турнир по математике";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$reply_markup = TelegramBot::menuButton('tournament');
		/*$reply_markup = Keyboard::make()
		->inline()
		->row(
			Keyboard::inlineButton(['text' => "Играть", 'switch_inline_query' => 'quickmath_10']),
			Keyboard::inlineButton(['text' => "Таблица лидеров", 'callback_data' => ''])
		)->row(
			Keyboard::inlineButton(['text' => "Пополнить баланс", 'url' => env('TELEGRAM_URL').'/auth/'.$this->getUpdate()->message->from->id]),
			Keyboard::inlineButton(['text' => "Мой баланс", 'callback_data' => ''])
		);*/

		$text = "Турнир по математике!)";
		$text .= "\n\nКто наберет больше очков получит денежный приз.";
		$text .= "\n1 место 1000р.";
		$text .= "\n2 место 500р.";
		$text .= "\n3 место 200р.";
		$text .= "\n\nИграй сколько хочешь.";
		$text .= "\nКаждая попытка стоит 10 р.";

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text, 'reply_markup' => $reply_markup]);
    }
}