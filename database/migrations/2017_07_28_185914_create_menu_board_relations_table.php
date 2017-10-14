<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuBoardRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // MENU_BOARD_RELATIONS TABLE
        Schema::create('menu_board_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_menu_id');
            $table->integer('blog_board_id');
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
        Schema::dropIfExists('menu_board_relations');
    }
}
