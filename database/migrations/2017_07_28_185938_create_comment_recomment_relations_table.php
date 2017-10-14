<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRecommentRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // COMMENT_RECOMMENT_RELATIONS TABLE
        Schema::create('comment_recomment_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id');
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
        Schema::dropIfExists('comment_recomment_relations');
    }
}
