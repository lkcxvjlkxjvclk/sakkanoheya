<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Storage;
use File;

class Map extends Model
{
    public function dataBringAll(){
        // maps 전체 data 가져오기
        $dataSet = DB::table('maps')->get();
        // var_dump($dataSet);

        return $dataSet;
    }

    public function get_map_src($map_id){
        $map_src = DB::table('maps')->select('cover_src')->where('id',$map_id)->get();

        return $map_src;
    }

    public function none_set_open_background($id) {
        $data = DB::table('maps')
                ->where('maps.id','=',$id)
                ->get();
        // var_dump($id);
        return $data;
    }
}
