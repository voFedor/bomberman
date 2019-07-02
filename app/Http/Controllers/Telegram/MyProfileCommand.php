<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;
use App\Models\User;

class MyProfileCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "my_profile";

    /**
     * @var string Command Description
     */
    protected $description = "Мой профиль";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$user = TelegramBot::checkDatabase($this->getUpdate()->message);
		$balance = User::getCredits($user->id);		
		$message = "Ник: {$user->name}. Баланс: {$balance} cr.";
		
        $this->replyWithMessage(['text' => $message]);
    }
}