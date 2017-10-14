<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class open_map extends Model
{
    public function insert_open_map($map_info){
        $dataSet = [];
        $dataSet = [
            'title' => $map_info['title'],
            'cover_src' => $map_info['cover_src'],
        ];
        // data insert
        $id = DB::table('open_maps')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }
}
?>