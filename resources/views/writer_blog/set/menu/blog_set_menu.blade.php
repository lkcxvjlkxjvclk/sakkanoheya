@extends('layouts.master')

@section('content')
    <div class="default-padding"></div>
    {{-- MENU SET FORM SPACE START --}}
    <div id="menu-set-form" class="container">
        <h4>メニュー管理</h4>
        <div class="row">
            <div class="col-md-6">
                {{-- menu_title_list   --}}
                {{-- 현재 존재하는 메뉴 리스트 보여주기   --}}
                <form action="/yerriel/blog/{{$data[0]['blog_id']}}/setMap/destroyMenu" method="POST" enctype="multipart/formr-data">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        {{-- 나중에 수정하기! 해당 블로그 자동 증가 아이디로 --}}
                        <input type="hidden" value="{{$data[0]['blog_id']}}" name="blog_id" />
                        <div class="row">
                            {{-- menu_title_list --}}
                            <div class="col-md-12">
                                <h4>
                                    <strong>作家の部屋</strong>
                                </h4>

                                {{-- 존재하는 메뉴 개수 만큼 반복   --}}
                                
                                    @if ($data[0]['id'] == 0)
                                        メニューを作って下さい。
                                    @else
                                        @foreach ($data as $list)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    {!! $list['menu_title'] !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                


                            </div>
                        </div>
                                
                    </div>
                    <button type="submit" class="btn btn-default">Delete</button>
                    
                </form>
            </div>
            <div class="col-md-6">
                <form action="/yerriel/blog/{{$data[0]['blog_id']}}/setMap/storeMenu" method="GET" enctype="multipart/formr-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{-- 나중에 수정하기! 해당 블로그 자동 증가 아이디로 --}}
                        <input type="hidden" value="{{$data[0]['blog_id']}}" name="blog_id" />
                        <input type="hidden" value="yerriel" name="owner_id" />
                        <div class="row">
                            {{-- menu_title   --}}
                            <div class="col-md-12">
                                {{-- 메뉴 관리 창   --}}
                                {{-- 메뉴 제목 input type text   --}}
                                <strong>カテゴリー名</strong>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" name="menu_title" id="menu-title" />
                            </div>
                        </div>
                                
                    </div>
                    <button type="submit" class="btn btn-default">登録</button>
                </form>
            </div>
        </div>
        
    </div>
    {{-- MENU SET FORM SPACE END --}}



    <div id="default-padding-big"></div>

    {{-- JHM STYLE --}}
    <link rel="stylesheet" href="/css/jhm-style.css">
	{{-- JHM SCRIPT --}}
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/js/jquery-3.2.0.js"></script>
	<script src="/js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="/js/jquery.mixitup.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/slick.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>
@endsection