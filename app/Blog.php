<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    // blogs(TABLE) INSERT DATAS
    public function newBlogD($data) {
        $dataSet = [];

        $dataSet = [
            'blog_introduce' => $data['blog_introduce'],
        ];

        $blog_id = DB::table('blogs')->insertGetId($dataSet);

        return $blog_id;
    }

    // blogs(TABLE) SELECT *
    // user id 매개변수로 받아오기
    // EXCEPT blog_menu_id
    public function basicBlogD($id) {
        $blogData = DB::table('blogs')
            ->join('user_blog_relations', 'blogs.id', '=', 'user_blog_relations.blog_id')
            ->select('blogs.*', 'user_blog_relations.user_id')
            ->where('user_blog_relations.user_id', '=', $id)
            ->get();

        return $blogData;
    }

    // blogs(TABLE) SELECT *
    // user id 매개변수로 받아오기
    // INCLUDE blog_menu_id
    public function allBlogD($id) {
        $blogData = DB::table('blogs')
            ->join('user_blog_relations', 'blogs.id', '=', 'user_blog_relations.blog_id')
            ->join('blog_menu_relations', 'blogs.id', '=', 'blog_menu_relations.blog_id')
            ->select('blogs.*', 'user_blog_relations.user_id', 'blog_menu_relations.blog_menu_id')
            ->where('user_blog_relations.user_id', '=', $id)
            ->get();

        return $blogData;
    }

    
}
