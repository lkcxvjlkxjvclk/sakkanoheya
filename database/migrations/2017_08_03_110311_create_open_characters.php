<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('info');
            $table->integer('age')->nullable();;
            $table->string('gender')->nullable();;
            $table->string('refer_info')->nullable();;
            $table->string('img_src')->nullable();;
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
        Schema::dropIfExists('open_characters');
    }
}
