<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;

class BackCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "back";

    /**
     * @var string Command Description
     */
    protected $description = "Back to main Menu";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $reply_markup = TelegramBot::menuButton();
        $this->replyWithMessage(['parse_mode' => 'html', 'reply_markup' => $reply_markup, 'text' => "Основное меню"]);
    }
}