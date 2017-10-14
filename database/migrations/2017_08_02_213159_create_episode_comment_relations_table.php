<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodeCommentRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // EPISODE_COMMENT_RELATIONS TABLE
        Schema::create('episode_comment_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episode_id');
            $table->integer('comment_id');
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
        Schema::dropIfExists('episode_comment_relations');
    }
}
