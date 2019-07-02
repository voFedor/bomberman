<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\TelegramBot;

class SupportCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "support";

    /**
     * @var string Command Description
     */
    protected $description = "Поддержка";

    /**
     * @inheritdoc
     */
    public function handle()
    {
		$this->replyWithChatAction(['action' => Actions::TYPING]);
		/*$user = TelegramBot::checkDatabase($this->getUpdate()->message);
		if($user->telegram_id){
			TelegramBot::where('telegram_id', $user->telegram_id)->delete();
			TelegramBot::create(['telegram_id' => $user->telegram_id]);
		}
		$text = TelegramBot::$arrEditUserText[0];*/
		$text = $this->description;
		
        $this->replyWithMessage(['text' => $text]);        
    }
}