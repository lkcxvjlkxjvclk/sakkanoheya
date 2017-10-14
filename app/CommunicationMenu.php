<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommunicationMenu extends Model
{ 
    // communication_menus(TABLE) INSERT DATAS
    public function newCommunicationD() {
        $dataSet = [];

        $dataSet = [
            'menu' => 'communication',
        ];

        // print_r($dataSet);

        $communication_menu_id = DB::table('communication_menus')->insertGetId($dataSet);

        return $communication_menu_id;
    }
}
