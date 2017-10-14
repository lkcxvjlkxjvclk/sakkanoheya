<?php

namespace App\Http\Controllers;

use App\Novel;
use App\Novel_chapter;
use App\Episode;
use App\Novel_has_chapter;
use App\Chapter_has_episode;
use App\Timetable;
use App\Chapter_has_timetable;

use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // session_start();
        $novel_id = $_COOKIE['novel_id'];
        $url = 'chapter/'.$novel_id;
        return redirect($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // var_dump($data['novel_id']);
        $chapter = new Novel_chapter();
        $novel_has_chapter = new Novel_has_chapter();

        $chapter_id = $chapter->new_chater($data);
        $novel_has_chapter->add_chapter($data['novel_id'],$chapter_id);

        $redirect_url = 'chapter/'.$data['novel_id'];

        return redirect($redirect_url);
    }

    public function add_episode(Request $request) 
    {
        $chapter_has_episode = new Chapter_has_episode();
        $data = $request->all();
        $chapter_id = $data['chapter_id'];
        for($i = 0; $i < count($data['episode_id']) ; $i++) {
            $chapter_has_episode->add_episode($chapter_id,$data['episode_id'][$i]);
        }
        // echo $data['episode_id'][0];
        

        // var_dump($data['episode_id']);
        $novel_id = $_COOKIE['novel_id'];
        $redirect_url = 'chapter/'.$novel_id;

        return redirect($redirect_url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($novel_id)
    {
        $chapters_controller = new ChaptersController();
        $novel = new Novel();
        $episode = new Episode();
        $novel_has_chapter = new Novel_has_chapter();
        $chapter_has_episode = new Chapter_has_episode();    

        $novel_data = $novel->basicData($novel_id);
        $novel_relation = $novel_has_chapter->get_data($novel_id);
        
        // session_start();
        // echo($_SESSION['novel_id']);
        $_COOKIE['novel_id'] = $novel_id;
            
        
        
        $data = $chapters_controller->novel_data_array($novel_data,$novel_relation);

        // var_dump($chapter_data);
        // echo($data['novel_title']);
        return view('background.chapter.chapter_main')->with("data",$data);
    }

    private function novel_data_array($novel_data,$novel_relation){
        $data = array(array(array()));
        $novel_chapter = new Novel_chapter();

        // novel data make array
        $data['novel']['id'] = $novel_data[0]->id;
        $data['novel']['title'] = $novel_data[0]->title;
        $data['novel']['intro'] = $novel_data[0]->intro;
        $data['novel']['summary_intro'] = $novel_data[0]->summary_intro;
        $data['novel']['cover_img_src'] = $novel_data[0]->cover_img_src;
        $data['novel']['publish_case'] = $novel_data[0]->publish_case;
        $data['novel']['genre'] = $novel_data[0]->genre;
        $data['novel']['created_at'] = $novel_data[0]->created_at;
        $data['novel']['updated_at'] = $novel_data[0]->updated_at;
        // echo $data['novel']['id'];
        // chapter data make array
        $i = 0;
        foreach($novel_relation as $datas){
            $chapter_data = $novel_chapter->get_data($datas->chapter_id);
            // var_dump($chapter_data);
            $data['chapter'][$i]['chapter_id'] = $datas->chapter_id;
            $data['chapter'][$i]['chapter_name'] = $chapter_data[0]->chapter_name;
            $data['chapter'][$i]['chapter_content'] = $chapter_data[0]->chapter_content;
            $i++;
        }
        // chapter data make array
        
        // chapter realtion data make array

        // episode data make array


        return $data;
    }

    public static function chapter_modal(){
        return view('background.chapter.chapter_modal');
    }

    public function get_episode($id) {

        $episode = new Episode();
        $chapter_has_episode = new Chapter_has_episode();

        $episode_id = $chapter_has_episode->get_episode_id($id);

        $episode_datas = array(array());
        $i = 0;
        
        if(isset($episode_id)) {
            foreach($episode_id as $one_episode) {
                // echo($one_episode->episode_id);
                $episode_data = $episode->get_episode_by_episode_id($one_episode->episode_id);
                // var_dump($episode_data[0]);
                $episode_datas[$i]['id'] = $episode_data[0]->id;
                $episode_datas[$i]['cover_img_src'] = $episode_data[0]->cover_img_src;
                $episode_datas[$i]['episode_title'] = $episode_data[0]->episode_title;
                $episode_datas[$i]['char_count'] = $episode_data[0]->char_count;
                $episode_datas[$i]['episode'] = $episode_data[0]->episode;

                $i++;
            }
        }
        
        
        // var_dump($episode_datas);
        return($episode_datas);
    }

    public function get_no_episode($id,$this_chapter_id){
        $episode = new Episode();
        $novel_has_chapter = new Novel_has_chapter();
        $chapter_has_episode = new Chapter_has_episode();

        // 노벨이 가지고 있는 챕터 정보
        $chapter_id = $novel_has_chapter->get_chapter_id($id);
        $i = 0;
        $chapter_data = array();
        if(isset($chapter_id)){
            foreach($chapter_id as $chapter) {
                $chapter_data[$i] = $chapter->chapter_id;
                $i++;
            }
        }

        // var_dump($chapter_data);
        $episode_ids = array();
        $episode_count = 0;
        // chapter_data 가 있으면
        if(isset($chapter_data)) {
            for($i = 0 ; $i < count($chapter_data) ; $i++ ){
                // DB로부터 데이터 불러옴
                $episode_data = $chapter_has_episode->get_episode_id($chapter_data[$i]);
                // 불러온 데이터가 있으면
                if(isset($episode_data)){
                    // 각 불러온 데이터의 id를 저장
                    foreach($episode_data as $one_episode){
                        $episode_ids[$episode_count] = $one_episode->episode_id;
                        $episode_count++;
                    }
                }  
            }
        }
        // var_dump($episode_ids);
        
        $episode_datas = $episode->get_episode($episode_ids,$id);
        // var_dump($episode_datas);
        $episode_data_not_chapter = array(array());
        // 챕터 입력을 위한 변수 선언
        $episode_data_not_chapter['chapter_id'] = $this_chapter_id;
        $i = 0;
        foreach($episode_datas as $temp_episode_data) {
            $episode_data_not_chapter[$i]['id'] = $temp_episode_data->id;
            $episode_data_not_chapter[$i]['cover_img_src'] = $temp_episode_data->cover_img_src;
            $episode_data_not_chapter[$i]['episode'] = $temp_episode_data->episode;
            $episode_data_not_chapter[$i]['episode_title'] = $temp_episode_data->episode_title;
            $episode_data_not_chapter[$i]['char_count'] = $temp_episode_data->char_count;

            $i++;
        }

        // var_dump($episode_data_not_chapter[0]);
        return view('background.chapter.episode_modal')->with("data",$episode_data_not_chapter);
    }

    // 챕터에 등록되어 있는 timetable을 가져온다.
    public function get_timetable($novel_id,$chapter_id){
        // 소설에서 설정 id가져오고 그것의 정보를 가져오는 형식으로 구현

        $chapter_has_timetable = new Chapter_has_timetable();
        $timetable = new Timetable();

        $timetable_id = $chapter_has_timetable->chapter_has_timetable_id($chapter_id);
        
        $i = 0;
        $timetable_data = array(array());
        foreach($timetable_id as $temp_timetable_id) {
            $data = $timetable->get_timetable_into_chapter($temp_timetable_id->id);

            $timetable_data[$i]['id'] = $data[0]->id;
            $timetable_data[$i]['event_name'] = $data[0]->event_names;
            $timetable_data[$i]['event_content'] = $data[0]->event_contents;
            $timetable_data[$i]['start_day'] = $data[0]->start_days;
            $timetable_data[$i]['end_day'] = $data[0]->end_days;

            $i++;
        }

        return $timetable_data;
    }

    public function bring_timetable($novel_id,$chapter_id){
        // chapter_has_timetables에서 해당 챕터의 사건 정보 가져오기.
        $chapter_has_timetable = new Chapter_has_timetable();
        $timetable = new Timetable();

        $chapter_timetable_id = $chapter_has_timetable->chapter_has_timetable_id($chapter_id);
        
        // query에서 notin을 쓰기위한 배열화
        $timetable_id = array();
        $i=0;
        if(isset($chapter_timetable_id)){
            foreach($chapter_timetable_id as $temp_chapter_timetable) {
                $timetable_id[$i] = $temp_chapter_timetable->timetable_id;
                $i++;
            }
        }

        $none_has_timetable = $timetable->get_timetable_notIn_chapter($novel_id,$timetable_id);

        $data = array(array());
        // $data['chapter_id'] = $chapter_id;
        // session_start();
        $_COOKIE['chapter_id'] = $chapter_id;
        $i = 0;
        if(isset($none_has_timetable)){
            foreach($none_has_timetable as $temp_none_has_timetable) {
                $data[$i]['id'] = $temp_none_has_timetable->id;
                $data[$i]['event_name'] = $temp_none_has_timetable->event_names;
                $data[$i]['event_content'] = $temp_none_has_timetable->event_contents;
                $data[$i]['start_day'] = $temp_none_has_timetable->start_days;
                $data[$i]['end_day'] = $temp_none_has_timetable->end_days;
                $i++;
            }
        }
        // var_dump($data);
        return view('background.chapter.timetable_modal')->with("data",$data);
        
    }

    public function add_timetable(Request $request) {
        // session_start();
        // session_unset("chapter_id");
        $data = $request->all();
        $chapter_has_timetable = new Chapter_has_timetable();
        for($i = 0; $i < count($data['timetable_id']) ; $i++ ){
            $chapter_has_timetable->insert_timetable_id($data['chapter_id'],$data['timetable_id'][$i]);
        }
        
        var_dump($data);
        $hostname = explode('/',$data['hostname']);
        var_dump($hostname);
        $url = $hostname[1]."/".$hostname[3];
        return redirect($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
