<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Novel_chapter extends Model
{   
    public function new_chater($data){
        $dataSet = [];
        $dataSet = [
            'chapter_name' => $data['chapter_name'],
            'chapter_content' => $data['chapter_content'],
        ];
        // data insert
        $id = DB::table('novel_chapters')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    public function get_data($chapter_id){
        $chapter_data = DB::table('novel_chapters')->where('id','=',$chapter_id)->get();

        return $chapter_data;
    }
}
