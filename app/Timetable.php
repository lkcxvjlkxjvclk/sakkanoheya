<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{
    // table에 data insert 하기
    public function insert_table($table){
        // dataSet
        $dataSet = [];
        $dataSet = [
            'event_names' => $table['event_name'],
            'event_contents' => $table['event_content'],
            'start_days' => $table['start_day'],
            'end_days' => $table['end_day'],
            'others' => $table['other'],
            'refer_info' => $table['refer_info'],
        ];
        // data insert
        $id = DB::table('timetables')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }

    public function dataBringAll(){
        // timetables 전체 data 가져오기
        $dataSet = DB::table('timetables')->get();
        // var_dump($dataSet);

        return $dataSet;
    }

    // JJH 2017.07.31
    // SELECT * FROM timetables, novel_backgrounds
    // WHERE timetables.id = novel_backgrounds.background_id
    // WHERE novel_backgrounds.novel_background = timetables
    // WHERE novel_bakcgrounds.belong_to_novel = $novel_id
    public function date_get_novel_id($novel_id){
        $dataSet = DB::table('timetables')
                    ->join('novel_backgrounds','timetables.id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','timetables')
                    ->get();

        // var_dump($dataSet);
        return $dataSet;
    }

    // JJH 2017.07.27 
    // select * from timetable, novel_has_background
    // where novel_has_background 'kind' = timetable
    // where novel_has_background 'background_id' = timetalb 'id'
    // whereNotIn timetable 'id', $chapter_has_id
    public function get_timetable_notIn_chapter($novel_id,$timetable_id) { 
        $data = DB::table('timetables')
                // 소설 설정 종속 이후 구현하기
                // ->where
                ->whereNotIn('id',$timetable_id)     
                ->get();
        
        return $data;
    }

    // JJH 2017.07.28
    // select * from timetable where id = timetable_id
    public function get_timetable_into_chapter($timetable_id) {
        $data = DB::table('timetables')
                ->where('id',$timetable_id)
                ->get();

        return $data;
    }

    public function none_set_open_background($id) {
        $data = DB::table('timetables')
                ->where('timetables.id','=',$id)
                ->get();
        // var_dump($id);
        return $data;
    }
}
