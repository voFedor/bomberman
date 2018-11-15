<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->integer('uid')->nullable();
            $table->string('network')->nullable();
            $table->string('profile')->nullable();
            $table->string('email')->nullable()->default(null);
            $table->string('name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role')->nullable();
            $table->string('password');
            $table->string('nickname')->nullable()->default(null);
            $table->string('photo')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->boolean('status')->nullable()->default(false);
            $table->string('ip')->nullable()->default(null);
            $table->decimal('credits', 7, 2)->default(0);
            $table->string('token')->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
