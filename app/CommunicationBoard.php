<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommunicationBoard extends Model
{
    // @param
    public function newBoardD($data)
    {
        $dataSet = [];

        $dataSet = [
            'writer_name' => $data['writer_name'],
            'board_title' => $data['board_title'],
            'board_content' => $data['board_content'],
        ];

        // print_r($dataSet);

        $community_board_id = DB::table('communication_boards')->insertGetId($dataSet);

        return $community_board_id;
    }

    // community board LIST
    // @param $blogId (DataType : INT)
    public function allBoardD($id) 
    {
        $blogId = $id;
        $boardData = DB::table('communication_boards')
                            ->join('communication_relations', 'communication_boards.id', '=', 'communication_relations.board_id')
                            ->join('blog_communication_relations', 'communication_relations.communication_id', '=', 'blog_communication_relations.communication_id')
                            ->select('blog_communication_relations.*', 'communication_boards.id', 'communication_boards.board_title', 'communication_boards.writer_name', 'communication_boards.created_at')
                            ->where('blog_communication_relations.blog_id', '=', $blogId)
                            ->orderBy('communication_boards.created_at', 'desc')
                            ->get();


        return $boardData;
    }

    // community selected board
    // JOIN communication_relations(TABLE)
    // @param $communityId, $boardId (DataType INT)
    public function selectedBoardD($communityId, $boardId)
    {
        //
        $boardData = DB::table('communication_boards')
                            ->join('communication_relations', 'communication_relations.board_id', '=', 'communication_boards.id')
                            ->where('communication_relations.board_id', '=', $boardId)
                            ->where('communication_relations.communication_id', '=', $communityId)
                            ->select('communication_boards.*')
                            ->get();

        return $boardData;
    }
}
