<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Novel extends Model
{
    // 
    

    // TABLE : novels SELECT
    public function mainData() {
        $novelData = DB::table('novels')->get();

        return $novelData;
    }

    // TABLE : novels SELECT
    public function basicData($id) {

        $novelData = DB::table('novels')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return $novelData;
    }

    // TABLE : novels SELECT // JOIN TABLE : novel_episodes
    public function dataJoinEpisode($id) {

        $novelData = DB::table('novels')
            ->join('novel_episodes', 'novels.id', '=', 'novel_episodes.belong_to_novel')
            ->select('novels.*', 'novel_episodes.belong_to_novel', 'novel_episodes.episode_title', 'novel_episodes.cover_img_src AS episode_cover_src', 'novel_episodes.created_at')
            ->where('novels.id', '=', $id)
            ->where('novel_episodes.belong_to_novel', '=', $id)
            ->orderBy('novel_episodes.id', 'desc')
            ->get();

        return $novelData;
    }

    // TABLE : novels SELECT // JOIN TABLE : novel_backgrounds
    // @param $id (INT)
    public function dataJoinBackground($id) {

        $novelData = DB::table('novels')
            ->join('novel_has_open_backgrounds', 'novels.id', '=', 'novel_has_open_backgrounds.novel_id')
            ->select('novels.title', 'novel_has_open_backgrounds.background_id')
            ->where('novels.id', '=', $id)
            ->where('novel_has_open_backgrounds.novel_id', '=', $id)
            ->get();

        return $novelData;
    }
}
