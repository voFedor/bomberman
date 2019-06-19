<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;
use App\Models\User;

class myInfoCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "myInfo";

    /**
     * @var string Command Description
     */
    protected $description = "Информация о пользователе";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$user = TelegramBot::checkDatabase($this->getUpdate()->message);
		$balance = User::getCredits($user->id);		
		$message = "Ник: {$user->name}. Баланс: {$balance} cr. Имя: {$user->first_name} Фамилия: {$user->last_name}";
		
        $this->replyWithMessage(['text' => $message]);
    }
}