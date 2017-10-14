@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CommentController;
@endphp

@include('writer_blog.blogTopMenu')  

@section('content')
    {{-- 현재 가지고 있는 user_id를 가지고 넘어가야하는데...   --}}
    {{-- @param DataType STRING  --}}
    @php
        echo BlogController::showBlogSideMenu($data['blog_owner_id']);     
    @endphp
        
        <div id="default-padding-mid"></div>
                {{-- BLOG MAIN SPACE START --}}
                <div id="blog-main" class="col-md-8">
                    {{-- BLOG MAIN ROW START --}}
                    <div class="row">
                        {{-- BLOG NOTICE START --}}
                        <div class="col-md-12 blog_notice_list text-center autoplay-notice">
                            {{--  {{print_r($data)}}  --}}
                            @php
                                {{-- @param DataType INT   --}}
                                {{--  echo BlogController::mainNoticeList($data['blogOwnerId']);    --}}
                            @endphp
                        </div>
                        {{-- BLOG NOTICE END --}}
                        <div id="default-padding"></div>
                        <div class="col-md-12 blog_notice">
                            <div name="blog_post">
                                {{--    --}}
                            </div>
                        </div>

                        <div class="board_title">
                            <ul class="list-inline">
                                <li>
                                    <h4>
                                        <strong>{!! $data['board_title'] !!}</strong>
                                    </h4>
                                </li>
                                <li>
                                    <small>| 読者コミュニティー</small>
                                </li>
                                <li class="board_timestamp">
                                    <small>{!! $data['created_at'] !!}</small>
                                </li> 
                            </ul>
                            <a name="nav-pref" class="btn btn-default text-right" href="javascript:history.back()">前へ</a>
                        </div>
                        <div name="title_line"></div>
                        <div class="board_content">
                            <div id="default-padding-big"></div>
                            {!! $data['board_content'] !!}
                        </div>



                    </div>
                    {{-- BLOG MAIN ROW END --}}


                @php
                    echo CommentController::commentView();
                @endphp


                </div>
                {{-- BLOG MAIN SPACE END --}}

                

            {{-- BLOG SIDE MENU DIV ROW --}}
            </div>
        {{-- BLOG SIDE MENU DIV CONTAINER --}}
        </div>

        



    <div id="default-padding-big"></div>

    {{-- JHM STYLE --}}
    <link rel="stylesheet" href="/css/jhm-style.css">
	{{-- JHM SCRIPT --}}
    <script type="text/javascript" src="/js/JHM-Custom/blog_click.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="/js/jquery-3.2.0.js"></script>
	<script src="/js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="/js/jquery.mixitup.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/slick.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>
   
@endsection
