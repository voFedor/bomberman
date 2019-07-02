<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class WithdrawalCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "withdrawal";

    /**
     * @var string Command Description
     */
    protected $description = "Вывод средств";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		$text = "Перейди по ссылке и следуй инструкции \n" . '<a href="'.env('TELEGRAM_URL').'/auth">Вывод средств</a>';
        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text, 'disable_web_page_preview' => true]);
    }
}