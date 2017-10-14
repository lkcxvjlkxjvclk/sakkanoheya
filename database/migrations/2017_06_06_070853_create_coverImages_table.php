<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoverImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 회원별 보유 커버 이미지 리스트 테이블
        Schema::create('cover_images', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('cover_img_src');
        });

        // Schema::table('cover_images', function (Blueprint $table) {
        //   $table->foreign("user_id")->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cover_images');
        //
    }
}
