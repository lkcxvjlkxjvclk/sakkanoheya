<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Novel_has_chapter extends Model
{
    public function add_chapter($novel_id, $chapter_id){
        $dataSet = [];
        $dataSet = [
            'novel_id' => $novel_id,
            'chapter_id' => $chapter_id,
        ];
        // data insert
        $id = DB::table('novel_has_chapters')->insert($dataSet);
        // var_dump($table);
    }

    public function get_data($novel_id){
        $novel_relation_data = DB::table('novel_has_chapters')->where('novel_id','=',$novel_id)->get();

        return $novel_relation_data;
    }

    public function get_chapter_id($novel_id){
        $data = DB::table('novel_has_chapters')
                ->select('chapter_id')
                ->where('novel_id','=',$novel_id)
                ->get();
        
        // var_dump($data);
        return $data;
    }
}
