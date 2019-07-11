<?php

namespace App\Http\Controllers\Telegram;

use Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class LeaderCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "leaders";

    /**
     * @var string Command Description
     */
    protected $description = "Таблица лидеров";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$text = '<a href="'.env('TELEGRAM_URL').'/leaders">Таблица лидеров</a>';
        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text, 'disable_web_page_preview' => true]);
    }
}