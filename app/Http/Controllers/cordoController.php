<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class cordoController extends Controller
{
  public function getNovelInfo(Request $request){
    $tasks = DB::table("novels")->get();
    return $tasks;
  }

  public function getTodayBestNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->get();
    return $tasks;
  }

  public function getFantasyBestNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('genre','=','fantasy')->get();
    return $tasks;
  }

  public function getRomanceBestNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('genre','=','romance')->get();
    return $tasks;
  }
  public function getMondayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%mon%')->get();
    return $tasks;
  }
  public function getTuesdayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%tue%')->get();
    return $tasks;
  }
  public function getWednesdayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%wed%')->get();
    return $tasks;
  }
  public function getThursdayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%thr%')->get();
    return $tasks;
  }
  public function getFridayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%fri%')->get();
    return $tasks;
  }
  public function getSaturdayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%sat%')->get();
    return $tasks;
  }
  public function getSundayNovelInfo(Request $request){
    $tasks = DB::table("novels")->select()->where('publish_case','=','day-publish')->where('period','like','%sun%')->get();
    return $tasks;
  }

  public function getNovelFromSearch(Request $request){
    $searchContent = $request->input('searchContent');
    //$task = DB::table("novels")->where('title','like','%'$searchContent'%')->get();
    $novelInfo = DB::table("novels")
    ->select("novel_writers.novel_id", "title", "summary_intro","cover_img_src","genre","name")
    ->join("novel_writers","novels.id", "=", "novel_writers.novel_id")
    ->join("users","novel_writers.user_id", "=", "users.id")
    //->where("novels.title","like","%무%")->get();
    ->where("novels.title","like","%".$searchContent."%")->get();
    return $novelInfo;
  }
  public function getNovelById(Request $request){
    $id = $request->input('id');
    $task = DB::table("novels")->where('id','=',$id)->get();
    return $task;
  }
  public function getNovelEpisodeById(Request $request){
    $id = $request->input('id');
    $task = DB::table("novel_episodes")->where('id','=',$id)->get();
    return $task;
  }
  public function getNovelEpisodes(Request $request){
    $id = $request->input('id');
    $task = DB::table("novel_episodes")->where('belong_to_novel','=',$id)->get();
    return $task;
  }
  public function getNovelNotices(Request $request){
    $id = $request->input('id');
    $task = DB::table("novel_episodes")->where('belong_to_novel','=',$id)->where('is_notice','=','1')->get();
    return $task;
  }

  //로그인 하기
  public function login(Request $request){
    $user_id = $request->input('id');
    $password = $request->input('pw');
    $task = DB::table("users")->where('user_id','=',$user_id)->where('password','=', $password)->get()->count();
      return $task;
  }
  //아이디 중복체크
  public function idCheck(Request $request){
    $user_id = $request->input('id');
    $task = DB::table("users")->where('user_id', '=', $user_id)->get()->count();
    return $task;
  }
  //아이디 찾기
  public function idSearch(Request $request){
    $emailInfo = $request->input('email');
    $task = DB::table('users')->select('user_id')->where('email','=',$emailInfo)->get();
    return $task;
  }
  //비밀번호 찾기
  public function pwSearch(Request $request){
    $user_id = $request->input('id');
    $emailInfo = $request->input('email');
    $task = DB::table('users')->select('password')->where('user_id', '=', $user_id)->where('email','=',$emailInfo)->get();
    return $task;
  }
  //회원 정보 입력
  public function insertUserInfo(Request $request){
      $id = $request->input('user_id');
      $nick = $request->input('nickname');
      $email = $request->input('email');
      $pw = $request->input('user_pw');
      DB::table('users')->insert([
        "user_id" => $id,
        "name" => $nick,
        "email" => $email,
        "password" => $pw
      ]);
    }

  //캐릭터 목록 가져오기
  public function getCharacters(Request $request){
    $tasks = DB::table("characters")->get();
    return $tasks;
  }

  //해당 소설을 작성한 작가 아이디 가져오기
  public function getUserIdOfNovel(Request $request){
    $novel_id = $request->input('id');
    $task = DB::table('users')
                    ->join('novel_writers', 'users.user_id', '=', 'novel_writers.user_id')
                    ->select('users.*')
                    ->where('novel_writers.novel_id', '=', $novel_id)
                    ->get();
    return $task;
  }

  //유저 정보 가져오기
  public function getUserInfo(Request $request){
    $user_id = $request->input('id');
    $task = DB::table('users')->select()->where('user_id', '=', $user_id)->get();
    return $task;
  }

  //블로그 정보 가져오기
  public function getUserIdOfBlogInfo(Request $request){
    $user_id = $request->input('id');
    $task = DB::table('blogs')
                    ->join('user_blog_relations', 'blogs.id', '=', 'user_blog_relations.blog_id')
                    ->select('blogs.*')
                    ->orderBy('id', 'desc')
                    ->get();
    return $task;
  }

  //블로그와 카테고리 연동하기(블로그-메뉴 조인)
  public function getBlogOfMenuJoinInfo(Request $request){
    $blog_id = $request->input('id');
    $task = DB::table('blog_menus')
                    ->join('blog_menu_relations', 'blog_menus.id', '=', 'blog_menu_relations.blog_menu_id')
                    ->select('blog_menus.*')
                    ->where('blog_menu_relations.blog_id', '=', $blog_id)
                    ->get();
    return $task;
  }


  //카테고리와 게시물 연동하여 메뉴 아이디 게시판 아이디 입력(메뉴-게시판 조인)
  public function insertMenuOfBoardJoinInfo(Request $request){
    $blog_menu_id = $request->input('menuId');
    $blog_board_id = $request->input('boardId');
    DB::table('menu_board_relations')->insert([
      "blog_menu_id" => $blog_menu_id,
      "blog_board_id" => $blog_board_id
    ]);
  }

  //카테고리와 게시물 연동하기(메뉴-게시판)
  public function getMenuOfBoardJoinInfo(Request $request){
    $task = DB::table('blog_boards')
                    ->join('menu_board_relations', 'blog_boards.id', '=', 'menu_board_relations.blog_board_id')
                    ->select('blog_boards.*')
                    ->orderBy('created_at', 'desc')
                    ->get();
    return $task;
  }

  //게시판 글쓰기
  public function insertBoardWrite(Request $request){
    $title = $request->input('titleVal');
    $readInfo = $request->input('contentVal');
    $noticeCheck = $request->input('CheckResult');
    DB::table('blog_boards')->insert([
      "board_title" => $title,
      "board_content" => $readInfo,
      "is_notice" => $noticeCheck
    ]);
    $task = DB::table('blog_boards')->select()->orderBy('id', 'desc')->limit('1')->get();
    return $task;
  }

  //게시물 정보 가져오기
  public function getContentReadInfo(Request $request){
    $board_id = $request->input('id');
    $task = DB::table('blog_boards')->select()->where('id', '=', $board_id)->get();
    return $task;
  }

  //블로그 아이디로 메뉴(카테고리)아이디 정보가져오기
  public function getBoardOfMenuInfo(Request $request){
    $board_id = $request->input('id');
    $task = DB::table('blog_menus')
                    ->join('menu_board_relations', 'blog_menus.id', '=', 'menu_board_relations.blog_menu_id')
                    ->select('blog_menus.*')
                    ->where('menu_board_relations.blog_board_id', '=', $board_id)
                    ->get();
    return $task;
  }

  //독자 게시판 메뉴 연결하기(블로그 - 독자메뉴 조인)
  public function getCommunicationMenuJoinInfo(Request $request){
    $blog_id = $request->input('id');
    $task = DB::table('communication_menus')
                    ->join('blog_communication_relations', 'communication_menus.id', '=', 'blog_communication_relations.communication_id')
                    ->select('communication_menus.*')
                    ->where('blog_communication_relations.blog_id', '=', $blog_id)
                    ->get();
    return $task;
  }

  //독자 게시판과 독자의 게시글 연결하여 정보 받아오기(독자메뉴 - 독자게시글 조인)
  public function getCommunicationBoardJoinInfo(Request $request){
    $task = DB::table('communication_boards')
                    ->join('communication_relations', 'communication_boards.id', '=', 'communication_relations.board_id')
                    ->select('communication_boards.*')
                    ->orderBy('created_at', 'desc')
                    ->get();
    return $task;
  }

  //독자 게시판에 글쓰기
  public function insertUserBoarWrite(Request $request){
    $title = $request->input('titleVal');
    $readInfo = $request->input('contentVal');
    $userName = $request->input('userName');
    DB::table('communication_boards')->insert([
      "board_title" => $title,
      "board_content" => $readInfo,
      "writer_name" => $userName
    ]);
    $task = DB::table('communication_boards')->select()->orderBy('id', 'desc')->limit('1')->get();
    return $task;
  }

  //독자게시판 메뉴와 독자게시판 게시글 등록
  public function insertCommunicationMenuOfBoardRelation(Request $request){
    $user_board_menu_id = $request->input('menuId');
    $user_board_id = $request->input('boardId');
    DB::table('communication_relations')->insert([
      "communication_id" => $user_board_menu_id,
      "board_id" => $user_board_id
    ]);
  }

  //유저 게시물 정보 가져오기
  public function getUserContentReadInfo(Request $request){
    $board_id = $request->input('id');
    $task = DB::table('communication_boards')->select()->where('id', '=', $board_id)->get();
    return $task;
  }


  public function getBackgroundSettingsHistoryGraph(Request $request){
    $backgroundData = DB::table('open_timetables')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
        $data[$i]['id'] = $datas->id;
        $data[$i]['event_name'] = $datas->event_names;
        $data[$i]['event_content'] = $datas->event_contents;
        $data[$i]['start_day'] = $datas->start_days;
        $data[$i]['end_day'] = $datas->end_days;
        $data[$i]['other'] = $datas->others;
        $data[$i]['refer_info'] = $datas->refer_info;
        $data[$i]['refer_info'] = explode('^',$data[$i]['refer_info']);

        $i++;
    }

    return $data;
  }

  public function getBackgroundSettingsHistoryCharacters(Request $request){
    $timetableId = $Request->input('id');
    $task = DB::table('open_effects')->where('id','=',$timetableId)->where('affect_table','=','characters')->get();

    // $data = array(array());
    //
    // $i = 0;
    // foreach ($backgroundData as $datas){
    //     $data[$i]['id'] = $datas->cha_id;
    //     $data[$i]['name'] = $datas->name;
    //     $data[$i]['img_src'] = $datas->img_src;
    //
    //     $i++;
    // }
    return $task;
  }

  public function getBackgroundSettingsHistoryItems(Request $request){
    $backgroundData = DB::table('open_items')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
        $data[$i]['id'] = $datas->id;
        $data[$i]['name'] = $datas->name;
        $data[$i]['img_src'] = $datas->img_src;

        $i++;
    }
    return $data;
  }

  public function getBackgroundSettingsHistoryMaps(Request $request){
    $backgroundData = DB::table('open_maps')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
        $data[$i]['id'] = $datas->id;
        $data[$i]['name'] = $datas->title;
        $data[$i]['img_src'] = $datas->cover_src;

        $i++;
    }
    return $data;
  }

  public function getBackgroundSettingsCharacters(Request $request){
    $backgroundData = DB::table('open_characters')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
      $data[$i]['id'] = $datas->id;
      $data[$i]['name'] = $datas->name;
      $data[$i]['info'] = $datas->info;
      $data[$i]['age'] = $datas->age;
      $data[$i]['gender'] = $datas->gender;
      //$data[$i]['refer_info'] = $datas->name;
      $data[$i]['img_src'] = $datas->img_src;

      $i++;
    }
    return $data;
  }

  public function getBackgroundSettingsItems(Request $request){
    $backgroundData = DB::table('open_items')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
      $data[$i]['id'] = $datas->id;
      $data[$i]['name'] = $datas->name;
      $data[$i]['info'] = $datas->info;
      $data[$i]['category'] = $datas->category;
      $data[$i]['refer_info'] = $datas->name;
      $data[$i]['img_src'] = $datas->img_src;

        $i++;
    }
    return $data;
  }
