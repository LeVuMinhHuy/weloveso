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
            $table->string('username');
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('email');
            $table->string('cover')->nullable();
            $table->string('avatar')->nullable();
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('Introduce')->nullable();
            $table->string('IntroImage')->nullable();
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
