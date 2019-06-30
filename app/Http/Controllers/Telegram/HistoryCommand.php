<?php

namespace App\Http\Controllers\Telegram;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Models\GameSession;

class HistoryCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "history";

    /**
     * @var string Command Description
     */
    protected $description = "История игр";

    /**
     * @inheritdoc
     */
    public function handle()
    {
		$text = "Дата | Ставка | Победитель \n";
		$telegram_id = $this->getUpdate()->message->from->id ? : null;
        $this->replyWithChatAction(['action' => Actions::TYPING]);
		
		if($telegram_id){
			$histories = \DB::table('game_sessions_users')
					->leftJoin('game_sessions', 'game_sessions.id', '=', 'game_sessions_users.session_id')
					->leftJoin('users', 'users.id', '=', 'game_sessions_users.user_id')
					->leftJoin('game_bets', 'game_bets.id', '=', 'game_sessions.bet_id')
					->select('game_sessions.started_at', 'bet',	\DB::raw('(SELECT name FROM users WHERE id = winner_id) as winner'))
					->where('telegram_id', $telegram_id)
					->limit(5)
					->get();
			foreach($histories as $history){
				$text .= \Carbon\Carbon::parse($history->started_at)->format('d-m-Y')." | {$history->bet} | {$history->winner} \n";
			}
		}

        $this->replyWithMessage(['parse_mode' => 'html', 'text' => "<pre>$text</pre>"]);
    }
}