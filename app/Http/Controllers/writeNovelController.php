<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Input;
use App\Background;

class writeNovelController extends Controller
{
    public function setNovelView(){
      $tasks = DB::table("cover_images")->select("cover_img_src")->get();
      return view('write_novel/write_novel_set')->with("tasks", $tasks);
    }

    public function myNovelView(){
      return view('write_novel/my_novel');
    }

    // DB 소설 생성
    public function createNovel(Request $request){
      $title          = $request->input('title');
      $genre          = $request->input('genre');
      $publishPeriod  = $request->input('publishPeriod');
      $publishDays    = $request->input('publishDays');
      $coverImg       = $request->input('coverImg');
      $detailIntro    = $request->input('detailIntro');
      $summaryIntro   = $request->input('summaryIntro');
      $mytime         = date('Y-m-d H:i:s');

      DB::table("novels")->insert([
        "title"         => $title,
        "intro"         => $detailIntro,
        "summary_intro" => $summaryIntro,
        "cover_img_src" => $coverImg,
        "publish_case"  => $publishPeriod,
        "period"        => $publishDays,
        "genre"         => $genre,
        "created_at"    => $mytime
      ]);

      $novelId = DB::table("novels")->max("id");

      DB::table("novel_writers")->insert([
        "user_id"   => 1,
        "novel_id"  => $novelId
      ]);

      return $novelId;
    }

    // DB 회차 생성
    public function createEpisode(Request $request){
      $novelId    = $request->input("novelId");
      $isNotice   = $request->input('isNotice');
      $isCharge   = $request->input('isCharge');
      $coverImg   = $request->input('coverImg');
      $title      = $request->input('title');
      $episode    = $request->input('episode');
      $charCount = strlen($episode);
      $postScript = $request->input('postScript');
      $mytime     = date('Y-m-d H:i:s');

      DB::table("novel_episodes")->insert([
        "belong_to_novel"     => $novelId,
        "is_charge"           => $isCharge,
        "is_notice"           => $isNotice,
        "cover_img_src"       => $coverImg,
        "episode_title"       => $title,
        "episode"             => $episode,
        "char_count"          => $charCount,
        "writers_postscript"  => $postScript,
        "created_at"          => $mytime
      ]);

      // $test = array(
      //   $novelId, $isCharge, $isNotice, $coverImg, $title, $episode, $charCount, $postScript, $mytime
      // );

      return "success";
    }

    // 소설 정보 가져옴
    public function getNovelInfo(Request $request){

      $userId = 1;
      $pageNum = 2; // 페이지당 보일 수
      // novels + novel_writers 조인 후 유저와 일치하는 값 호출
      $novelInfo = DB::table("novels")->join("novel_writers","novels.id", "=", "novel_writers.novel_id")->where("novel_writers.user_id", "=",$userId)->paginate($pageNum);
      return $novelInfo;
    }

    // 해당 소설의 아이디에 대한 회차 정보 호출
    public function getEpisodeInfo(Request $request){
      $novelId = $request->input('novelId');
      $episodeInfo = DB::table("novel_episodes")->where("belong_to_novel", "=",$novelId)->get();
      return $episodeInfo;
    }

    // 회차 작성 뷰
    public function writeNovelEpisodeView ($novelId, Request $request){
      $coverImg = DB::table("episode_images")->select("cover_img_src")->where("novel_id", "=",$novelId)->get();
      $novelTitle = DB::table("novels")->select("title")->where("id", "=",$novelId)->get();
      $novelTitle = $novelTitle[0]->title;

      $tasks = array(
        "coverImg" => $coverImg,
        "novelTitle" => $novelTitle,
        "novelId"   => $novelId
      );

      return view('write_novel/write_episode_view')->with("tasks",$tasks);
    }

