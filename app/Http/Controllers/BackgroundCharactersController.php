<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Character;
use App\Item;
use App\Ownership;
use App\Background;
use App\Tag;

class BackgroundCharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $character = new Character();

        // session_start();

        // echo($_SESSION['novel_id']);
        if(!isset($_COOKIE['novel_id'])){
            return redirect('write_novel/my_novel');
        }
        else {
            $novel_id = $_COOKIE['novel_id'];
        }

        $dataSet = $character->date_get_novel_id($novel_id);
        $data = array(array());
        $i = 0;

        foreach($dataSet as $datas){
            $data[$i]['id'] = $datas->background_id;
            $data[$i]['name'] = $datas->name;
            $data[$i]['info'] = $datas->info;
            $data[$i]['age'] = $datas->age;
            $data[$i]['gender'] = $datas->gender;
            $data[$i]['refer_info'] = $datas->refer_info;
            $data[$i]['img_src'] = $datas->img_src;
            $data[$i]['refer_info'] = explode('^',$data[$i]['refer_info']);

            $i++;
        }
        $refer_info = array();

        return view('background.character.character_view')->with("data", $data);
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

    public function ownership(Request $request){
        $ownership = new Ownership();
        $data = $request->all();

        $character_id = $data['character_id'];

        $item_list = "";
        $i = 0;
        for($i = 0 ; $i < count($data['item_id']) ; $i++){
            if( $i == 0 ){
                $item_list = $data['item_id'][$i];
            }
            else {
                $item_list = $item_list."+".$data['item_id'][$i];
            }
        }
        $ownership->insert_ownership($character_id, $item_list);
    }

    public static function ownership_icon(Request $request){
        $data = $request->all();
        $character_id = $data['character_id'];
        // echo $character_id;
        $ownership = new Ownership();

        $item_data = $ownership->get_ownership($character_id);
        return $item_data;
    }

    public static function ownership_img(Request $request){
        $data = $request->all();
        $count = count($data['item_id']);
        $item_id = $data['item_id'];
        $item = new Item();
        // $img_src= array();
        // 이미지 주소 받아오기
        for ($i = 0; $i< $count ; $i++){
            $img_src[$i] = $item->get_item_src($item_id[$i]);
        }
        return $img_src;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $character = new Character();
        $background = new Background();
        $imgUpLoad = new BackgroundCharactersController();
        $tag = new Tag();

        // session_start();
        $novel_id = $_COOKIE['novel_id'];

        $file = Input::file('character_img_upload');
        $data = $request->all();

        $refer_info = "";

        for($i= 0; $i < count($data['refer_info']); $i++){
            if($i==0){
                $refer_info = $data['refer_info'][$i];
            }
            else{
                $refer_info = $refer_info."^".$data['refer_info'][$i];
            }

        }
        $data['refer_info'] = $refer_info;
        if($file){
            $img_name = $imgUpLoad->backgroundImgUpload($file);
        }
        else {
            $img_name = null;
        }

        $character_insert_id = $character->insert_character($data,$img_name);
        // $character_insert_id = 4;
        $novel_background_data = array();
        $novel_background_data['belong_to_novel'] = $novel_id;
        $novel_background_data['novel_background'] = "characters";
        $novel_background_data['background_id'] = $character_insert_id;
        $background->insertData($novel_background_data);

        $tag_insert_data = array();
        $tag_insert_data['page'] = "characters";
        $tag_insert_data['object_id'] = $character_insert_id;
        $tag_insert_data['tag_name'] = $data['character_name'];
        $tag_insert_data['tag_color'] = "ff0000";
        $tag->insertTag($tag_insert_data);
        return redirect(route('character.index'));
    }

    //소설 설정 이미지 업로드
    public function backgroundImgUpload($file){
        $destinationPath = 'img/background/characterImg';
        $fileName = date("Y").date("m").date("d").date("s").$file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

   public static function ownership_modal(){
       return view('background.character.ownership');
   }

   public static function show_item(){
        $item = new Item();

        $item_list = $item->itemListBringAll();
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
}
