<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropfkSessionIdProfitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profit', function (Blueprint $table) {
			$table->unsignedInteger('session_id')->nullable()->change();
            $table->dropForeign(['session_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('profit', function (Blueprint $table) {
            $table->foreign('session_id')->references('id')->on('game_sessions');
        });
    }
}
