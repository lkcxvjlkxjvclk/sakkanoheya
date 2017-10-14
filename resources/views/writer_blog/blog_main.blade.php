@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CommentController;
@endphp
@if ($data[0] === "Please create a blog.")
    @include('partials.mySubNavi')
@else
    @include('writer_blog.blogTopMenu')  
@endif
@section('content')
    @if ($data[0] === "Please create a blog.")
        @php
            echo BlogController::showBlogCreateForm($data);
        @endphp
    @elseif ($data[0] === "error")
        <div id="default-padding-big"></div>
        <h1>小説家になれば、「作家の部屋」を利用できます。</h1>
    @else
        @if ($data[0] == 0)
            {{-- 현재 가지고 있는 user_id를 가지고 넘어가야하는데...   --}}
            @php
                echo BlogController::showBlogSideMenu($data[1]);     
            @endphp
        @else
            {{-- 현재 가지고 있는 user_id를 가지고 넘어가야하는데...   --}}
            @php
                echo BlogController::showBlogSideMenu($data[0]['blog_owner_id']);     
            @endphp
        @endif
        
        
        <div id="default-padding-mid"></div>
                {{-- BLOG MAIN SPACE START --}}
                <div id="blog-main" class="col-md-8">
                    {{-- BLOG MAIN ROW START --}}
                    <div class="row">
                        {{-- BLOG NOTICE START --}}
                        <div class="col-md-12 blog_notice_list text-center autoplay-notice">
                            @if ($data[0] == 0)
                                <h3>何もないんですね。</h3>
                            @else
                                @php
                                     echo BlogController::mainNoticeList($data[0]['blogOwnerId']);  
                                @endphp
                            @endif
                        </div>
                        {{-- BLOG NOTICE END --}}
                        <div id="default-padding-big"></div>
                        <div id="default-padding-mid"></div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

                        <div class="col-md-12">
                            <h4><strong></strong></h4>
                        </div>
                        <canvas id="myChart" class="col-md-12" height="300"></canvas>

                        <script src="/js/JHM-Custom/novel_chart.js"></script>






                        {{-- BLOG BOARD START (NOTICE) --}}
                        <div class="col-md-12 blog_notice">
                            @if ($data[0] == 0)
                                <h3>何もない．．．</h3>
                            {{-- ELSEIF $_SERVER["REQUEST_URI"] in /blog OR /blog?%%% --}}
                            @elseif (($data[0] !== 0) && (strpos($_SERVER["REQUEST_URI"], "/blog")!==false || strpos($_SERVER["REQUEST_URI"], "/blog?")!==false))
                                <div name="blog_post">
                                    @php
                                         echo BlogController::allBoard($data[0]['blog_id']);  
                                    @endphp
                                </div>
                            @endif
                        </div>
                        {{-- BLOG BOARD END (NOTICE) --}}


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

    @endif

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
