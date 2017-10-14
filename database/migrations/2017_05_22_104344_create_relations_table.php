<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsTable extends Migration
{

    public function up()
    {
      Schema::create("relations", function (Blueprint $table){
        $table->increments('relnum');
        $table->string('source');
        $table->string('target');
        $table->string('relationship');
      });
    }


    public function down()
    {
        Schema::dropIfExists("relations");
    }
}
