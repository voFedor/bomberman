<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable();
            $table->string('ru_name', 20)->nullable();
            $table->string('logo', 20)->nullable();
            $table->smallInteger('need_users')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('games');
    }
}
