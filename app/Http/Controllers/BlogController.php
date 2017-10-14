<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use  App\User;
use  App\Blog;
use  App\BlogMenu;
use  App\BlogBoard;

use App\CommunicationMenu;
use App\BlogCommunicationRelation;

use  App\UserBlogRelation;
use  App\BlogMenuRelation;
use  App\MenuBoardRelation;
use  App\BoardFileRelation;

class BlogController extends Controller
{
/*
|--------------------------------------------------------------------------
| BLOG VIEW
|--------------------------------------------------------------------------
*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     * MAIN PAGE OF BLOG
     * @param The OWNER's $user_id (DataType : STRING)
     * @return \Illuminate\Http\Response
     */
    public function showBlogMain($ownerId) 
    {
        
        // Blog's OWNER user_id (DataType : STRING)
        $blog_owner_id = $ownerId;

        // echo ($blog_owner_id);

        // 현재 접속 유저의 아이디 또한 구해서 변수 지정하기!
        $current_user_id = "yerriel";

        // echo($blog_owner_id);

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->allUserBlogRD($blog_owner_id);

        // print_r($userBlogRD);

        if (empty($userBlogRD[0])) {
            // echo "EMPTY!";
            if ($blog_owner_id == $current_user_id) {
                $data[0] = "Please create a blog.";
            } else {
                $data[0] = "ERROR!";
            }

            // DataTyape : STRING
            $data[1] = $blog_owner_id;
            $data[2] = $current_user_id;

        } else {
            // print_r($userBlogRD);

            foreach ($userBlogRD as $datas) {
                // DataType : STRING
                $blog_owner_id = $datas->user_id;
                // DataType : INT
                $blog_id = $datas->blog_id;
                // DataType : STRING
                $blog_owner_name = $datas->name;
                // DataType : INT
                $blogOwnerId = $datas->id;
            }

            // var_dump(is_string($blog_owner_id));

            $board = new BlogBoard();
            $boardData = $board->allBoardD($blogOwnerId);
            $data = array(array());

            $i = 0;

            // print_r($boardData);

            if(empty($boardData[0])) {
                $data[0] = 0;
                // DataType : STRING
                $data[1] = $blog_owner_id;
                // DataType : INT
                $data[2] = $blogOwnerId;
            } else {

                foreach($boardData as $datas) {
                    $data[$i]['id'] = $datas->id;   // blog_board_id

                    // DataType : INT
                    $data[$i]['blogOwnerId'] = $datas->user_id; // blog_owner_id & user_id 구분하기
                    $data[$i]['blog_id'] = $blog_id;
                    $data[$i]['blog_menu_id'] = $datas->blog_menu_id;

                    // DataType : STRING
                    $data[$i]['blog_owner_id'] = $blog_owner_id;
                    $data[$i]['blog_owner_name'] = $blog_owner_name;

                    $data[$i]['board_title'] = $datas->board_title;
                    $data[$i]['is_notice'] = $datas->is_notice;
                    // $data[$i]['board_hit'] = $datas->board_hit;
                    // $data[$i]['board_like'] = $datas->board_like;
                    $data[$i]['board_content'] = $datas->board_content;
                    $data[$i]['created_at'] = $datas->created_at;
                    $data[$i]['updated_at'] = $datas->updated_at;
                    // show($id)'s $id : blog_menu_id&id
                    $hrefArr = array($data[$i]['blogOwnerId'], $data[$i]['blog_menu_id'], $data[$i]['id']);
                    $data[$i]['href'] = implode("&", $hrefArr);

                    $i++;
                }
            }

            
        }

        // print_r($data);
        // echo($data[0]);

        return view('writer_blog.blog_main')->with("data", $data);
    }

