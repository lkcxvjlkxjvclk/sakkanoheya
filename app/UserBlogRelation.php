<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserBlogRelation extends Model
{
    //
    public function insertRelationD($user_id, $blog_id) {
        $dataSet = [];

        $dataSet = [
            'user_id' => $user_id,
            'blog_id' => $blog_id,
        ];

        DB::table('user_blog_relations')->insert($dataSet);
    }

    // user_blog_relations(TABLE) SELECT *
    // JOIN users(TABLE)
    // @param $user_id (DataType : STRING)
    public function allUserBlogRD($id) 
    {
        // echo $id;
        $userBlogRData = DB::table('user_blog_relations')
            ->join('users', 'user_blog_relations.user_id', '=', 'users.id')
            ->select('user_blog_relations.blog_id', 'users.id', 'users.user_id', 'users.name')
            ->where('users.user_id', '=', $id)
            ->get();

        return $userBlogRData;
    }

    // user_blog_relations(TABLE) SELECT * user_id (DataType : INT)
    // JOIN users(TABLE)
    // @param $ownerId (DataType : STRING)
    // @return $user_id, $blog_id (DataType : INT)
    public function checkUserId($ownerId) 
    {
        $userBlogRData = DB::table('user_blog_relations')
            ->join('users', 'user_blog_relations.user_id', '=', 'users.id')
            ->select('user_blog_relations.*')
            ->where('users.user_id', '=', $ownerId)
            ->get();

        return $userBlogRData;
    }
}
