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
		
		$text = "<strong>О платформе</strong>\nТеперь ты можешь побеждать не только на словах.\nGame Chainger создан для того, чтобы ты мог соревноваться практически в любые игры и получать денежный выигрыши за победу.\nВыбирай игру, делай ставку, выбирай соперника, победитель получает удвоенную ставку. Мы берем небольшую комиссию 20% с выигрыша.";
		$text .= "\n<strong>Правила игр</strong>\nТолько честное соперничество, никаких случайностей и прокачек. Все игроки в равных условиях. Победа зависит только от твоего навыка.";
		$text .= "\n<strong>Как пополнить и вывести деньги</strong>\nПополнить счет ты можешь любым удобным способом через платежную систему Робокасса.\nДля вывода средств необходимо выбрать куда ты хочешь вывести средства (Карта, Электронный кошелек или счет мобильного телефона), сумму, и деньги поступят от 1 до 3 рабочих дней.";
		$text .= "\n@GameChaingerGroup Вопросы, ответы и обсуждения в группе";

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text]);
    }
}