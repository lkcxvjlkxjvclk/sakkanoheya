<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;
use File;

class UpImgController extends Controller
{
    // File 형식으로 받은 이미지 업로드
    public function uploadImg(Request $request){
      $file = $request->file('imgFile');
      $destinationPath = 'upload/images';
      $fileName = date("Y").date("m").date("d").date("s").$file->getClientOriginalName();
      $file->move($destinationPath, $fileName);

      DB::table("cover_images")->insert([
        "user_id" => 1,     // 유저 아이디는 임의값
        "cover_img_src" => $fileName
      ]);

      return $fileName;
    }

    // 저장된 이미지 삭제
    public function removeImg(Request $request){
      $userId = $request->input('userId');
      $removeFile = $request->input('removeFile');

      File::delete(public_path()."/upload/images/".$removeFile);
      DB::table("cover_images")->where('user_id','=',$userId)->where('cover_img_src','=',$removeFile)->delete();
      return $removeFile;
    }

    // File 형식으로 받은 이미지 업로드
    public function uploadEpisodeImg(Request $request){

      $file = $request->file('imgFile');
      $novelId = $request->input('novelId');

      $destinationPath = 'upload/images';
      $fileName = date("Y").date("m").date("d").date("s").$file->getClientOriginalName();
      $file->move($destinationPath, $fileName);

      DB::table("episode_images")->insert([
        "novel_id" => $novelId,     // 유저 아이디는 임의값
        "cover_img_src" => $fileName
      ]);

      return $fileName;
    }

    // 저장된 이미지 삭제
    public function removeEpisodeImg(Request $request){
      $novelId = $request->input('novelId');
      $removeFile = $request->input('removeFile');

      File::delete(public_path()."/upload/images/".$removeFile);
      DB::table("episode_images")->where('novel_id','=',$novelId)->where('cover_img_src','=',$removeFile)->delete();
      return $removeFile;
    }
}
