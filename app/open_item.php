<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_item extends Model
{
    public function insert_open_item($item_info){
        $dataSet = [];
        $dataSet = [
            'name' => $item_info['name'],
            'info' => $item_info['info'],
            'category' => $item_info['category'],
            'img_src' => $item_info['img_src'],
        ];
        // data insert
        $id = DB::table('open_items')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }
}
