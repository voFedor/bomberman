<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class InformationCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "information";

    /**
     * @var string Command Description
     */
    protected $description = "Информация";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		/*$reply_markup = Keyboard::make()
		->inline()
		->row(
			Keyboard::inlineButton(['text' => 'Show menu', 'url' => 'https://core.telegram.org/bots/api#setgamescore']),
			Keyboard::inlineButton(['text' => 'Request price', 'url' => 'https://core.telegram.org/bots/api#setgamescore'])        
		);*/
		/*$this->telegram->sendMessage([
			'chat_id' => $this->chat_id,
			'text' => 'https://gamechainger.ru/',
			'parse_mode' => 'html',
			//'reply_markup' => $reply_markup
		]);*/
		
		$text = '<a href="'.env('TELEGRAM_URL').'/auth/'.$this->getUpdate()->message->from->id.'">Пополнить баланс</a>';

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text]);
    }
}