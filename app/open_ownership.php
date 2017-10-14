<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_ownership extends Model
{
    public function insert_open_ownership($character_id,$item_id){
        $dataSet = [];
        $dataSet = [
            'character_id' => $character_id,
            'item_id' => $item_id,
        ];
        // data insert
        $id = DB::table('open_ownerships')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    /****************************************
    JJH 2017.08.06
    SELECT *
    FROM open_ownerships, items
    WHERE character_id = $character_id
    ****************************************/
    public function get_open_ownership_by_character_id($character_id){
        $data = DB::table('open_ownerships')
                ->join('items','open_ownerships.item_id','=','items.id')
                ->where('open_ownerships.character_id',$character_id)
                ->get();
        
        // var_dump($data);
        return $data;
    }
}
