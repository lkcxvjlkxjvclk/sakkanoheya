<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogMenuRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // BLOG_MENU_RELATIONS TABLE
        Schema::create('blog_menu_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id');
            $table->integer('blog_menu_id');
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
        Schema::dropIfExists('blog_menu_relations');
    }
}
