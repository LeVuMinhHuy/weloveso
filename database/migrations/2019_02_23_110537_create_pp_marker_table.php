<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpMarkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_marker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('body');
            $table->text('type');
            $table->double('latitute');
            $table->double('longitute');
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
        Schema::dropIfExists('pp_marker');
    }
}
