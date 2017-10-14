<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_character extends Model
{
    public function insert_open_character($character_info){
        $dataSet = [];
        $dataSet = [
            'name' => $character_info['name'],
            'info' => $character_info['info'],
            'age' => $character_info['age'],
            'gender' => $character_info['gender'],
            'img_src' => $character_info['img_src'],
        ];
        // data insert
        $id = DB::table('open_characters')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    public function get_open_charcter_with_ownership($character_id){
        // var_dump($character_id);
        $data = DB::table('open_characters')
            ->where('open_characters.id','=',$character_id)
            ->get();
        
        // var_dump($data);
        return $data;
    }
}
