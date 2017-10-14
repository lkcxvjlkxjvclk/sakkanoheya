<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    public function insert_item($item_info, $img_src){
        $dataSet = [];
        $dataSet = [
            'name' => $item_info['item_name'],
            'info' => $item_info['item_content'],
            'category' => $item_info['item_cate'],
            'refer_info' => $item_info['refer_info'],
            'img_src' => $img_src,
        ];
        // data insert
        $id = DB::table('items')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    public function dataBringAll(){
        // items 전체 data 가져오기
        $dataSet = DB::table('items')->get();
        // var_dump($dataSet);

        return $dataSet;
    }

    public function itemListBringAll(){
        $dataSet = DB::table('items')->select('id','name','img_src')->get();
 
        return $dataSet;
    }

    public function get_item_src($item_id){
        $item_src = DB::table('items')->select('id','img_src')->where('id',$item_id)->get();

        return $item_src;
    }

    // JJH 2017.07.31
    // SELECT * FROM items, novel_backgrounds
    // WHERE items.id = novel_backgrounds.background_id
    // WHERE novel_backgrounds.novel_background = items
    // WHERE novel_bakcgrounds.belong_to_novel = $novel_id
    public function date_get_novel_id($novel_id){
        $dataSet = DB::table('items')
                    ->join('novel_backgrounds','items.id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','items')
                    ->get();

        // var_dump($dataSet);
        return $dataSet;
    }

    public function none_set_open_background($id) {
        $data = DB::table('items')
                ->where('items.id','=',$id)
                ->get();
        // var_dump($id);
        return $data;
    }
}
