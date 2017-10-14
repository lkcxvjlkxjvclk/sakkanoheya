@extends('layouts.master')
@php
	use App\Http\Controllers\BlogController;
    use App\Http\Controllers\CommunicationController;
@endphp
@include('writer_blog.blogTopMenu')  
@section('content')
    {{-- 현재 가지고 있는 user_id를 가지고 넘어가야하는데...   --}}
    @php
        {{-- @param DataType STRING   --}}
         echo BlogController::showBlogSideMenu($data[0]);    
    @endphp

            <div id="default-padding-mid"></div>
            {{-- BLOG MAIN SPACE START --}}
            <div id="blog-main" class="col-md-8">
                {{-- BLOG MAIN ROW START --}}
                <div class="row">
                    {{-- BLOG NOTICE START --}}
                    <div class="col-md-12 blog_notice_list text-center autoplay-notice">
                        @php
                            {{-- @param DataType INT   --}}
                            {{--  echo BlogController::mainNoticeList($data[1]);     --}}
                        @endphp
                    </div>
                    {{-- BLOG NOTICE END --}}
                    <div id="default-padding"></div>
                    <div class="col-md-12 blog_notice">
                        <div name="blog_post">
                            {{--    --}}
                        </div>
                    </div>
                    <div class="col-me-12">
                        @php
                            {{-- @param $blogId DataType INT   --}}
                             echo CommunicationController::allCommunicationB($data[3]) 
                        @endphp
                    </div>


                </div>
                {{-- BLOG MAIN ROW END --}}
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
