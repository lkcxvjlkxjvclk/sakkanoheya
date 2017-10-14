<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chapter_has_episode extends Model
{
    //
    public function get_episode_id($chapter_id){
        $data = DB::table('chapter_has_episodes')
                ->select('episode_id')
                ->where('chapter_id','=',$chapter_id)
                ->get();
        
        return $data;
    }

    public function add_episode($chapter_id, $episode_id) {
        $data = array();
        $data = [
            'chapter_id' => $chapter_id,
            'episode_id' => $episode_id
        ];

        DB::table('chapter_has_episodes')->insert($data);
    }
}
