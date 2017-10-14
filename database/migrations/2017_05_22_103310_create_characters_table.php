<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{

    public function up()
    {
        Schema::create("characters", function (Blueprint $table){
          $table->increments('cha_id');
          $table->string('name');
          $table->string('info');
          $table->integer('age');
          $table->string('gender');
          $table->string("refer_info");
          $table->string("img_src");
        });
    }


    public function down()
    {
      Schema::dropIfExists("characters");
    }
}
