@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CommunicationController;
@endphp
@include('writer_blog.blogTopMenu')

@section('content')
    {{-- 해당 블로그의 주인 user_id를 가지고 넘어가야하는데...   --}}
    @php
          echo BlogController::showBlogSideMenu($data['blog_owner_id']);   
    @endphp
    <div id="default-padding-mid"></div>
            {{-- BOARD WRITE FORM SPACE START --}}
            <div id="write-form" class="col-md-8">
                <form action="{{ route('communication.store') }}" method="POST" enctype="multipart/formr-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <input type="hidden" value="{{$data['blog_id']}}" name="blog_id" />
                        <input type="hidden" value="{{$data['blog_owner_id']}}" name="blog_owner_id" />
                        {{-- 현재 접속자 아이디를 따져서 메뉴 선택창 안보이게 하기 : 독자 게시판   --}}
                        <div class="row">
                            {{--  blog_menu_id  --}}
                            <div class="col-md-3">
                                <select name="blog_menu_id" id="post-category" class="form-control">
                                    @php
                                        echo BlogController::wirteFormMenuList($data['blog_id']);
                                    @endphp
                                </select>
                            </div>
                            {{--  board_title  --}}
                            <div class="col-md-9">
                                <input name="board_title" id="post-title" type="text" placeholder="ポストのタイトルを入力して下さい。" />
                            </div> 
                            {{-- is_notice --}}
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_notice" id="notice-check"> ノーティス
                                </label>
                            </div>
                            {{--  board_content  --}}
                            <div class="col-md-12">
                                <textarea name="board_content" id="post-content" cols="101" rows="5" autofocus>
                                
                                </textarea>
                            </div>
                        </div>
                    </div>
                    {{--  &nbsp; &nbsp;  --}}
                    <button type="submit" class="btn btn-default">登録</button>
                </form>
            </div>
            {{-- BOARD WRITE FORM SPACE END --}}


        {{-- BLOG SIDE MENU DIV ROW --}}
        </div>
    {{-- BLOG SIDE MENU DIV CONTAINER --}}
    </div>



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