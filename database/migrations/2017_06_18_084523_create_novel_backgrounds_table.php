<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 소설에 속한 배경
        Schema::create('novel_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('belong_to_novel'); // 소설 아이디
            $table->string('novel_background');   // 배경설정종류 : characters, items, relations, timetables, maps
            $table->integer('background_id');    // 각 요소의 ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('novel_backgrounds');
    }
}
