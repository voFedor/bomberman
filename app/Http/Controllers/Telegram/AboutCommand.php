<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class AboutCommand extends Command
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
		
		$text = "Теперь ты можешь побеждать не только на словах.
				Game Chainger создан для того чтобы ты мог соревноваться практически в любые игры и получать денежный выигрыши за победу, 
				Выбирай игру, делай ставку, выбирай соперника, победитель получает удвоенную ставку. Мы берем небольшую комиссию 20% с выигрыша.";

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => $text]);
    }
}