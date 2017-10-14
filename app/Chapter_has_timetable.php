<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chapter_has_timetable extends Model
{
    //
    public function chapter_has_timetable_id($chapter_id){
        $data = DB::table('chapter_has_timetables')
                    ->where('chapter_id','=',$chapter_id)
                    ->get();

        return $data;
    }

    public function insert_timetable_id($chapter_id,$timetable_id){
        $dataSet = array();
        $dataSet = [
            'chapter_id' => $chapter_id,
            'timetable_id' => $timetable_id
        ];

        DB::table('chapter_has_timetables')->insert($dataSet);
    }
}
