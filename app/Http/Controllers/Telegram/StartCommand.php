<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle()
    {
		$user = TelegramBot::checkDatabase($this->getUpdate()->message);
		if($user['pass'])
			$mes = "Привет: ".$user['user']->name."! Ваш пароль: ".$user['pass'];
		else
			$mes = "С возвращением: ".$user->name."!";
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $reply_markup = TelegramBot::menuButton();
        $this->replyWithMessage(['parse_mode' => 'html', 'reply_markup' => $reply_markup, 'text' => $mes]);
        //$this->triggerCommand('subscribe');
    }
}