    /**
     * Display View All Boards of the Selected Menu.
     * @param $blog_menu_id (DataType : INTEGER)
     * @return selected_menu_view.blade.php
     */
    public function selectedMenu($ownerId, $menuId) 
    {
        $blog_owner_id = $ownerId;
        $blog_menu_id = $menuId;

        // echo($blog_owner_id);

        $data[2] = $blog_owner_id;

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->checkUserId($blog_owner_id);

        // print_r($userBlogRD);

        foreach ($userBlogRD as $user) {
            $blog_owner_id = $user->user_id;
        }

        // print_r($blog_owner_id);

        // var_dump(is_int($blog_owner_id));

        $menuBoard = new BlogBoard();
        $menuBoardD = $menuBoard->selectedMenuBoardD($blog_menu_id);

        //nvar_dump($menuBoardD);
        // print_r($menuBoardD);

        if(empty($menuBoardD[0])) {
            // echo("empty!");

            $data[0] = "empty";
            $data[1] = $blog_owner_id;
        } else {
            $data[0] = $blog_menu_id;
            $data[1] = $blog_owner_id;
        }

        // echo($data);
        // print_r($data);
        

        return view('writer_blog.selected_menu_view')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return $data = $blog_id
     */
    public function createBoard($ownerId)
    {
        //
        // echo ("create() RUNNING");

        $owner_id = $ownerId;

        // echo $owner_id;
        
        // $user = new User();
        // $userData = $user->searchUserId($owner_id);

        // // echo $userData;

        // foreach ($userData as $datas) {
        //     $user_id = $datas->id;
        // }

        // var_dump(is_int($user_id));

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->allUserBlogRD($owner_id);

        foreach ($userBlogRD as $datas) {
            $data['blog_id'] = $datas->blog_id;
            $data['blog_owner_id'] = $owner_id;
        }

        // var_dump(is_int($blog_id));

        // print_r($data);


        return view('writer_blog.board.write_form')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     * Store the Board's contents
     * @param  \Illuminate\Http\Request  $request of BOARD WRITE FORM
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        // print_r($data);


        $board = new BlogBoard();
        $blog_menu_board_relation = new MenuBoardRelation();

        // INSERT DATAS INTO blog_boards TABLE
        $blog_board_id = $board->newBoardD($data);

        // INSERT DATAS INTO menu_board_relations TABLE
        $blog_menu_board_relation->insertRelationD($data['blog_menu_id'], $blog_board_id);

        return redirect()->action(
            'BlogController@showBlogMain', ['ownerId' => $data['blog_owner_id']]
        );
    }

    /**
     * Display the specified resource.
     * Display the Boards of Blog.
     * @param  int  $id(of URL)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo $id;
        // Is There "&"?
        if (strpos($id, "&")!==false) {
            $hrefArr = explode('&', $id);

            // print_r($hrefArr);

            // DataType : INT
            $blog_owner_id = $hrefArr[0];
            $blog_menu_id = $hrefArr[1];
            $post_id = $hrefArr[2];

            $board = new BlogBoard();
            $boardData = $board->selectedBoardD($blog_owner_id, $blog_menu_id, $post_id);

            // var_dump($boardData);

            $data = array(array());
            $i = 0;

            foreach ($boardData as $datas) {
                // DataType : INT
                $data[$i]['blog_owner_id'] = $blog_owner_id;
                // DataType : INT
                $data[$i]['id'] = $post_id;   // blog_board_id
                $data[$i]['blog_menu_id'] = $blog_menu_id;

                $data[$i]['menu_title'] = $datas->menu_title;

                $data[$i]['board_title'] = $datas->board_title;
                $data[$i]['is_notice'] = $datas->is_notice;
                // $data[$i]['board_hit'] = $datas->board_hit;
                // $data[$i]['board_like'] = $datas->board_like;
                $data[$i]['board_content'] = $datas->board_content;
                $data[$i]['created_at'] = $datas->created_at;
                $data[$i]['updated_at'] = $datas->updated_at;

                $i++;
            }

             
        } else {
            //
        }
        
        // print_r($data);
        return $data;
    }

/*
|--------------------------------------------------------------------------
| BLOG SIDE MENU BAR - NOVEL LIST
|--------------------------------------------------------------------------
*/
    /**
     * Display the specified resource.
     * Display the Boards of Blog.
     * @param  string  $blog_owner_id
     * @return \Illuminate\Http\Response
     */
    public static function showAllNovel($ownerId)
    {
        $blog_owner_id = $ownerId;

        echo $blog_owner_id;

        // return view('writer_blog.part.novel_list');
    }



/*
|--------------------------------------------------------------------------
| BLOG READERS COMMUNICATION
|--------------------------------------------------------------------------
*/

    public function showBlogCommunication($ownerId) 
    {
        // (DataType : STRING)
        $blog_owner_id = $ownerId;

        $data[0] = $blog_owner_id;

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->checkUserId($blog_owner_id);

        foreach ($userBlogRD as $user) {
            // (DataType : INT)
            $data[1] = $user->user_id;
            $data[2] = $user->blog_id;
            //
            $blog_id = $data[2];
            
        }
        $data[3] = $blog_id."&".$blog_owner_id;

        // print_r($data);

        return view('writer_blog.blog_communication_board')->with('data', $data);
    }








/*
|--------------------------------------------------------------------------
| BLOG VIEW - STATIC FUNCTIONS
|--------------------------------------------------------------------------
*/
    public static function showBlogSideMenu($id) 
    {
        // Blog's OWNER user_id (DataType : STRING)
        $blog_owner_id = $id;

        // 현재 접속 유저의 아이디 또한 구해서 변수 지정하기!
        $current_user_id = "yerriel";

        // echo($blog_owner_id);

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->allUserBlogRD($blog_owner_id);

        // print_r($userBlogRD);

        foreach ($userBlogRD as $datas) {
            // DataType : STRING
            $blog_owner_id = $datas->user_id;
            // DataType : INT
            $blog_id = $datas->blog_id;
            // DataType : STRING
            $blog_owner_name = $datas->name;
            // DataType : INT
            $user_id = $datas->id;
        }

        // var_dump(is_int($user_id));


        // var_dump(is_string($blog_owner_name));

        // echo $user_id;

        $blog = new Blog();
        $blogData = $blog->allBlogD($user_id);

        $data = array(array());

        $i = 0;

        if (empty($blogData[0])) {
            // echo("empty!");

            $blogData = $blog->basicBlogD($user_id);

            foreach($blogData as $datas) {
                $data[$i]['id'] = $datas->id;   // blog auto-increments id

                $data[$i]['user_id'] = $datas->user_id;
                $data[$i]['blog_menu_id'] = "empty";

                // DataType : STRING
                $data[$i]['blog_owner_id'] = $blog_owner_id;
                $data[$i]['blog_owner_name'] = $blog_owner_name;

                // $data[$i]['cover_img_src'] = $datas->cover_img_src;
                $data[$i]['blog_introduce'] = $datas->blog_introduce;
                $data[$i]['today_hit'] = $datas->today_hit;
                $data[$i]['total_hit'] = $datas->total_hit;

                $i++;
            }
        } else {
            foreach($blogData as $datas) {
                $data[$i]['id'] = $datas->id;   // blog auto-increments id

                // DataType : INT
                $data[$i]['user_id'] = $datas->user_id;
                $data[$i]['blog_menu_id'] = $datas->blog_menu_id;

                // DataType : STRING
                $data[$i]['blog_owner_id'] = $blog_owner_id;
                $data[$i]['blog_owner_name'] = $blog_owner_name;

                // $data[$i]['cover_img_src'] = $datas->cover_img_src;
                $data[$i]['blog_introduce'] = $datas->blog_introduce;
                $data[$i]['today_hit'] = $datas->today_hit;
                $data[$i]['total_hit'] = $datas->total_hit;

                $i++;
            }
        }

        // print_r($data);
        
        return view('writer_blog.blogSideMenu')->with("data", $data);
    }

   
    public static function wirteFormMenuList($id)
    {
        $blog_id = $id;

        $menu = new BlogMenu();
        $menuData = $menu->allMenuD();

        $data = array(array());
        $i = 0;

        foreach ($menuData as $datas) {
            $data[$i]['id'] = $datas->id;

            $data[$i]['blog_id'] = $datas->blog_id;

            $data[$i]['menu_title'] = $datas->menu_title;

            $i++;
        }
        
        return view('writer_blog.board.select_menu_list')->with('data', $data);
    }

    
    public static function mainNoticeList($ownerId) 
    {
        // DataType : INT
        $blog_owner_id = $ownerId;

        $boardTable = new BlogBoard();

        $noticeList = $boardTable->noticeListBoardD($blog_owner_id);

        $data = array(array());
        $i = 0;
        
        foreach($noticeList as $datas) {
            $data[$i]['id'] = $datas->id;   // board_id
            $data[$i]['blog_menu_id'] = $datas->blog_menu_id;
            $data[$i]['board_title'] = $datas->board_title;
            $data[$i]['is_notice'] = $datas->is_notice;
            $data[$i]['created_at'] = $datas->created_at;
            $data[$i]['updated_at'] = $datas->updated_at;

            $data[$i]['blog_owner_id'] = $blog_owner_id;

            // show($id)'s $id : blog_menu_id&board_id
            $hrefArr = array($data[$i]['blog_owner_id'], $data[$i]['blog_menu_id'], $data[$i]['id']);
            $data[$i]['href'] = implode("&", $hrefArr);

            $i++;
        }

        // var_dump($data);

        return view('writer_blog.part.main_notice_list')->with('data', $data);
    }

    /**
    * Display ALL Boards of Blog.
    * Laravel pagination
    * @param $blog_id (DataType : INT)
    * @return view('writer_blog.all_boards_view', ['boardData' => $boardData])
    */
    public static function allBoard($blogId)
    {
        $blog_id = $blogId;

        $board = new BlogBoard();
        $boardData = $board->orderAllBoardD($blog_id);

        // print_r($boardData);



        return view('writer_blog.all_boards_view', ['boardData' => $boardData]);
    }

    /**
     * Display ALL Menus of Blog.
     * @param $blog_id (DataType : INTEGER)
     * @return view('writer_blog.part.blog_menu_list')
     */
    public static function showAllMenu($id)
    {
        $blog_id = $id;

        // echo($blog_id);

        $menu = new BlogMenu();
        $menuData = $menu->allMenuD();

        // print_r($menuData);

        $data = array(array());
        $i = 0;

        foreach ($menuData as $datas) {
            $data[$i]['id'] = $datas->id;   // blog-menu auto increments id

            // $data[$i]['blog_id'] = $datas->blog_id;

            $data[$i]['menu_title'] = $datas->menu_title;

            $i++;
        }

        // print_r($data);

        return view('writer_blog.part.blog_menu_list')->with('data', $data);
    }

    /**
     * Display View All Boards of the Selected Menu.
     * Laravel pagination
     * @param $blog_menu_id (DataType : INTEGER)
     * @return view('writer_blog.selected_menu_board', ['data' => $data])
     */
    public static function selectedMenuAllB($id) 
    {
        $blog_menu_id = $id;

        // print_r($blog_menu_id);

        $menuBoard = new BlogBoard();
        $data = $menuBoard->selectedMenuBoardD($blog_menu_id);
        
        return view('writer_blog.selected_menu_board', ['data' => $data]);
    }

    
    


/*
|--------------------------------------------------------------------------
| CREATE BLOG
|--------------------------------------------------------------------------
*/
    /**
     * Display View Form of Create Blog.
     * @param $blog_owner_id (DataType : INTEGER)
     * @return view('writer_blog.blog.blog_create_form')
     */
    public static function showBlogCreateForm($id) 
    {
        // print_r($data);

        // Blog's OWNER user_id (DataType : STRING)
        $blog_owner_id = $id[1];
        // Current User user_id (DataType : STRING)
        // $current_user_id = $data[2];

        // echo $blog_owner_id;

        $data[0] = $blog_owner_id;

        return view('writer_blog.blog.blog_create_form')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBlogCreateForm(Request $request)
    {
        //
        // echo("PASS"); 

        $data = $request->all();

        // print_r($data);

        $ownerId = $data['blog_owner_id'];
        // var_dump(is_string($ownerId));

        $blog = new Blog();

        $user = new User();

        $communication = new CommunicationMenu();

        $blog_communication_relation = new BlogCommunicationRelation();

        $user_blog_relation = new UserBlogRelation();

        // INSERT DATAS INTO blogs TABLE
        // $blog_id (DataType : INT)
        $blog_id = $blog->newBlogD($data);

        $communication_id = $communication->newCommunicationD();
        $blogCommunicationR = $blog_communication_relation->insertData($blog_id, $communication_id);

        // $userData (DataType : INT)
        $userData = $user->searchUserId($ownerId);

        foreach ($userData as $datas) {
            $owner_id = $datas->id;
        }

        // echo $owner_id;

        // var_dump(is_int($owner_id));

        // INSERT DATAS INTO user_blog_relations TABLE
        $user_blog_relation->insertRelationD($owner_id, $blog_id);

        return redirect()->action(
            'BlogController@showBlogMain', ['ownerId' => $ownerId]
        );
    }











/*
|--------------------------------------------------------------------------
| BLOG SET MAP (MENU, DESIGN)
|--------------------------------------------------------------------------
*/

    /**
     * Display the specified resource.
     * Display the setting-maps-main of Blog.
     * @param $user_id(DataType : INTEGER)
     * @return blog_set_main.blade.php
     */
    public function showSetMapMain($ownerId, $blogId)
    {
        // echo $id;
        $owner_id = $ownerId;
        $blog_id = $blogId;

        // echo $blog_id;

        return view('writer_blog.set.blog_set_main')->with('blog_id', $blog_id);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return blog_set_main.blade.php
     */
    public function createMenu($ownerId, $blogId)
    {
        $owner_id = $ownerId;
        $blog_id = $blogId;

        // echo $blog_id;

        // 메뉴 테이블 전체의 메뉴 아이디 및 메뉴 제목, 블로그 아이디 게시글 아이디
        $menu = new BlogMenu();
        $menuData = $menu->allMenuD();
        // print_r($menuData);

        $data = array(array());

        $i = 0;

        if (empty($menuData[0])) {
            $data[0]['id'] = 0;
            $data[0]['blog_id'] = $blog_id;
        } else {
            foreach($menuData as $datas) {
                $data[$i]['id'] = $datas->id;   // menu auto-increments id

                $data[$i]['blog_id'] = $blog_id;
                // $data[$i]['blog_board_id'] = $datas->blog_board_id;

                $data[$i]['menu_title'] = $datas->menu_title;

                $i++;
            }
        }

        // print_r($data);

        return view('writer_blog.set.menu.blog_set_menu')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMenu(Request $request)
    {
        //
        // echo("PASS"); 

        $data = $request->all();

        // print_r($data);

        // echo($data['owner_id']);

        $menu = new BlogMenu();
        $blog_menu_relation = new BlogMenuRelation();

        // INSERT DATAS INTO blog_boards TABLE
        $blog_menu_id = $menu->newMenuD($data);

        // INSERT DATAS INTO menu_board_relations TABLE
        $blog_menu_relation->insertRelationD($data['blog_id'], $blog_menu_id);

        return redirect()->action(
            'BlogController@showBlogMain', ['ownerId' => $data['owner_id']]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu($ownerId, $blogId)
    {
        //
    }










/*
|--------------------------------------------------------------------------
| RESTFull
|--------------------------------------------------------------------------
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return $data = $blog_id
     */
    public function create()
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