    // 태그 정보 호출
    // 해당 소설의 아이디에 대한 회차 정보 호출
    public function getTags(Request $request){
       $tagCase = $request->input('tagCase');
       if($tagCase != null){
         $tagInfo = DB::table("tags")->select("kind","object_id","color","tag_name as value")->where("kind", "=",$tagCase)->get();
       } else {
         $tagInfo = DB::table("tags")->select("kind","object_id","color","tag_name as value")->get();
       }


       return $tagInfo;
    }

    //배경설정 케이스와 아이디로 테그정보 호출
    public function getTagById(Request $request){

      $bgCase   = $request->input('bgCase');
      $bgId     = $request->input('bgId');

      $tagInfo = DB::table("tags")
      ->select("kind","object_id","color","tag_name as value")
      ->where("kind", "=",$bgCase)
      ->where("object_id", "=", $bgId)->get();



      return $tagInfo;
    }

    // 소설 배경설정 정보 호출
    public function callBackgroundInfo(Request $request){
      $novelId  = $request->input('novelId');
      $bgCase   = $request->input('bgCase');
      $bgId     = $request->input('bgId');

      $idName = ($bgCase == "characters" ? "cha_id" : "id");
      $table = ($bgCase == "relations" ? "relation_lists" : $bgCase);

      //$bgInfo = DB::table($table)->where($idName,"=",$bgId)->get();

      $bgInfo = DB::table($table)
                      ->join('novel_backgrounds', $table.'.'.$idName,'=','novel_backgrounds.background_id')
                      ->where('novel_backgrounds.belong_to_novel','=',$novelId)
                      ->where('novel_backgrounds.novel_background','=',$bgCase)
                      ->where('novel_backgrounds.background_id', '=', $bgId)
                      ->get();

      return $bgInfo;
    }

    // 소설 관계 정보 호출
    public function callRelationInfo(Request $request){
      $chaId = $request->input('chaId');

      $bgInfo = DB::table("relations")
      ->where("source","=",$chaId)->orWhere("target","=",$chaId)
      ->get();

      return $bgInfo;
    }
    // 소설 소유 정보 호출
    public function callOwnershipInfo(Request $request){
      $chaId = $request->input('chaId');

      $bgInfo = DB::table("ownerships")
      ->where("character_id","=",$chaId)
      ->get();

      return $bgInfo;
    }


    // 연대표 정보 호출
    public function getTimetablesInfo(Request $request){
      $novelId = $request->input('novelId');
      $bgCase = $request->input('bgCase');
      $bgId   = $request->input('bgId');

      if($bgCase == null || $bgId == null){
        $ttData =   DB::table('timetables')
                          ->join('novel_backgrounds','timetables.id','=','novel_backgrounds.background_id')
                          ->where('novel_backgrounds.belong_to_novel','=',$novelId)
                          ->where('novel_backgrounds.novel_background','=','timetables')
                          ->get();

      } else {
        $ttData = DB::table("timetables")
        ->join("effects","timetables.id", "=", "effects.timetable_id")
        ->join('novel_backgrounds','timetables.id','=','novel_backgrounds.background_id')
        ->where('novel_backgrounds.belong_to_novel','=',$novelId)
        ->where('novel_backgrounds.novel_background','=','timetables')
        ->where("affect_table","=",$bgCase)->where("affect_id","=",$bgId)
        ->get();
      }

      return $ttData;
    }

