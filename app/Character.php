<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Character extends Model
{
    public function insert_character($character_info, $img_src){
        $dataSet = [];
        $dataSet = [
            'name' => $character_info['character_name'],
            'info' => $character_info['character_content'],
            'age' => $character_info['age'],
            'gender' => $character_info['gender'],
            'refer_info' => $character_info['refer_info'],
            'img_src' => $img_src,
        ];
        // data insert
        $id = DB::table('characters')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    public function dataBringAll(){
        // characters 전체 data 가져오기
        $dataSet = DB::table('characters')->get();
        // var_dump($dataSet);

        return $dataSet;
    }

    public function get_affect_data($id){
        $dataSet = DB::table('characters')
                    ->select('img_src')
                    ->where('cha_id',$id)
                    ->get();

        return $dataSet;
    }

    // JJH 2017.07.31
    // SELECT * FROM characters, novel_backgrounds
    // WHERE characters.id = novel_backgrounds.background_id
    // WHERE novel_backgrounds.novel_background = characters
    // WHERE novel_bakcgrounds.belong_to_novel = $novel_id
    public function date_get_novel_id($novel_id){
        $dataSet = DB::table('characters')
                    ->join('novel_backgrounds','characters.cha_id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','characters')
                    ->get();

        // var_dump($dataSet);
        return $dataSet;
    }

    public function none_set_open_background($id) {
        $data = DB::table('characters')
                ->where('characters.cha_id','=',$id)
                ->get();
        // var_dump($id);
        return $data;
    }
}
