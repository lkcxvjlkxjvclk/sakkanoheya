<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Member extends Model
{
    public function formstore($data) {
        $user_id = Input::get('user_id');
        $pass = Input::get('password');
        $email = Input::get('email');

        $users = new Register();

        $users->name = $user_id;
        $users->password = $pass;
        $users->email = $email;

        $users->save();
    }
}
