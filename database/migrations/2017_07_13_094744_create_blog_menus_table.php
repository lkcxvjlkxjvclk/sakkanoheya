<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // BLOG MENUS TABLE
        Schema::create('blog_menus', function (Blueprint $table) {
            $table->increments('id');   // BLOG MENU ID
            // $table->integer('blog_id'); // BLOG ID : blogs table 'id'
            $table->string('menu_title');   // BLOG MENU TITLE
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
        Schema::dropIfExists('blog_menus');
    }
}
