<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Relation_list extends Model
{
    /****************************
    JJH 2017.08.02
    SELECT *
    FROM relation_lists, novel_backgrounds
    WHERE relation_lists id = novel_backgrounds background_id
    WHERE novel_backgrounds novel_background = relation 
    WHERE novel_backgrounds belong_to_novel = $novel_id
    *****************************/
    public function get_data_by_novel_id($novel_id){
        $dataSet = DB::table('relation_lists')
                    ->join('novel_backgrounds','relation_lists.id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','relations')
                    ->get();

        // var_dump($dataSet);
        return $dataSet;
    }

    public function get_relation_src($relation_id){
        $relation_src = DB::table('relation_lists')->select('cover_src')->where('id',$relation_id)->get();
        // var_dump($relation_id);
        return $relation_src;
    }

    public function none_set_open_background($id) {
        $data = DB::table('relation_lists')
                ->where('relation_lists.id','=',$id)
                ->get();
        // var_dump($id);
        return $data;
    }
}
