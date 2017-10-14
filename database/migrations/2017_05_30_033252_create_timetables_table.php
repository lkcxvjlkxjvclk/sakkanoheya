<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_names');
            $table->string('event_contents');
            $table->string('add_items')->nullable();
            $table->string('start_days');
            $table->string('end_days');
            $table->string('others')->nullable();
            $table->integer('characters')->nullable();
            $table->integer('items')->nullable();
            $table->integer('places')->nullable();
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
        Schema::dropIfExists('timetables');
    }
}
