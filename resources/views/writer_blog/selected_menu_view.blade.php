@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CommentController;
@endphp
@include('writer_blog.blogTopMenu')

@section('content')
    {{-- 해당 블로그를 보고 있는 사람의 아닌가 주인인가 아닌데 이상한데 user_id를 가지고 넘어가야하는데...   --}}
    @php
          echo BlogController::showBlogSideMenu($data[2]);   
    @endphp

    <div id="default-padding-mid"></div>
            {{-- BLOG MAIN SPACE START --}}
            <div id="blog-main" class="col-md-8">
                {{-- BLOG MAIN ROW START --}}
                <div class="row">
                    {{-- BLOG NOTICE START --}}
                    <div class="col-md-12 blog_notice_list text-center autoplay-notice">
                        @if ($data[0] == "empty")
                            <h3>このメニューに書き込みがありません。</h3>
                        @else
                            @php
                                  echo BlogController::mainNoticeList($data[1]);  
                            @endphp
                        @endif
                    </div>
                    {{-- BLOG NOTICE END --}}
                    <div id="default-padding"></div>
                    {{-- BLOG BOARD START (NOTICE) --}}
                    <div class="col-md-12 blog_notice">
                        @if ($data[0] == "empty")
                            <h3>ポストアイコンを押して、書き込みを作成してください。</h3>
                        {{-- ELSEIF $_SERVER["REQUEST_URI"] in /blog OR /blog?%%% --}}
                        @elseif (($data[0] !== 0) && (strpos($_SERVER["REQUEST_URI"], "/blog/menu")!==false || strpos($_SERVER["REQUEST_URI"], "/blog/menu?")!==false))
                        
                            <div name="blog_post">
                                @php
                                    echo BlogController::selectedMenuAllB($data[0]); 
                                @endphp
                            </div>
                        @endif
                    </div>
                    {{-- BLOG BOARD END (NOTICE) --}}


                </div>
                {{-- BLOG MAIN ROW END --}}


            @if ($data[0] !== "empty")
                @php
                    echo CommentController::commentView();
                @endphp
            @endif

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