<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class open_timetable extends Model
{
    public function insert_open_timetable($timetable_info){
        $dataSet = [];
        $dataSet = [
            'event_names' => $timetable_info['event_names'],
            'event_contents' => $timetable_info['event_contents'],
            'start_days' => $timetable_info['start_days'],
            'end_days' => $timetable_info['end_days'],
            'others' => $timetable_info['others'],
        ];
        // data insert
        $id = DB::table('open_timetables')->insertGetId($dataSet);
        // var_dump($table);
        return $id;
    }
}
