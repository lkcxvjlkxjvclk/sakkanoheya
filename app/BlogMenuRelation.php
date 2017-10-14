<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogMenuRelation extends Model
{
    //
    public function insertRelationD($blog_id, $blog_menu_id) {
        $dataSet = [];
        $dataSet = [
            'blog_id' => $blog_id,
            'blog_menu_id' => $blog_menu_id,
        ];
        // print_r($dataSet);

        DB::table('blog_menu_relations')->insert($dataSet);
    }
}
