<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // BLOG BOARDS TABLE
        Schema::create('blog_boards', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('blog_menu_id');    // BLOG MENU ID : blog_menus table 'id'
            $table->string('board_title');  // BOARD TITLE
            $table->string('is_notice')->nullable(); // NOTICE on
            // 이건 회원 추가 되면 $table->string('user_id');   // BOARD WRITER
            $table->integer('board_hit')->nullable();   // HIT NUMBER
            $table->integer('board_like')->nullable();    // LIKE NUMBER
            $table->mediumText('board_content'); // BOARD CONTENT
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('blog_boards');
    }
}
