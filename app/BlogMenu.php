<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogMenu extends Model
{
    // blog_menus(TABLE) INSERT DATAS
    public function newMenuD($data) {
        $dataSet = [];

        $dataSet = [
            'menu_title' => $data['menu_title'],
        ];

        // print_r($dataSet);

        $blog_menu_id = DB::table('blog_menus')->insertGetId($dataSet);

        return $blog_menu_id;
    }

    // blog_menus(TABLE)
    // SELECT *
    public function allMenuD() {
        $menuData = DB::table('blog_menus')
            ->join('blog_menu_relations', 'blog_menus.id', '=', 'blog_menu_relations.blog_menu_id')
            ->select('blog_menus.*', 'blog_menu_relations.blog_id')
            ->get();


        return $menuData;
    }
}
