<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Input;
use App\Background;
use App\Tag;

class RelationController extends Controller
{
  public function index(){
    //session_start();
    if(!isset($_COOKIE['novel_id'])){
        return redirect('background');
    }
    else {
        $novel_id = $_COOKIE['novel_id'];
    }

    $imgRoot = "img/background/characterImg/";
    $chaInfos = DB::table('characters')
                    ->join('novel_backgrounds','characters.cha_id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','characters')
                    ->get();

    $tasks = array(
      "imgRoot"   => $imgRoot,
      "chaInfos"  => $chaInfos
    );
    return view('background.relationship.relationship_view')->with('tasks', $tasks);
  }

  // 관계 번호를 입력받아 삭제
  public function removeRelation(Request $request){
    $relnum = $request->input('relnum');
    DB::table("relations")->where('relnum','=',$relnum)->delete();
    return "success";
  }

  // 관계 정보를 입력받아 생성
  public function createRelation(Request $request){
    $relnum = $request->input('relnum');
    $sourceId = $request->input('sourceId');
    $targetId = $request->input('targetId');
    $relationship = $request->input('relationship');

    $test1 = "relnum : ".$relnum;
    $test2 = " sourceId : ".$sourceId;
    $test3 = " targetId : ".$targetId;
    $test4 = " relationship : ".$relationship;

    DB::table("relations")->insert([
      //"relnum" => $relnum,
      "target" => (int)$targetId,
      "source" => (int)$sourceId,
      "relationship" => $relationship
    ]);

    echo $test1.$test2.$test3.$test4;
  }

  // 관계 등록
  public function relationStore(Request $request){
    // 맵 , 그리드, 텍스트 정보
    $title = $request->input('title');

    // 이미지 커버 저장
    $canvasUrl = $request->input('canvasUrl');

    // 현재 관계 정보
    $relInfos = $request->input('relInfos');


    $destinationPath = 'img/background/relationImg/';
    if(!is_dir($destinationPath)){
      mkdir($destinationPath);
    }
    $fileName = date("Y").date("m").date("d").date("s")."_".$title.".png";
    $outputFile = $destinationPath.$fileName;
    $ifp = fopen( $outputFile, 'wb' );

    $data = explode( ',', $canvasUrl);
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    fclose( $ifp );

    // 관계 리스트 추가
    $mytime = date('Y-m-d H:i:s');
    DB::table("relation_lists")->insert([
        "cover_src"  => $fileName,
        "title"      => $title,
        "created_at" => $mytime
    ]);


    // 관계 리스트의 최신 번호 호출
    $relListInfo = DB::table("relation_lists")->select("id","created_at","updated_at")->orderBy('id', 'DESC')->first();
    $listId = $relListInfo->id;
    $createdAt = $relListInfo->created_at;
    $updatedAt = $relListInfo->updated_at;

    // JJH auto tag
    // 2017.08.11
    $tag = new Tag();
  
    $tag_insert_data = array();
    $tag_insert_data['page'] = "relations";
    $tag_insert_data['object_id'] = $listId;
    $tag_insert_data['tag_name'] = $title;
    $tag_insert_data['tag_color'] = "0f0f00";
    $tag->insertTag($tag_insert_data);

    // 관계 정보 등록
    if(count($relInfos) != 0){
      foreach($relInfos as $relInfo){
        DB::table("relations")->insert([
          "source"        => $relInfo["source"]["chaId"],
          "target"        => $relInfo["target"]["chaId"],
          "relationship"  => $relInfo["relationship"]
        ]);
        // 등록된 관계 정보 호출
        $relListInfo = DB::table("relations")->select("relnum")->orderBy('relnum', 'DESC')->first();
        $relnum = $relListInfo->relnum;

        DB::table("relation_in_list")->insert([
          "listnum"        => $listId,
          "relnum"         => $relnum
        ]);
      }
    }

    // 소설 - 배경정보
    //session_start();
    $novel_id = $_COOKIE['novel_id'];
    $background = new Background();

    $novel_background_data = array();
    $novel_background_data['belong_to_novel'] = $novel_id;
    $novel_background_data['novel_background'] = "relations";
    $novel_background_data['background_id'] = $listId;
    $background->insertData($novel_background_data);


    return $listId."/".$createdAt;
  }

  // 관계 목록
  public function getRelationList() {
    //session_start();
    $novel_id = $_COOKIE['novel_id'];
    $background = new Background();

    $relationInfos = DB::table('relation_lists')
                    ->join('novel_backgrounds','relation_lists.id','=','novel_backgrounds.background_id')
                    ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                    ->where('novel_backgrounds.novel_background','=','relations')
                    ->get();

    return $relationInfos;
  }

  // 관계삭제
  public function removeList(Request $request){
    $relId = $request->input('relId');
    // 리스트 삭제
    DB::table("relation_lists")->where('id','=',$relId)->delete();
    // 리스트에 따른 관계 번호 호출
    $relnums = DB::table("relation_in_list")->select("relnum")->where("listnum","=",$relId)->get();
    // 리스트와 관계의 종속 삭제
    DB::table("relation_in_list")->where("listnum","=",$relId)->delete();

    if(count($relnums) != 0){
      foreach($relnums as $relnum){
        DB::table("relations")->where("relnum","=",$relnum->relnum)->delete();
      }
    }

    return var_dump($relnums);
  }

  // 관계 정보 호출
  public function getRelsContent(Request $request){
    $relId = $request->input('id');

    $relnums = DB::table("relation_in_list")->select("relnum")->where("listnum","=",$relId)->get();
    $relnumArr = array();
    if(count($relnums) != 0){
      foreach($relnums as $relnum){
        array_push($relnumArr, $relnum->relnum);
      }
    }

    $relInfos = DB::table("relations")->whereIn("relnum", $relnumArr)->get();

    return $relInfos;
  }
}
