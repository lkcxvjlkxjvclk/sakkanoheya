<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // BLOG FILES TABLE
        Schema::create('blog_files', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('blog_board_id');   // BLOG BOARD ID :  blog_boards table 'id'
            $table->string('blog_file_type');   
            // BLOG UPLOAD FILE TYPE
            // image, video, file
            $table->string('blog_file_src');
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
        //
        Schema::dropIfExists('blog_files');
    }
}
