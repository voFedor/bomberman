<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('bet_id');
			$table->integer('message_id');
			$table->integer('score')->default(0);
			$table->decimal('credits', 7, 2);
            $table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('bet_id')->references('id')->on('game_bets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament');
    }
}
