<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;

class MenuCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "menu";

    /**
     * @var string Command Description
     */
    protected $description = "Bot menu";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $response = TelegramBot::menuText();		
		$reply_markup = TelegramBot::menuButton();
		
        $this->replyWithMessage(['reply_markup' => $reply_markup, 'text' => $response]);
    }
}