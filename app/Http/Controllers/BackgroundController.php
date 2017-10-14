<?php

namespace App\Http\Controllers;

use DB;
use App\Novel;
use App\Background;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
        //  유저 세션에 따른 유저 소설 정보만 뽑아오게 하는 부분 완성
        $novel = new Novel();
        $novel_data = $novel->mainData();
        $data = array(array());
        $i = 0;
        // session_start();
        session_unset("novel_id");
        foreach($novel_data as $datas){
            $data[$i]['id'] = $datas->id;
            $data[$i]['title'] = $datas->title;
            $data[$i]['intro'] = $datas->intro;
            $data[$i]['summary_intro'] = $datas->summary_intro;
            $data[$i]['cover_img_src'] = $datas->cover_img_src;
            $data[$i]['genre'] = $datas->genre;
            $data[$i]['created_at'] = $datas->created_at;   
            $data[$i]['updated_at'] = $datas->updated_at;  

            $i++;
        }

        // var_dump($data);
        return view('background.main.background_main')->with("data",$data);
     }

    public function index_map()
    {
        $maps = DB::select('maps');

        // $background = \App\
        // return __METHOD__ . '은(는) 컬렉션을 조회합니다.';
        return view('background.map.map_view')->with('links', $maps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return __METHOD__ . '은(는) 컬랙션을 만들기 위한 폼을 담은 뷰를 반환.';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return __METHOD__ . '은(는) 사용자으 ㅣ입력한 폼 데이터를 새로운 컬렉션으로 만듬';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // session_start();
        $_SESSION['novel_id'] = $id;
        $url = "background/historyTable";
        
        return redirect($url);
        // return __METHOD__ . '은(는) 다음 기본 키를 가진 모델을 조회합니다.';

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    public function abc($id){
        return __METHOD__ . '은(는) 실험.';
    }
}
