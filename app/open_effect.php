<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_effect extends Model
{
    public function insert_open_effect($table_id, $data, $effect_kind){
        $dataSet = [];
        // var_dump($data);
        // 등장인물 데이터 insert
        if($effect_kind == "characters"){
            // echo((int)$data['characters']['id'][$i]);
            $dataSet = [
                'timetable_id' => (int)$table_id,
                'affect_table' => "characters",
                'affect_id' => (int)$data['characters']['id'],
                'affect_content' => (string)$data['characters']['content'],
            ];
            
            DB::table('open_effects')->insert($dataSet);
        }
        
        // 등장사물 데이터 insert
        if($effect_kind == "items"){
            $dataSet = [
                'timetable_id' => (int)$table_id,
                'affect_table' => "items",
                'affect_id'=>(int)$data['items']['id'],
                'affect_content'=>(string)$data['items']['content'],
            ];
            DB::table('open_effects')->insert($dataSet);   
        }

        // 배경장소 데이터 insert
        if($effect_kind == "maps"){
            $dataSet = [
                'timetable_id'=>(int)$table_id,
                'affect_table'=>"maps",
                'affect_id'=>(int)$data['maps']['id'],
                'affect_content' => (string)$data['maps']['content'],
            ];
            // var_dump($dataSet);
            DB::table('open_effects')->insert($dataSet);
        }

        if($effect_kind == "relations"){
            $dataSet = [
                'timetable_id'=>(int)$table_id,
                'affect_table'=>"relations",
                'affect_id'=>(int)$data['relations']['id'],
                'affect_content' => (string)$data['relations']['content'],
            ];
            // var_dump($dataSet);
            DB::table('open_effects')->insert($dataSet);
        }
    }
    public function get_open_effect_data($table_id){
        $effect_data = DB::table('open_effects')
        ->select('affect_table','affect_id','affect_content')
        ->where('timetable_id',$table_id)
        ->get();
        
        return $effect_data;
    }
    
    /*
     * JHM
     * open_character
     */
    public function get_open_character_data($table_id) {
        $effect_data = DB::table('open_effects')
                    ->join('characters', 'open_effects.affect_id', '=', 'characters.cha_id')
                    ->select('open_effects.affect_content')
                    ->where('open_effects.timetable_id', '=', $table_id)
                    ->where('open_effects.affect_table', '=', 'characters')
                    ->get();
        
        return $effect_data;
    }

    /*
     * JHM
     * open_item
     */
    public function get_open_item_data($table_id) {
        $effect_data = DB::table('open_effects')
                    ->join('items', 'open_effects.affect_id', '=', 'items.id')
                    ->select('open_effects.affect_content')
                    ->where('open_effects.timetable_id', '=', $table_id)
                    ->where('open_effects.affect_table', '=', 'items')
                    ->get();
        
        return $effect_data;
    }

    /*
     * JHM
     * open_map
     */
    public function get_open_map_data($table_id) {
        $effect_data = DB::table('open_effects')
                    ->join('maps', 'open_effects.affect_id', '=', 'maps.id')
                    ->select('open_effects.affect_content')
                    ->where('open_effects.timetable_id', '=', $table_id)
                    ->where('open_effects.affect_table', '=', 'maps')
                    ->get();
        
        return $effect_data;
    }

}
