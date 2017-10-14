<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    // search User Id (DataType : INT)
    // @param $id (DataType : STRING)
    public function searchUserId ($id)
    {
        $user_id = DB::table('users')
            ->select('id')
            ->where('user_id', '=', $id)
            ->get();
        
        return $user_id;
    }
}
