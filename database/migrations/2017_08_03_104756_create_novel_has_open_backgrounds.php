<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelHasOpenBackgrounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_has_open_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id');
            $table->string('background_kind',20);
            $table->integer('open_background_id');
            $table->integer('background_id');
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
        Schema::dropIfExists('novel_has_open_backgrounds');
    }
}
