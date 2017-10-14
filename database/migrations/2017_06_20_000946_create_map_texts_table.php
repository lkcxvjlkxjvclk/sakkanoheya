<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('map_texts', function (Blueprint $table) {
          $table->increments('id');
          $table->integer("belong_to_map");
          $table->string("text_id");
          $table->string("content");
          $table->string("font_family");
          $table->string("font_size");
          $table->string("letter-spacing");
          $table->string("fill_color");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_texts');
    }
}
