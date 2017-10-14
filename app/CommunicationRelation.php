<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommunicationRelation extends Model
{
    // @param $community_id, $community_board_id DataType INT
    public function insertRelationD($communityId, $boardId)
    {
        //
        $community_id = $communityId;
        $board_id = $boardId;

        $dataSet = [];

        $dataSet = [
            'communication_id' => $community_id,
            'board_id' => $board_id,
        ];

        DB::table('communication_relations')->insert($dataSet);
    }
}
