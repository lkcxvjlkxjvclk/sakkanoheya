<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentNameColumnOnNovelChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('novel_chapters', function (Blueprint $table) {
            $table->string('chapter_name');
            $table->string('chapter_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('novel_chapters', function (Blueprint $table) {
            $table->dropColumn('chapter_name');
            $table->dropColumn('chapter_content');
        });
        
    }
}
