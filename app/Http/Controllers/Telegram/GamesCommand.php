<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;

class GamesCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "games";

    /**
     * @var string Command Description
     */
    protected $description = "Игры";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$reply_markup = TelegramBot::menuButton('games');
		
		$text = "Да, у нас пока одна игра, но вот-вот их станет больше.";
		$text .= "\n\nMath";
		$text .= "\nИгра с простыми арифметическими примерами, выбери правильный из нескольких вариантов. Звучит легко? Поверь, это не так.";
		$text .= "\n\nПотренируйся бесплатно, а потом вызови друга на дуэль на 100р.";
		$text .= "\n\nЗапустить игру /math100 или используй меню ниже.";

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text, 'reply_markup' => $reply_markup,]);
    }
}