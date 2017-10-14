<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public static function view_return($page,$data){
        $tag = new Tag();
        $tag_data = $tag->tagBring($page);

        $datas = array(
            'tag_data' => $tag_data,
            'page' => $page, 
            'data' => $data);
        return view('background.add_tag')->with("datas",$datas);
    }

    public function map_tag_insert(Request $request){
        $tag = new Tag();
        $tag_data = $request->all();
        $result = $tag->insertTag($tag_data);
        // echo ($tag_data['tag_name']);
        // echo ($tag_data['page']);
        // echo ($tag_data['tag_color']);
        // echo ($tag_data['object_id']);
        // return var_dump($data);
    }

    public function getData(){
        // if(isset($_GET['event_id'])){
        //     $event_num = $_GET['event_id'];
        // }
        // else{
        //     $event_num = false;
        // }
        return view('background.add_tag')->with("event_num",$event_num);
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
        $tag = new Tag();
        
        $tag_data = $request->all();

        $result = $tag->insertTag($tag_data);
        // echo ($tag_data['tag_name']);
        // echo ($tag_data['page']);
        // echo ($tag_data['tag_color']);
        // echo ($tag_data['object_id']);
        if ($tag_data['page'] == "items"){
            return redirect(route('things.index')); 
        }
        else if($tag_data['page'] == "characters"){
            return redirect(route('character.index')); 
        }
        else if($tag_data['page'] == "timetables"){
            return redirect(route('historyTable.index'));
        }
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
