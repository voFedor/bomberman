<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class DepositCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "deposit";

    /**
     * @var string Command Description
     */
    protected $description = "Пополнить баланс ";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$text = "Перейди по ссылке и следуй инструкции \n" . '<a href="'.env('TELEGRAM_URL').'/auth/'.$this->getUpdate()->message->from->id.'">Пополнить баланс</a>';
        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text, 'disable_web_page_preview' => true]);
    }
}