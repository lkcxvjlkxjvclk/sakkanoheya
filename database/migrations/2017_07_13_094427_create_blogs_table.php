<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // BLOGS TABLE
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            // 이건 회원 추가 되면 $table->string('user_id');
            //$table->string('cover_img_src')->nullable();    // BLOG COVER IMG
            $table->text('blog_introduce'); // BLOG INTRODUCE TEXT
            $table->integer('today_hit')->default(0);   // BLOG TODAY HIT
            $table->integer('total_hit')->default(0);   // BLOG TOTAL HIT
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
        Schema::dropIfExists('blogs');
    }
}
