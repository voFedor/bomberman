<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGameSessionsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_sessions_users', function (Blueprint $table) {
			$table->unsignedInteger('user_id')->change();
			$table->unsignedInteger('session_id')->change();
			$table->decimal('credits_before', 7, 2)->change();
			$table->decimal('credits_after', 7, 2)->change();
			
            $table->foreign('session_id')->references('id')->on('game_sessions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_sessions_users', function (Blueprint $table) {
            $table->dropForeign('game_sessions_users_session_id_foreign');
            $table->dropForeign('game_sessions_users_user_id_foreign');
        });
    }
}
