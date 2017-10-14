@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
@endphp
@include('writer_blog.blogTopMenu')

@section('content')
    {{-- 해당 블로그의 주인 user_id를 가지고 넘어가야하는데...   --}}
    @php
        {{-- @param DataType STRING   --}}
        echo BlogController::showBlogSideMenu($data['blog_owner_id']);   
    @endphp
    <div id="default-padding-mid"></div>
            {{-- BOARD WRITE FORM SPACE START --}}
            <div id="write-form" class="col-md-8">
            @if (isset($data['community']))
                <form action="{{ route('community.store') }}" method="POST" enctype="multipart/formr-data">
            @else
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/formr-data">
            @endif
                {{ csrf_field() }}
                    <div class="form-group">
                        {{-- DataType STRING? 현재 글쓰고 있는 사람 id --}}
                        <input type="hidden" value="jhm1107" name="writer_name" />
                        {{-- DataType INT   --}}
                        <input type="hidden" value="{{$data['blog_id']}}" name="blog_id" />
                        {{-- DataType STRING --}}
                        <input type="hidden" value="{{$data['blog_owner_id']}}" name="blog_owner_id" />
                        {{-- 현재 접속자 아이디를 따져서 메뉴 선택창 안보이게 하기 : 독자 게시판   --}}
                        <div class="row">
                            {{--  blog_menu_id  --}}
                            <div class="col-md-3">
                                @if (isset($data['community']))
                                    <p>読者コミュニティー</p>
                                @else
                                    <select name="blog_menu_id" id="post-category" class="form-control">
                                        @php
                                            echo BlogController::wirteFormMenuList($data['blog_id']);
                                        @endphp
                                    </select>
                                @endif
                            </div>
                            {{--  board_title  --}}
                            <div class="col-md-9">
                                <input name="board_title" id="post-title" type="text" placeholder="ポストのタイトルを入力して下さい。" />
                            </div> 
                            @if (isset($data['community']))
                                {{-- DataType INT --}}
                                <input type="hidden" value="{{ $data['blogOwnerId'] }}" name="blogOwnerId" />
                            @else
                                {{-- is_notice --}}
                                <div class="col-md-12">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="is_notice" id="notice-check"> ノーティス
                                    </label>
                                </div>
                            @endif
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