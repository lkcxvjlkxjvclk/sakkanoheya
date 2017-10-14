<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenTimetables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_names');
            $table->string('event_contents');
            $table->string('start_days');
            $table->string('end_days');
            $table->string('others')->nullable();
            $table->string('refer_info')->nullable();
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
        Schema::dropIfExists('open_timetables');
    }
}
