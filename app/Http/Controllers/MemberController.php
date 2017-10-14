<?php

namespace App\Http\Controllers;

use DB;
use Input;
use Session;
use Redirect;
use Validator;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function login_index() {
        return view('login.login');
    }
    
    public function login(Request $req){
        $user_id = Input::get('user_id');
        $password = Input::get('password');
        $point = DB::table('users')->select("point")->where(['user_id' => $user_id])->get();

        $point = $point[0]->point;

        $checkLogin = DB::table('users')->where(['user_id' => $user_id, 'password' => $password])->get();
        
        // 로그인 성공 시 세션 생성
        if(count($checkLogin) > 0) {
            Session::put('user_id', $user_id);
            Session::put('point', $point);
        }
        else {
            return view('login.login');
        }
    }

    public function register_index() {
        return view('login.register');
    }

    // 회원가입
    public function register(Request $req) {
        $user_id = Input::get('user_id');
        $name = Input::get('name');
        $email = Input::get('email');

        $checkRegister = DB::table('users')->where(['user_id' => $user_id, 'name' => $name, 'email' => $email])->get();
        
        if(count($checkRegister) > 0){
            echo "<script>alert(\"会員登録失敗\");</script>";
            return view('login.register');
        }else {
            DB::table('users')->insert(
                [
                    'user_id' => $req->get('user_id'),
                    'name' => $req->get('name'),
                    'email' => $req->get('email'),
                    'password' => $req->get('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );            
                
            // Session::put('user_id', $user_id, 'name', $name, 'email', $email);
            // Session::put('user_id', $user_id);
            // Session::get('user_id', $user_id);
            // return view('welcome');
            return redirect('/');
        }
    }

    public function mypage_index() {
           return view('login.mypage');
    }
    
    public function myinfo(Request $req) {
        $user_id = Session::get('user_id');
        $user_info = DB::select('select * from users where user_id = ?', [$user_id]);
        
        return view('login.mypage')->with('user_id', $user_info);
    }

    // 회원정보 수정
    public function modify(Request $req) {
        $user_id = Session::get('user_id');
        $modify_password = Input::get('password');

        $modify_info = DB::update('update users set password = ? where user_id = ?', [$modify_password, $user_id]);
        // $modify = DB::update('update users set name = ?, password = ?', [$modify_name, $modify_password]);

        return redirect('/mypage');
    }

    public function point_add(Request $req) {
        $user_id = Session::get('user_id');
        $session_point = Session::get('point');

        $point_select = Input::get('selceted'); // 원래 대는 코드

        $point_added = DB::update('update users set point = ? where user_id = ?', [$point_select+$session_point, $user_id]);
        $point = Session::put('point', $point_select+$session_point);
    
        // return redirect('/mypage');
    }

    //로그아웃
    public function logout(Request $req) {
        $req->session()->flush();
        return redirect('/');
    }
}
