<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_relation_list extends Model
{
    //
    public function insert_open_relation($relation_info){
        $dataSet = [];
        $dataSet = [
            'title' => $relation_info['title'],
            'cover_src' => $relation_info['cover_src'],
        ];
        // data insert
        $id = DB::table('open_relation_lists')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }
}
