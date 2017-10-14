<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRecommentRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // USER_RECOMMENT_RELATIONS TABLE
        Schema::create('user_recomment_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('recomment_id');
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
        Schema::dropIfExists('user_recomment_relations');
    }
}
