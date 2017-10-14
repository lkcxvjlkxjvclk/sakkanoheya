<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    public function insertTag($tag_data){
        $dataSet = [];
        $dataSet = [
            'kind' => $tag_data['page'],
            'object_id' => $tag_data['object_id'],
            'color' => $tag_data['tag_color'],
            'tag_name' => $tag_data['tag_name'],
        ];
        // data insert
        DB::table('tags')->insert($dataSet);
        // var_dump($table);
    }

    public function tagBring($page){
            // tags 전체 data 가져오기
            $tag_data = DB::table('tags')->where('kind',$page)->get();
            // var_dump($dataSet);

            return $tag_data;
    } 
}
