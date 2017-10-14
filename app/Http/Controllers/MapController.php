<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use File;
use App\Map;
use App\Background;
use App\Tag;

class MapController extends Controller
{
    public function index() {
        // 소설 세션 검사
        //session_start();
        if(!isset($_COOKIE['novel_id'])){
            return redirect('background');
        }
        else {
            $novel_id = $_COOKIE['novel_id'];
        }

        $imgRoot = "img/background/mapImg";
        $img_src = DB::select("select * from map_images");

        $data = array();

        foreach ($img_src as $datas) {
            $d_arr = [
                "id"        => $datas->id,
                "img_src"   => $imgRoot."/".$datas->img_src
            ];
            array_push($data, $d_arr);
        }

        return view('background.map.map_view')->with("data", $data);
    }

    // 맵 목록
    public function getMapList() {
      //session_start();
      $novel_id = $_COOKIE['novel_id'];
      $background = new Background();

      $mapsInfos = DB::table('maps')
                      ->join('novel_backgrounds','maps.id','=','novel_backgrounds.background_id')
                      ->where('novel_backgrounds.belong_to_novel','=',$novel_id)
                      ->where('novel_backgrounds.novel_background','=','maps')
                      ->get();

      return $mapsInfos;
    }

    public function getGridsContent(Request $request){
      $mapId = $request->input('id');

      $gridInfo = DB::table("grids")->where("belong_to_map","=",$mapId)->get();
      $textInfo = DB::table("map_texts")->where("belong_to_map","=",$mapId)->get();

      $mapInfos = [
        "gridInfo"=>$gridInfo,
        "textInfo"=>$textInfo
      ];
      return $mapInfos;
    }

    // 지도 등록
    public function mapStore(Request $request){
      // 맵 , 그리드, 텍스트 정보
      $title = $request->input('title');
      $gridInfos = json_decode($request->input('gridInfos'));

      $textInfos = json_decode($request->input('textInfos'));
      // 이미지 커버 저장
      $canvasUrl = $request->input('canvasUrl');


      $destinationPath = 'img/background/mapImg/mapCover/';
      $fileName = date("Y").date("m").date("d").date("s")."_".$title.".png";
      $outputFile = $destinationPath.$fileName;
      $ifp = fopen( $outputFile, 'wb' );

      $data = explode( ',', $canvasUrl);
      fwrite( $ifp, base64_decode( $data[ 1 ] ) );
      fclose( $ifp );

      // 맵 데이터 추가
      $mytime = date('Y-m-d H:i:s');
      DB::table("maps")->insert([
          "cover_src"  => $fileName,
          "title"      => $title,
          "created_at" => $mytime
      ]);

      // 등록한 맵 아이디 호출
      $mapsInfo = DB::table("maps")->select("id","created_at","updated_at")->orderBy('id', 'DESC')->first();
      $mapsId = $mapsInfo->id;
      $createdAt = $mapsInfo->created_at;
      $updatedAt = $mapsInfo->updated_at;

      // 그리드 테이블 등록
      foreach($gridInfos as $gridInfo){
        DB::table("grids")->insert([
            "belong_to_map"  => $mapsId,
            "grid_id"        => $gridInfo->grid_id,
            "fill_info"      => $gridInfo->fill_info
        ]);
      }

      // 텍스트 테이블 등록
      foreach($textInfos as $textInfo){
        DB::table("map_texts")->insert([
            "belong_to_map"  => $mapsId,
            "text_id"        => $textInfo->text_id,
            "content"        => $textInfo->content,
            "font_family"    => $textInfo->font_family,
            "font_size"      => $textInfo->font_size,
            "letter-spacing" => $textInfo->letter_spacing,
            "fill_color"     => $textInfo->fill_color
        ]);
      }
    
        // JJH auto tag
        // 2017.08.11
        $tag = new Tag();

        $tag_insert_data = array();
        $tag_insert_data['page'] = "maps";
        $tag_insert_data['object_id'] = $mapsId;
        $tag_insert_data['tag_name'] = $title;
        $tag_insert_data['tag_color'] = "f0f00f";
        $tag->insertTag($tag_insert_data);

      // 소설 - 배경정보
      //session_start();
      $novel_id = $_COOKIE['novel_id'];
      $background = new Background();

      $novel_background_data = array();
      $novel_background_data['belong_to_novel'] = $novel_id;
      $novel_background_data['novel_background'] = "maps";
      $novel_background_data['background_id'] = $mapsId;
      $background->insertData($novel_background_data);

      return $mapsId."/".$createdAt;
    }

    // 지도 삭제

    public function removeMap(Request $request){
      $mapId = $request->input('mapId');
      DB::table("maps")->where('id','=',$mapId)->delete();
      DB::table("grids")->where('belong_to_map','=',$mapId)->delete();
      DB::table("map_texts")->where('belong_to_map','=',$mapId)->delete();
      return $mapId;
    }

    //지도 이미지 업로드
    public function mapImgStore(Request $request) {
        $file = $request->file('imgFile');
        $destinationPath = 'img/background/mapImg';
        $fileName = date("Y").date("m").date("d").date("s").$file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        DB::table("map_images")->insert([
            // "id" => 1,     // 유저 아이디는 임의값
            "user_id" => 1,
            "img_src" => $fileName
        ]);
        $imgId = DB::table("map_images")->select("id")->where("user_id","=",1)->orderBy('id', 'DESC')->first();
        $data = [
          "imgId" => $imgId->id,
          "imgPath" => $destinationPath."/".$fileName
        ];

        return $data;
    }

    //지도 이미지 호출
    public function getImgCellList(Request $request){
      $userId = $request->input('userId');
      $data = DB::table("map_images")->select("id","img_src")->where("user_id","=",$userId)->get();
      return $data;
    }

    //저장된 이미지 삭제
    public function removeImg(Request $request){
        $imgId = $request->input('imgId');
        $destinationPath = '/img/background/mapImg';
        $removeFile = DB::table("map_images")->select("img_src")->where('id','=',$imgId)->get();
        $removeFile = $removeFile[0]->img_src;

        DB::table("map_images")->where('id','=',$imgId)->delete();
        File::delete(public_path().$destinationPath.$removeFile);

        return $removeFile;
    }
}
