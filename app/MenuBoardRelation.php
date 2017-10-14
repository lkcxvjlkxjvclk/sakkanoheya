<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuBoardRelation extends Model
{
    //
    public function insertRelationD ($blog_menu_id, $blog_board_id) {
        $dataSet = [];
        $dataSet = [
            'blog_menu_id' => $blog_menu_id,
            'blog_board_id' => $blog_board_id,
        ];
        // print_r($dataSet);

        DB::table('menu_board_relations')->insert($dataSet);
    }
}
