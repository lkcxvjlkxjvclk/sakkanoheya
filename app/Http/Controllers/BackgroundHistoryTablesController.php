<?php

// 타임테이블 연산 처리를 위한 컨트롤러

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\Character;
use App\Item;
use App\Effect;
use App\Map;
use App\Background;
use App\Relation_list;
use App\Tag;
use App\open_effect;

class BackgroundHistoryTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeTable = new Timetable();
        
        // echo($_COOKIE['novel_id']);
        $novel_id = $_COOKIE['novel_id'];
        if(!isset($_COOKIE['novel_id'])){
            return redirect('write_novel/my_novel');
        }
        else {
            $novel_id = $_COOKIE['novel_id'];
        }
        // var_dump($_SESSION['novel_id']);
        $dataSet = $timeTable->date_get_novel_id($novel_id);
        // var_dump($dataSet);
        // echo($dataSet[0]["event_names"]);
        $data = array(array());
        $i = 0;
        foreach ($dataSet as $datas){
            $data[$i]['id'] = $datas->background_id;
            $data[$i]['event_name'] = $datas->event_names;
            $data[$i]['event_content'] = $datas->event_contents;
            $data[$i]['start_day'] = $datas->start_days;
            $data[$i]['end_day'] = $datas->end_days;
            $data[$i]['other'] = $datas->others;
            $data[$i]['refer_info'] = $datas->refer_info;
            $data[$i]['refer_info'] = explode('^',$data[$i]['refer_info']);
            
            $i++;
        }
        // var_dump($data);
        return view('background.historyTable.history_table_view')->with("data", $data);
    }

    /**
     * JHM
     * Open Background[CHARACTERS]
     * 
     * @param $timetable_id(DataType : int)
     * @return $open_character
     */
    public static function open_characters($timetable_id) {
        $open_character = new open_effect();

        $dataSet = $open_character->get_open_character_data($timetable_id);

        $characterList = array(array());
        $i = 0;

        foreach ($dataSet as $datas) {
            $characterList[$i]['name'] = $datas->affect_content;

            $i++;
        }
        
        // var_dump($characterList);

        return $characterList;
    }

    /**
     * JHM
     * Open Background[ITEMS]
     * 
     * @param $timetable_id(DataType : int)
     * @return $open_item
     */
    public static function open_items($timetable_id) {
        $open_item = new open_effect();

        $dataSet = $open_item->get_open_item_data($timetable_id);

        $itemList = array(array());
        $i = 0;

        foreach ($dataSet as $datas) {
            $itemList[$i]['name'] = $datas->affect_content;

            $i++;
        }
        
        // var_dump($itemList);

        return $itemList;
    }

    /**
     * JHM
     * Open Background[MAPS]
     * 
     * @param $timetable_id(DataType : int)
     * @return $open_map
     */
    public static function open_maps($timetable_id) {
        $open_map = new open_effect();

        $dataSet = $open_map->get_open_map_data($timetable_id);

        $mapList = array(array());
        $i = 0;

        foreach ($dataSet as $datas) {
            $mapList[$i]['name'] = $datas->affect_content;

            $i++;
        }
        
        // var_dump($mapList);

        return $mapList;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('background.historyTable.history_table_view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  데이터 저장. post값으로 넘어온 값을 데이터베이스에 저장하는 메소드
    public function store(Request $request)
    {
        $table = $request->all();
        $novel_id = $_COOKIE['novel_id'];
        $timeTable = new Timetable();
        $effect = new Effect();
        $background = new Background();
        $relation_list = new Relation_list();
        $tag = new Tag();
        $refer_info = "";

        for($i= 0; $i < count($table['refer_info']); $i++){
            if($i==0){
                $refer_info = $table['refer_info'][$i];
            }   
            else{
                $refer_info = $refer_info."^".$table['refer_info'][$i];
            }
            
        }
        // var_dump($table);
        // var_dump($table['effect_item']);
        $table['refer_info'] = $refer_info;

        // affect 데이터를 저장하기 위한 배열
        // characters, items, maps 아래 각각 id 와 content를 가지고 있음.
        $data = array(array(array()));
        if(isset($table['character_id'])){
            $data['characters']['id'] = $table['character_id'];
            $data['characters']['content'] = $table['effect_character'];
        }
        if(isset($table['item_id'])){
            $data['items']['id'] = $table['item_id'];
            $data['items']['content'] = $table['effect_item'];
        }
        // 차후 지도 정보 입력 시 연동
        if(isset($table['map_id'])){
            $data['maps']['id'] = $table['map_id'];
            $data['maps']['content'] = $table['effect_map'];
        }
        if(isset($table['relation_id'])){
            $data['relations']['id'] = $table['relation_id'];
            $data['relations']['content'] = $table['effect_relation'];
        }
        // var_dump($data);
        // 새로 입력 한 연대표 아이디값 반환
        $table_id = $timeTable->insert_table($table);
        // $table_id = 9;
        $novel_background_data = array();
        $novel_background_data['belong_to_novel'] = $novel_id;
        $novel_background_data['novel_background'] = "timetables";
        $novel_background_data['background_id'] = $table_id;
        $background->insertData($novel_background_data);
        // $table_id = 6;

        $tag_insert_data = array();
        $tag_insert_data['page'] = "timetables";
        $tag_insert_data['object_id'] = $table_id;
        $tag_insert_data['tag_name'] = $table['event_name'];
        $tag_insert_data['tag_color'] = "00f0f0";
        $tag->insertTag($tag_insert_data);

        // 관계 테이블에 데이터 저장
        $effect->insert_effect($table_id,$data);
        return redirect(route('historyTable.index'));
    }

    public static function characters_effect_modal(){
        return view('background.historyTable.character_effect_modal');
    }

    public static function show_characters(){
        $character = new Character();

        $character_list = $character->dataBringAll();
        $list = array(array());
        $i = 0;
        foreach($character_list as $lists){
            $list[$i]["id"] = $lists->cha_id;
            $list[$i]["name"] = $lists->name;
            $list[$i]["img_src"] = $lists->img_src;    
            $i++;
        }
        return $list; 
    }

    public static function items_effect_modal(){
        return view('background.historyTable.items_effect_modal');
    }

    public static function show_items(){
        $item = new Item();

        $item_list = $item->dataBringAll();
        $list = array(array());
        $i = 0;
        foreach($item_list as $lists){
            $list[$i]["id"] = $lists->id;
            $list[$i]["name"] = $lists->name;
            $list[$i]["img_src"] = $lists->img_src;    
            $i++;
        }

        return $list; 
    }

    public static function maps_effect_modal(){
        return view('background.historyTable.maps_effect_modal');
    }

    public static function show_maps(){
        $map = new Map();

        $map_list = $map->dataBringAll();
        $list = array(array());
        $i = 0;
        foreach($map_list as $lists){
            $list[$i]["id"] = $lists->id;
            $list[$i]["name"] = $lists->title;
            $list[$i]["img_src"] = $lists->cover_src;    
            $i++;
        }

        return $list; 
    }

    public static function relations_effect_modal(){
        return view('background.historyTable.relation_effect_modal');
    }

    public static function show_relations(){
        $relation_list = new Relation_list();

        // session_start();
        $novel_id = $_COOKIE['novel_id'];
        $relation = $relation_list->get_data_by_novel_id($novel_id);
        // var_dump($relation);
        $list = array(array());
        $i = 0;
        foreach($relation as $lists){
            $list[$i]["id"] = $lists->background_id;
            $list[$i]["name"] = $lists->title;
            $list[$i]["img_src"] = $lists->cover_src;    
            $i++;
        }

        return $list; 
    }

    public function getEffect(Request $request){
        $data = $request->all();
        
        $effect = new Effect();
        
        $effect_data = $effect->get_effect_data($data['timetable_id']);
        // $effect_data[0]['affect_table'];
        // $effect_data[0]['affect_id'];
        // $effect_data[0]['affect_content'];
        // var_dump($data['timetable_id']);
        $data = array(array());
        $i = 0;
        foreach($effect_data as $datas){
            $data[$i]["affect_table"] = $datas->affect_table;
            $data[$i]["affect_id"] = $datas->affect_id;
            $data[$i]["affect_content"] = $datas->affect_content; 
            $i++;
        }
        
        $character = new Character();
        $item = new Item();
        $map = new Map();
        $relation_list = new Relation_list();

        $num = count($effect_data);
        $items = "items";
        // 테이블에서 이미지 소스 가져오기
        for( $i = 0 ; $num> $i ; $i++ ){
            if($data[$i]["affect_table"] == "characters"){
                $character_img_src = $character->get_affect_data($data[$i]["affect_id"]);

                foreach($character_img_src as $img_src){
                    $data[$i]["img_src"] = $img_src->img_src;
                }
            }
            if($data[$i]["affect_table"] == "items"){
                $item_img_src = $item->get_item_src($data[$i]["affect_id"]);

                foreach($item_img_src as $img_src){
                    $data[$i]["img_src"] = $img_src->img_src;
                }
            }
            if($data[$i]["affect_table"] == "maps"){
                $map_img_src = $map->get_map_src($data[$i]["affect_id"]);

                foreach($map_img_src as $img_src){
                    $data[$i]["img_src"] = $img_src->cover_src;
                }
            }
            if($data[$i]["affect_table"] == "relations"){
                $relation_img_src = $relation_list->get_relation_src($data[$i]["affect_id"]);

                foreach($relation_img_src as $img_src){
                    $data[$i]["img_src"] = $img_src->cover_src;
                }
            }
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timeTable = new Timetable();
        
        // session_start();
        // echo($_SESSION['novel_id']);
        setcookie('novel_id',$id,time()+(60*60),'/');
        $novel_id = $id;
        // var_dump($_SESSION['novel_id']);
        // $dataSet = $timeTable->date_get_novel_id($novel_id);
        // // var_dump($dataSet);
        // // echo($dataSet[0]["event_names"]);
        // $data = array(array());
        // $i = 0;
        // foreach ($dataSet as $datas){
        //     $data[$i]['id'] = $datas->id;
        //     $data[$i]['event_name'] = $datas->event_names;
        //     $data[$i]['event_content'] = $datas->event_contents;
        //     $data[$i]['start_day'] = $datas->start_days;
        //     $data[$i]['end_day'] = $datas->end_days;
        //     $data[$i]['other'] = $datas->others;
        //     $data[$i]['refer_info'] = $datas->refer_info;
        //     $data[$i]['refer_info'] = explode('^',$data[$i]['refer_info']);
            
        //     $i++;
        // }
        // $backgroundHistoryTables = new BackgroundHistoryTablesController();
        // $backgroundHistoryTables->index();
        return redirect('background/historyTable');
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
