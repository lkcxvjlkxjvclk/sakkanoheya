@extends('layouts.master')

@include('partials.mySubNavi')

@section('content')
    <div class="default-padding"></div>
    <h2 class="text-center">ブログ設定</h2>
    <div class="container">
        <div class="row">
            <div id="blog-set">
                <div class="col-md-4 text-center blog_menu_set">
                    <a href="/yerriel/blog/{{$blog_id}}/setMap/createMenu">
                        <i class="material-icons">settings</i>
                        <h4>メニュー管理</h4>
                    </a>
                </div>
                <div class="col-md-4 text-center blog_design_set">
                    <a href="#">
                        <i class="material-icons">format_paint</i>
                        <h4>デザイン設定</h4>
                    </a>
                </div>
                <div class="col-md-4 text-center my_novel_set">
                    <a href="/background">
                        <i class="material-icons">library_books</i>
                        <h4>小説管理</h4>
                    </a>
                </div>
            </div>


        </div>
    </div>


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