<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\novel_has_open_background;
use App\Background;
use App\Character;
use App\Item;
use App\Timetable;
use App\Relation_list;
use App\Ownership;
use App\Effect;
use App\Map;
use App\open_character;
use App\open_ownership;
use App\open_item;
use App\open_timetable;
use App\open_effect;
use App\open_relation_list;
use App\open_map;

class BackgroundShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_COOKIE['novel_id'])){
            $novel_id = $_COOKIE['novel_id'];
        }
        else{
            return redirect('write_novel/my_novel');
        }
        // var_dump($novel_id);
        //
        return view('background.share.set_share_view');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function get_background($kind){
        $novel_has_open_background = new novel_has_open_background();
        $background = new Background;
        $open_character = new open_character();
        $open_ownership = new open_ownership();
        // $open_relation_list = new open_relation_list;
        $novel_id = $_COOKIE['novel_id'];

        $set_open_background_id = array();
        $set_open_background_data = array(array());
        $none_open_background_data = array(array(array()));

        $i = 0;
        $j = 0;
        // 소설에 등록된 공개 설정 된 설정 id가져오기
        $set_open_background = $novel_has_open_background->get_background_id_by_novel_id($novel_id,$kind);

        if(isset($set_open_background[0])){

            foreach($set_open_background as $temp_set_open_background){
                if($temp_set_open_background->background_kind == "characters"){
                    $open_character_data = $open_character->get_open_charcter_with_ownership($temp_set_open_background->open_background_id);
                }

                // 기존 설정 notin 을 위한 배열
                $set_open_background_id[$i] = $temp_set_open_background->background_id;
                $i++;
                // 설정 되어 있는 설정을 불러오기 위한 처리 희망
            }
        }

        // 공개 되지 않은 data id 가져오기
        $none_open_background = $background->get_none_open_background($novel_id,$set_open_background_id,$kind);
        // var_dump($set_open_background);
        $i = 0;

        // character 일 경우
        if($kind == "characters") {
            $character = new Character();
            $ownership = new Ownership();
            foreach($none_open_background as $temp_none_open_background){
                // 공개 설정 되어 있지 않은 character data 가져오기
                $temp_none_open_background_data = $character->none_set_open_background($temp_none_open_background->background_id);
                // var_dump($temp_none_open_background_data);
                foreach($temp_none_open_background_data as $temp_data){
                    $none_open_background_data[$i]['id'] = $temp_data->cha_id;
                    $none_open_background_data[$i]['name'] = $temp_data->name;
                    $none_open_background_data[$i]['info'] = $temp_data->info;
                    $none_open_background_data[$i]['age'] = $temp_data->age;
                    $none_open_background_data[$i]['gender'] = $temp_data->gender;
                    $none_open_background_data[$i]['refer_info'] = $temp_data->refer_info;
                    $none_open_background_data[$i]['img_src'] = $temp_data->img_src;
                }

                // 소유 사물 id 가져오기
                $ownership_data = $ownership->get_ownership($none_open_background_data[$i]['id']);

                foreach($ownership_data as $temp_ownership_data) {
                    $item = new Item();

                    $item_id = array();
                    $item_id = explode("+",$temp_ownership_data->item_id);

                    for($j = 0 ; $j < count($item_id) ; $j++ ){
                        // 소유 사물 img 주소 가져오기
                        $ownership_img_src = $item->get_item_src($item_id[$j]);

                        foreach($ownership_img_src as $temp_ownership_img_src) {
                            $none_open_background_data[$i]['ownership_img_src'][$j] = $temp_ownership_img_src->img_src;
                            $none_open_background_data[$i]['ownership_id'][$j] = $temp_ownership_img_src->id;
                        }
                    }
                }
                $i++;
            }
        }
        else if ($kind=="items"){
            $item = new Item();
            $i = 0;
            foreach ($none_open_background as $temp_none_open_background){
                $temp_none_open_background_data = $item->none_set_open_background($temp_none_open_background->background_id);

                foreach($temp_none_open_background_data as $temp_data){
                    $none_open_background_data[$i]['id'] = $temp_data->id;
                    $none_open_background_data[$i]['name'] = $temp_data->name;
                    $none_open_background_data[$i]['info'] = $temp_data->info;
                    $none_open_background_data[$i]['category'] = $temp_data->category;
                    $none_open_background_data[$i]['img_src'] = $temp_data->img_src;
                }
                $i++;
            }
        }
        else if($kind=="relations"){
            $relation_list = new Relation_list();
            $i= 0;
            foreach ($none_open_background as $temp_none_open_background){
                $temp_none_open_background_data = $relation_list->none_set_open_background($temp_none_open_background->background_id);

                foreach($temp_none_open_background_data as $temp_data){
                    $none_open_background_data[$i]['id'] = $temp_data->id;
                    $none_open_background_data[$i]['title'] = $temp_data->title;
                    $none_open_background_data[$i]['cover_src'] = $temp_data->cover_src;
                }
                $i++;
            }
        }
        else if($kind=="maps"){
            $map = new Map();
            $i= 0;
            foreach ($none_open_background as $temp_none_open_background){
                $temp_none_open_background_data = $map->none_set_open_background($temp_none_open_background->background_id);

                foreach($temp_none_open_background_data as $temp_data){
                    $none_open_background_data[$i]['id'] = $temp_data->id;
                    $none_open_background_data[$i]['title'] = $temp_data->title;
                    $none_open_background_data[$i]['cover_src'] = $temp_data->cover_src;
                }
                $i++;
            }
        }
        else if($kind=="timetables"){
            $timetable = new Timetable();
            $effect = new Effect();
            $i=0;
            foreach ($none_open_background as $temp_none_open_background){
                $temp_none_open_background_data = $timetable->none_set_open_background($temp_none_open_background->background_id);

                foreach($temp_none_open_background_data as $temp_data){
                    // 기본 데이터 세팅
                    $none_open_background_data[$i]['id'] = $temp_data->id;
                    $none_open_background_data[$i]['event_name'] = $temp_data->event_names;
                    $none_open_background_data[$i]['event_content'] = $temp_data->event_contents;
                    $none_open_background_data[$i]['start_day'] = $temp_data->start_days;
                    $none_open_background_data[$i]['end_day'] = $temp_data->end_days;
                    $none_open_background_data[$i]['others'] = $temp_data->others;

                    $effect_data = $effect->get_effect_data($none_open_background_data[$i]['id']);
                    // var_dump($effect_data);
                    // 끼친 영향 데이터 가져오기
                    $j = 0;
                    foreach($effect_data as $temp_effect_data) {
                        if($temp_effect_data->affect_table == "characters"){
                            $character = new Character();
                            $character_effect_data = $character->get_affect_data($temp_effect_data->affect_id);

                            foreach($character_effect_data as $temp_character_effect_data) {
                                $none_open_background_data[$i][$j]['id']= $temp_effect_data->affect_id;
                                $none_open_background_data[$i][$j]['img_src'] = $temp_character_effect_data->img_src;
                                $none_open_background_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                                $none_open_background_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                            }
                        }
                        else if($temp_effect_data->affect_table == "items"){
                            $item = new Item();
                            $item_effect_data = $item->get_item_src($temp_effect_data->affect_id);

                            foreach($item_effect_data as $temp_item_effect_data){
                                $none_open_background_data[$i][$j]['id']= $temp_effect_data->affect_id;
                                $none_open_background_data[$i][$j]['img_src'] = $temp_item_effect_data->img_src;
                                $none_open_background_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                                $none_open_background_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                            }
                        }
                        else if($temp_effect_data->affect_table == "relations"){
                            $relation_list = new Relation_list();
                            $relation_effect_data = $relation_list->get_relation_src($temp_effect_data->affect_id);

                            foreach($relation_effect_data as $temp_relation_effect_data){
                                $none_open_background_data[$i][$j]['id']= $temp_effect_data->affect_id;
                                $none_open_background_data[$i][$j]['img_src'] = $temp_relation_effect_data->cover_src;
                                $none_open_background_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                                $none_open_background_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                            }
                        }
                        else if($temp_effect_data->affect_table == "maps"){
                            $map = new Map();
                            $map_effect_data = $map->get_map_src($temp_effect_data->affect_id);

                            foreach($map_effect_data as $temp_map_effect_data){
                                $none_open_background_data[$i][$j]['id']= $temp_effect_data->affect_id;
                                $none_open_background_data[$i][$j]['img_src'] = $temp_map_effect_data->cover_src;
                                $none_open_background_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                                $none_open_background_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                            }
                        }
                        $j++;
                    }
                    $none_open_background_data[$i]['effect_count'] = $j;
                    $i++;
                }
            }
        }
        // item 일 경우
        // var_dump($none_open_background_data);
        return $none_open_background_data;
    }

    public function insert_open_background_data(Request $request){
        $data = $request->all();
        $backgroundShareController = new BackgroundShareController();
        // var_dump($data);
        if($data['kind']=="characters"){
            $backgroundShareController->insert_open_character_data($data);
        }
        else if($data['kind']=="items"){
            $backgroundShareController->insert_open_item_data($data);
        }
        else if($data['kind']=="timetables"){
            $backgroundShareController->insert_open_timetable_data($data);
        }
        else if($data['kind']=="relations"){
            $backgroundShareController->insert_open_relation_data($data);
        }
        else if($data['kind']=="maps"){
            $backgroundShareController->insert_open_map_data($data);
        }
        return redirect('background/share');
    }
    public function insert_open_character_data($data){
        $open_character = new open_character();
        $open_ownership = new open_ownership();
        $novel_has_open_background = new Novel_has_open_background();

        $novel_id = $_COOKIE['novel_id'];


        $character_info = array();
        // $character_info['id'] = $data['id'];
        $character_info['name'] = $data['character_name'];
        $character_info['info'] = $data['character_content'];
        $character_info['age'] = $data['age'];
        $character_info['gender'] = $data['gender'];
        $character_info['img_src'] = $data['img_src'];

        $table_id = $open_character->insert_open_character($character_info);

        if(isset($data['ownership_id'])){
            // var_dump($data['ownership_id']);

            for($i = 0 ; $i < count($data['ownership_id']) ; $i++ ){
                // var_dump();
                $open_ownership->insert_open_ownership($table_id,$data['ownership_id'][$i]);
            }

        }
        $novel_has_open_background->insert_open_relation($novel_id,"characters",$table_id,$data['id']);
        // var_dump($data);

        return redirect('background/share');
    }
    public function get_open_character(){
        $novel_id = $_COOKIE['novel_id'];

        $novel_has_open_background = new Novel_has_open_background;
        // $open_character = new open_character;
        $open_ownership = new open_ownership;

        $return_novel_open_data = array(array(array()));

        $novel_open_data = $novel_has_open_background->get_data_by_open_character($novel_id);
        $i = 0;
        // var_dump($novel_open_data);
        foreach($novel_open_data as $temp_novel_open_data) {
            $return_novel_open_data[$i]['id'] = $temp_novel_open_data->open_background_id;
            $return_novel_open_data[$i]['name']= $temp_novel_open_data->name;
            $return_novel_open_data[$i]['info']= $temp_novel_open_data->info;
            $return_novel_open_data[$i]['age']= $temp_novel_open_data->age;
            $return_novel_open_data[$i]['gender']= $temp_novel_open_data->gender;
            $return_novel_open_data[$i]['img_src']= $temp_novel_open_data->img_src;

            $character_open_ownership = $open_ownership->get_open_ownership_by_character_id($return_novel_open_data[$i]['id']);
            $j = 0;
            foreach($character_open_ownership as $temp_character_open_ownership){
                $return_novel_open_data[$i]['ownership_id'][$j] = $temp_character_open_ownership->item_id;
                $return_novel_open_data[$i]['ownership_img_src'][$j] = $temp_character_open_ownership->img_src;
            }
            $i++;
        }

        return $return_novel_open_data;
    }

    public function insert_open_item_data($data){
        $open_item = new open_item();

        $novel_has_open_background = new Novel_has_open_background();

        $novel_id = $_COOKIE['novel_id'];


        $item_info = array();
        // $character_info['id'] = $data['id'];
        $item_info['name'] = $data['item_name'];
        $item_info['info'] = $data['item_content'];
        $item_info['category'] = $data['category'];
        $item_info['img_src'] = $data['img_src'];

        $table_id = $open_item->insert_open_item($item_info);

        $novel_has_open_background->insert_open_relation($novel_id,"items",$table_id,$data['id']);
        // var_dump($data);

        return redirect('background/share');
    }

    public function get_open_item(){

        $novel_id = $_COOKIE['novel_id'];

        $novel_has_open_background = new Novel_has_open_background;
        // $open_character = new open_character;

        $return_novel_open_data = array(array());

        // join
        $novel_open_data = $novel_has_open_background->get_data_by_open_item($novel_id);
        $i = 0;
        // var_dump($novel_open_data);
        foreach($novel_open_data as $temp_novel_open_data) {
            $return_novel_open_data[$i]['id'] = $temp_novel_open_data->open_background_id;
            $return_novel_open_data[$i]['name']= $temp_novel_open_data->name;
            $return_novel_open_data[$i]['info']= $temp_novel_open_data->info;
            $return_novel_open_data[$i]['category']= $temp_novel_open_data->category;
            $return_novel_open_data[$i]['img_src']= $temp_novel_open_data->img_src;

            $i++;
        }

        return $return_novel_open_data;
    }

    public function insert_open_relation_data($data){
        $open_relation_list =  new open_relation_list();
        $novel_has_open_background = new Novel_has_open_background();

        $novel_id = $_COOKIE['novel_id'];
        $relation_info = array();

        $relation_info['cover_src'] = $data['cover_src'];
        $relation_info['title'] = $data['relation_title'];

        $open_relation_id = $open_relation_list->insert_open_relation($relation_info);
        // $open_relation_id = 1;
        $novel_has_open_background->insert_open_relation($novel_id,"relations",$open_relation_id,$data['id']);
    }

    public function get_open_relation(){
        $novel_id = $_COOKIE['novel_id'];

        $novel_has_open_background = new Novel_has_open_background;
        // $open_character = new open_character;

        $return_novel_open_data = array(array());

        // join
        $novel_open_data = $novel_has_open_background->get_data_by_open_relation($novel_id);
        $i = 0;
        // var_dump($novel_open_data);
        foreach($novel_open_data as $temp_novel_open_data) {
            $return_novel_open_data[$i]['id'] = $temp_novel_open_data->open_background_id;
            $return_novel_open_data[$i]['title']= $temp_novel_open_data->title;
            $return_novel_open_data[$i]['cover_src']= $temp_novel_open_data->cover_src;

            $i++;
        }

        return $return_novel_open_data;
    }

    public function insert_open_map_data($data){
        $open_map =  new open_map();
        $novel_has_open_background = new Novel_has_open_background();

        $novel_id = $_COOKIE['novel_id'];
        $map_info = array();

        $map_info['cover_src'] = $data['cover_src'];
        $map_info['title'] = $data['map_title'];

        $open_map_id = $open_map->insert_open_map($map_info);
        // $open_relation_id = 1;
        $novel_has_open_background->insert_open_relation($novel_id,"maps",$open_map_id,$data['id']);
    }

    public function get_open_map(){
        $novel_id = $_COOKIE['novel_id'];

        $novel_has_open_background = new Novel_has_open_background;
        // $open_character = new open_character;

        $return_novel_open_data = array(array());

        // join
        $novel_open_data = $novel_has_open_background->get_data_by_open_map($novel_id);
        $i = 0;
        // var_dump($novel_open_data);
        foreach($novel_open_data as $temp_novel_open_data) {
            $return_novel_open_data[$i]['id'] = $temp_novel_open_data->open_background_id;
            $return_novel_open_data[$i]['title']= $temp_novel_open_data->title;
            $return_novel_open_data[$i]['cover_src']= $temp_novel_open_data->cover_src;

            $i++;
        }

        return $return_novel_open_data;
    }

    public function insert_open_timetable_data($data){
        $open_timetable = new open_timetable();
        $open_effect = new open_effect();
        $novel_has_open_background = new Novel_has_open_background();

        $novel_id = $_COOKIE['novel_id'];
        $timetable_info = array();

        $timetable_info['event_names'] = $data['event_name'];
        $timetable_info['event_contents'] = $data['event_content'];
        $timetable_info['start_days'] = $data['start_day'];
        $timetable_info['end_days'] = $data['end_day'];
        $timetable_info['others'] = $data['other'];

        $open_timetable_insert_id = $open_timetable->insert_open_timetable($timetable_info);
        $affect_count = count($data['affect_content']);
        // var_dump($affect_count);
        // var_dump($data);
        // $open_timetable_insert_id = 1;

        for($i = 0 ; $i < $affect_count;$i++){
            $open_effect_info = array();
            if($data['affect_content'][$i] == "characters"){
                $open_effect_info['characters']['id'] = $data['affect_id'][$i];
                $open_effect_info['characters']['content'] = $data['affect_info'][$i];
                // var_dump($data['affect_info'][$i]);
                $open_effect->insert_open_effect($open_timetable_insert_id,$open_effect_info,"characters");

            }
            if($data['affect_content'][$i] == "items"){
                $open_effect_info['items']['id'] = $data['affect_id'][$i];
                $open_effect_info['items']['content'] = $data['affect_info'][$i];
                $open_effect->insert_open_effect($open_timetable_insert_id,$open_effect_info,"items");
            }
            // // 차후 지도 정보 입력 시 연동
            if($data['affect_content'][$i] == "maps"){
                $open_effect_info['maps']['id'] = $data['affect_id'][$i];
                $open_effect_info['maps']['content'] = $data['affect_info'][$i];
                $open_effect->insert_open_effect($open_timetable_insert_id,$open_effect_info,"maps");
            }
            if($data['affect_content'][$i] == "relations"){
                $open_effect_info['relations']['id'] = $data['affect_id'][$i];
                $open_effect_info['relations']['content'] = $data['affect_info'][$i];
                $open_effect->insert_open_effect($open_timetable_insert_id,$open_effect_info,"relations");
            }
            // var_dump($data['affect_content'][$i]);
            // var_dump($i);
        }


        $novel_has_open_background->insert_open_relation($novel_id,"timetables",$open_timetable_insert_id,$data['id']);
    }
    public function get_open_timetable(){
        $novel_id = $_COOKIE['novel_id'];

        $novel_has_open_background = new Novel_has_open_background;
        $open_effect = new open_effect();

        // $open_character = new open_character;

        $return_novel_open_data = array(array());

        $novel_open_data = $novel_has_open_background->get_data_by_open_timetable($novel_id);
        $i = 0;
        // var_dump($novel_open_data);
        foreach($novel_open_data as $temp_novel_open_data) {
            $return_novel_open_data[$i]['id'] = $temp_novel_open_data->open_background_id;
            $return_novel_open_data[$i]['event_name']= $temp_novel_open_data->event_names;
            $return_novel_open_data[$i]['event_content']= $temp_novel_open_data->event_contents;
            $return_novel_open_data[$i]['start_day']= $temp_novel_open_data->start_days;
            $return_novel_open_data[$i]['end_day']= $temp_novel_open_data->end_days;
            $return_novel_open_data[$i]['other']= $temp_novel_open_data->others;


            // var_dump($return_novel_open_data);
            $effect_data = $open_effect->get_open_effect_data($return_novel_open_data[$i]['id']);
            // var_dump($effect_data);
            // 끼친 영향 데이터 가져오기
            $j = 0;
            foreach($effect_data as $temp_effect_data) {
                if($temp_effect_data->affect_table == "characters"){
                    $character = new Character();
                    $character_effect_data = $character->get_affect_data($temp_effect_data->affect_id);

                    foreach($character_effect_data as $temp_character_effect_data) {
                        $return_novel_open_data[$i][$j]['id']= $temp_effect_data->affect_id;
                        $return_novel_open_data[$i][$j]['img_src'] = $temp_character_effect_data->img_src;
                        $return_novel_open_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                        $return_novel_open_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                    }
                }
                if($temp_effect_data->affect_table == "items"){
                    $item = new Item();
                    $item_effect_data = $item->get_item_src($temp_effect_data->affect_id);

                    foreach($item_effect_data as $temp_item_effect_data){
                        $return_novel_open_data[$i][$j]['id']= $temp_effect_data->affect_id;
                        $return_novel_open_data[$i][$j]['img_src'] = $temp_item_effect_data->img_src;
                        $return_novel_open_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                        $return_novel_open_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                    }
                }
                if($temp_effect_data->affect_table == "relations"){
                    $relation_list = new Relation_list();
                    $relation_effect_data = $relation_list->get_relation_src($temp_effect_data->affect_id);

                    foreach($relation_effect_data as $temp_relation_effect_data){
                        $return_novel_open_data[$i][$j]['id']= $temp_effect_data->affect_id;
                        $return_novel_open_data[$i][$j]['img_src'] = $temp_relation_effect_data->cover_src;
                        $return_novel_open_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                        $return_novel_open_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                    }
                }
                if($temp_effect_data->affect_table == "maps"){
                    $map = new Map();
                    $map_effect_data = $map->get_map_src($temp_effect_data->affect_id);

                    foreach($map_effect_data as $temp_map_effect_data){
                        $return_novel_open_data[$i][$j]['id']= $temp_effect_data->affect_id;
                        $return_novel_open_data[$i][$j]['img_src'] = $temp_map_effect_data->cover_src;
                        $return_novel_open_data[$i][$j]['affect_content'] = $temp_effect_data->affect_content;
                        $return_novel_open_data[$i][$j]['affect_table'] = $temp_effect_data->affect_table;
                    }
                }
                $j++;
            }
            $return_novel_open_data[$i]['effect_count'] = $j;
            $i++;
        }

        return $return_novel_open_data;
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
