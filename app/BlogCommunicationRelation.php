<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogCommunicationRelation extends Model
{
    // blog_communication_relations(TABLE) INSERT DATA
    // @param $blog_id, $communication_menu_id (DataType : INT)
    public function insertData($blogId, $commuId) {
        $dataSet = [];

        $dataSet = [
            'blog_id' => $blogId,
            'communication_id' => $commuId,
        ];

        DB::table('blog_communication_relations')->insert($dataSet);
    }

    // @param $blog_id (DataType INT)
    public function checkCommunityId($blogId) {
        $community_id = DB::table('blog_communication_relations')
                            ->select('communication_id')
                            ->where('blog_id', '=', $blogId)
                            ->get();

        return $community_id;
    }
}
