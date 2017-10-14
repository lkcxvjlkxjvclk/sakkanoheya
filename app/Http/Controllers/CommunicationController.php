<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use App\UserBlogRelation; 
use App\CommunicationRelation; 
// Communication Menu & Board Relation
use App\BlogCommunicationRelation;

use App\CommunicationMenu;
use App\CommunicationBoard;

class CommunicationController extends Controller
{
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
     * Display View All Boards of the COMMUNICATION Menu.
     * @param $blog_id(INT)&$blog_owner_id(STRING)
     * @return view('writer_blog.all_comunication_boards')
     */
    public static function allCommunicationB($id)
    {
        $listArr = explode('&', $id);

        // var_dump($listArr);

        // DataType INT
        $blogId = $listArr[0];
        // DataType STRING
        $blog_owner_id = $listArr[1];
        // (모델 이용) 독자게시판에 작성된 글의 id, 제목, 작성자, 작성일, 조회수, 추천이 나와야한다
        // 

        $communityB = new CommunicationBoard;
        $communityBD = $communityB->allBoardD($blogId);


        if(empty($communityBD[0])) {
            // echo("EMPTY");
            $data[0]['blogId'] = $blogId;
            $data[0]['empty'] = 0;
        } else {
            // print_r($communityBD);

            $data = array(array());
            $i = 0;

            foreach ($communityBD as $datas) {
                // DataType STRING
                $data[$i]['blog_owner_id'] = $blog_owner_id;
                // DataType INT
                $data[$i]['community_id'] = $datas->communication_id;
                // DataType INT
                $data[$i]['blog_id'] = $blogId;
                // DataType INT
                $data[$i]['board_id'] = $datas->id;
                $data[$i]['board_title'] = $datas->board_title;
                $data[$i]['writer_name'] = $datas->writer_name;
                $data[$i]['created_at'] = $datas->created_at;
                // $data[$i]['board_hit'] = $datas->board_hit;
                // $data[$i]['board_like'] = $datas->board_like;

                $i++;
            }
        }
        // print_r($data);

        return view('writer_blog.all_comunication_boards')->with('data', $data);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCommunityBoard($ownerId)
    {
        // blogSideMenu DataType STRING blog_owner_id 
        // blog_id

        // DataType : STRING
        $data['blog_owner_id'] = $ownerId;

        // echo($blog_owner_id);

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->checkUserId($data['blog_owner_id']);

        // print_r($userBlogRD);

        foreach ($userBlogRD as $datas) {
            $data['blog_id'] = $datas->blog_id;
            $data['blogOwnerId'] = $datas->user_id;
        }

        // var_dump(is_int($data['blog_id']));

        $data['community'] = 1;

        //var_dump($data);

        return view('writer_blog.board.write_form')->with('data', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        // print_r($data['blog_id']);

        $blogCommunityR = new BlogCommunicationRelation();
        $blogCommunityRD = $blogCommunityR->checkCommunityId($data['blog_id']);

        foreach ($blogCommunityRD as $id) {
            $community_id = $id->communication_id;
        }

        // var_dump(is_int($community_id));

        $communityB = new CommunicationBoard();
        $communityBD = $communityB->newBoardD($data);

        $communityR = new CommunicationRelation();
        $communityRD = $communityR->insertRelationD($community_id, $communityBD);

        return redirect()->action(
            'BlogController@showBlogCommunication', ['ownerId' => $data['blog_owner_id']]
        );
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
        // echo($id);

        $hrefArr = explode('&', $id);

        // print_r($hrefArr);

        // DataType STRING
        $blog_owner_id = $hrefArr[0];
        // DataType INT
        $blog_id = $hrefArr[1];
        $community_id = $hrefArr[2];
        $board_id = $hrefArr[3];

        $userBlogR = new UserBlogRelation();
        $userBlogRD = $userBlogR->checkUserId($blog_owner_id);

        foreach ($userBlogRD as $datas) {
            // DataType INT
            $blogOwnerId = $datas->user_id;
        }

        $communityB = new CommunicationBoard();
        $communityBD = $communityB->selectedBoardD($community_id, $board_id);

        // print_r($communityBD);

        foreach ($communityBD as $datas) {
            $data['board_title'] = $datas->board_title;
            $data['board_content'] = $datas->board_content;
            $data['writer_name'] = $datas->writer_name;
            $data['created_at'] = $datas->created_at;

            // DataType STRING
            $data['blog_owner_id'] = $blog_owner_id;
            // DataType INT
            $data['blogOwnerId'] = $blogOwnerId;
        }

        // print_r($data);

        return view('writer_blog.community.selected_board_view')->with('data', $data);
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
