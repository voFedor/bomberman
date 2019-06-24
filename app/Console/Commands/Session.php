<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\GameSession;

class Session extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all opened sessions and refresh hold_credits';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $res = GameSession::whereNull('winner_id')->whereNull('ended_at')->delete();
		echo 'Удаление завершено!';
    }
}