    // 연대표 정보 호출부
    // 연대표 정보 호출
    public function callAffectInfo(Request $request){
      $timetableId = $request->input('timetableId');
      $bgCase      = $request->input('bgCase');
      $table       = $bgCase;
      $affectId    = "id";
      if($bgCase == "relations") {
          $table = "relation_lists";
      }
      if($bgCase == "characters") {
          $affectId = "cha_id";
      }

      $ttData = DB::table("effects")->join($table, "effects.affect_id", "=", $table.".".$affectId)
      ->where("effects.timetable_id","=",$timetableId)
      ->where("effects.affect_table","=",$bgCase)
      ->get();


      return $ttData;
      //return $bgCase.$timetableId;
    }
    // 연대표 정보 호출 + 태그정보 호출
    public function callAffectInfoWithTag(Request $request){
      $timetableId = $request->input('timetableId');
      $bgCase      = $request->input('bgCase');
      $table       = $bgCase;
      $affectId    = "id";
      if($bgCase == "relations") {
          $table = "relation_lists";
      }
      if($bgCase == "characters") {
          $affectId = "cha_id";
      }

      $ttData = DB::table("effects")->join($table, "effects.affect_id", "=", $table.".".$affectId)
      ->where("effects.timetable_id","=",$timetableId)
      ->where("effects.affect_table","=",$bgCase)
      ->get();

      $ttIdArray = array();
      foreach($ttData as $td){
        array_push($ttIdArray, $td->affect_id);
      }

      $tagData = DB::table("tags")
      ->where("kind","=",$bgCase)
      ->whereIn("object_id", $ttIdArray)
      ->get();

      $data = [
        "affect_info" => $ttData,
        "tag_info"    => $tagData
      ];


      return $data;
    }

    // 태그 + 연관정보 호출부
    // 1. 캐릭터
    //    1) 소유사물
    public function callOwnItemsWithTag(Request $request){
      $bgId        = $request->input('bgId');
      $bgCase      = $request->input('bgCase');

      $bgData = DB::table("items")
      ->join("ownerships","items.id", "=", "ownerships.item_id")
      ->where("ownerships.character_id", "=", $bgId)
      ->get();

      $bgDataIdArray = array();
      foreach($bgData as $bd){
        array_push($bgDataIdArray, $bd->item_id);
      }

      $tagData = DB::table("tags")
      ->where("kind","=","items")
      ->whereIn("object_id", $bgDataIdArray)
      ->get();

      $data = [
        "affect_info" => $bgData,
        "tag_info"    => $tagData
      ];

      return $data;
    }
    //    2) 소속관계
    public function callBelongRelationsWithTag(Request $request){
      $bgId        = $request->input('bgId');
      $bgCase      = $request->input('bgCase');


      $listInfo = DB::table("relation_lists")
      ->join("relation_in_list","relation_lists.id", "=", "relation_in_list.listnum")
      ->join("relations", "relation_in_list.relnum", "=", "relations.relnum")
      ->where("relations.source", "=", $bgId)
      ->orWhere("relations.target", "=", $bgId)
      ->get();

      $listIdArray = array();
      foreach($listInfo as $li){
        array_push($listIdArray, $li->listnum);
      }

      $relInfo = DB::table("relations")
      ->join("relation_in_list","relations.relnum", "=", "relation_in_list.relnum")
      ->where("relations.source", "=", $bgId)
      ->orWhere("relations.target", "=", $bgId)
      ->whereIn("relation_in_list.listnum", $listIdArray)
      ->get();

      $chaInfo = DB::table("characters")->select()->get();

      $tagData = DB::table("tags")
      ->where("kind","=","relations")
      ->whereIn("object_id", $listIdArray)
      ->get();

      $data = [
        "list_info" => $listInfo,
        "rel_info"  => $relInfo,
        "cha_info"  => $chaInfo,
        "tag_info"  => $tagData
      ];

      return $data;
    }
    //    3) 참여사건
    public function callBelongTimetablesWithTag(Request $request){
      $bgCase  = $request->input('bgCase');
      $bgId    = $request->input('bgId');

      $btData = DB::table("timetables")
      ->join("effects", "timetables.id", "=", "effects.timetable_id")
      ->join("characters", "effects.affect_id", "=", "characters.cha_id")
      ->where("effects.affect_table", "=", "characters")
      ->where("effects.affect_id","=", $bgId)
      ->get();

      $btIdArray = array();
      foreach($btData as $bt){
        array_push($btIdArray, $bt->timetable_id);
      }

      $tagData = DB::table("tags")
      ->where("kind","=","timetables")
      ->whereIn("object_id", $btIdArray)
      ->get();

      $data = [
        "affect_info" => $btData,
        "tag_info"    => $tagData
      ];

      return $data;
    }
}
