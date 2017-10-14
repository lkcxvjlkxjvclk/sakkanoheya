<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Item;
use App\Background;
use App\Tag;

class BackgroundItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = new Item();

        // session_start();
        // echo($_SESSION['novel_id']);
        if(!isset($_COOKIE['novel_id'])){
            return redirect('write_novel/my_novel');
        }
        else {
            $novel_id = $_COOKIE['novel_id'];
        }

        $dataSet = $item->date_get_novel_id($novel_id);
        $data = array(array());
        $i = 0;

        foreach($dataSet as $datas){
            $data[$i]['id'] = $datas->background_id;
            $data[$i]['name'] = $datas->name;
            $data[$i]['info'] = $datas->info;
            $data[$i]['category'] = $datas->category;
            $data[$i]['refer_info'] = $datas->refer_info;
            $data[$i]['img_src'] = $datas->img_src;
            $data[$i]['refer_info'] = explode('^',$data[$i]['refer_info']);

            $i++;
        }
        return view('background.things.things_view')->with("data", $data);;
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
        $item = new Item();
        $background = new Background();
        $imgUpLoad = new BackgroundItemsController();
        $tag = new Tag();

        // session_start();
        $novel_id = $_COOKIE['novel_id'];
        
        $file = Input::file('item_img_upload');
        $data = $request->all();
        // var_dump($data);

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

        $item_insert_id = $item->insert_item($data,$img_name);

        $novel_background_data = array();
        $novel_background_data['belong_to_novel'] = $novel_id;
        $novel_background_data['novel_background'] = "items";
        $novel_background_data['background_id'] = $item_insert_id;
        $background->insertData($novel_background_data);

        $tag_insert_data = array();
        $tag_insert_data['page'] = "items";
        $tag_insert_data['object_id'] = $item_insert_id;
        $tag_insert_data['tag_name'] = $data['item_name'];
        $tag_insert_data['tag_color'] = "00ff00";
        $tag->insertTag($tag_insert_data);

        return redirect(route('things.index'));
    }

    //소설 설정 이미지 업로드
    public function backgroundImgUpload($file){
        $destinationPath = 'img/background/itemImg';
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
        //
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