public function getBackgroundSettingsMaps(Request $request){
    $backgroundData = DB::table('open_maps')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
      $data[$i]['id'] = $datas->id;
      $data[$i]['cover_src'] = $datas->cover_src;
      $data[$i]['title'] = $datas->title;
      $data[$i]['created_at'] = $datas->created_at;
      $data[$i]['updated_at'] = $datas->updated_at;

        $i++;
    }
    return $data;
  }

  public function getBackgroundSettingsRelations(Request $request){
    $backgroundData = DB::table('open_relation_lists')->get();
    $data = array(array());

    $i = 0;
    foreach ($backgroundData as $datas){
      $data[$i]['title'] = $datas->title;
      $data[$i]['cover_src'] = $datas->cover_src;
      $i++;
    }
    return $data;
  }

  // public function getBackgroundSettingsRelations(Request $request){
  //   $backgroundData = DB::table('open_relation_lists')->get();
  //   $data = array(array());
  //
  //   $i = 0;
  //   foreach ($backgroundData as $datas){
  //     $data[$i]['relnum'] = $datas->relnum;
  //     $data[$i]['source'] = $datas->source;
  //     $data[$i]['target'] = $datas->target;
  //     $data[$i]['relationship'] = $datas->relationship;
  //
  //     $i++;
  //   }
  //   return $data;
  // }

  //유저의 포인트를 구매
  public function setPoint(Request $request){
    $user_id = $request->input('user_id');
    $point = $request->input('point');
    $first = $request->input('first');
    $current_point = $request->input('current_point');
    $final_point = $point + $current_point;

    if($first == 0){
      DB::table('users')->insert([
        "user_id" => $user_id,
        "point" => 0
      ]);
    }else if($first == 1){
      DB::table('users')->where('user_id','=',$user_id)->update(array('point' => $final_point));
    }
  }
  //유저의 포인트를 가져오기
  public function getPoint(Request $request){
    $user_id = $request->input('user_id');
    $task = DB::table('users')->where('user_id', '=', $user_id)->get();
    return $task;
  }
  //유저의 포인트를 수정
  public function setPointAgain(Request $request){
    $point = $request->input('current_point');
    $update_point = $point - 100;
    $user_id = $request->input('user_id');
    DB::table('users')->where('user_id','=',$user_id)->update(array('point'=>$update_point));
    $task = DB::table('users')->where('user_id', '=', $user_id)->get();
    return $task;
  }

  //관심등록 설정
  public function setFavorite(Request $request){
    $user_id = $request->input('user_id');
    $novel_id = $request->input('novel_id');
    DB::table('add_favorite')->insert([
      "user_id" => $user_id,
      "novel_id" => $novel_id
    ]);
  }
  //관심등록 삭제
  public function delFavorite(Request $request){
    $user_id = $request->input('user_id');
    $novel_id = $request->input('novel_id');
    DB::table('add_favorite')->where('user_id','=',$user_id)->where('novel_id','=',$novel_id)->delete();
  }

  //관심등록된 소설 가져오기
  public function getFavorite(Request $request){
    $user_id = $request->input('user_id');
    $task = DB::table('add_favorite')->where('user_id','=',$user_id)->get();
    return $task;
  }





  //캐릭터 정보 가져오기
//   public function getCharactersInfo(){
//     $id = $request->input('id');
//     $task = DB::table("characters")->where('id','=',$id)->get();
//     return $task;
//   }
}
