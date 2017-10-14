<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Relation extends Model
{
    public function dataBringAll(){
        // relations 전체 data 가져오기
        $dataSet = DB::table('relations')->get();
        // var_dump($dataSet);

        return $dataSet;
    }
}
