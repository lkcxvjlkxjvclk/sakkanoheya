@extends('layouts.master')

@section('content')

@php
	use App\Http\Controllers\NovelController;
@endphp
    <div class="default-padding"></div>
    {{-- read-novel-info START --}}
    <div id="read-novel-info" class="section-padding">
        <div id="default-padding-small"></div>
        <div class="row">
            <div class="col-md-9 text-left info-text">
                <h4>
                    <span class="novel-info-text"><a href="/novel/info/novel_info/{{$data['belong_to_novel']}}"><strong>{!! $data['novel_title'] !!}</strong></a></span>
                    <span><i class="material-icons">keyboard_arrow_right</i></span>
                    <span class="novel-info-text">{!! $data['episode_count'] !!}話 {!! $data['episode_title'] !!}</span>
                </h4>
            </div>
            {{-- <div class="col-md-4 text-right">
                <ul class="list-inline" name="bookMode">
                    <li class="setView" data-toggle="modal" data-target="#viewerModal">
                        <i class="material-icons">settings</i>&nbsp;<span>ビューアー設定</span>
                    </li>
                    <li class="novelBackground">
                        <i class="material-icons">remove_red_eye</i>&nbsp;<span>小説設定</span>
                    </li>
                </ul>
            </div> --}}
            <div class="col-md-3 text-right info-icon">
                <ul class="list-inline">
                    <li><i class="material-icons" name="bookmark">bookmark_border</i></li>
                    <li><i class="material-icons" name="star">star_border</i></li>
                    <li><i class="material-icons"><a href="/novel/info/novel_info/{{$data['belong_to_novel']}}">menu</a></i></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- read-novel-info END --}}
    {{-- read-novel-view START --}}
    <div id="read-novel-view">
        {{-- container class START --}}
        {{-- <div class="container bookContainer" name="bookMode">
            <div class="row novel-viewer novel-viewer-book">
                <div class="col-md-6 leftPage" name="bookPage">
                    <i class="material-icons arrowLeft" name="pageArrow">keyboard_arrow_left</i>
                    {!! $data['episode'] !!}
                </div>
                <div class="col-md-6 rightPage" name="bookPage">
                    <i class="material-icons arrowRight" name="pageArrow">keyboard_arrow_right</i>
                    {!! $data['episode'] !!}
                </div>
            </div>
        </div> --}}
        <div class="container webContainer">
            <div class="row">
                {{--<div id="default-padding-mid" class="col-md-12"></div>--}}
                <div class="col-md-12 novel-viewer novel-viewer-web" name="webMode">
                    {!! $data['episode'] !!}
                </div>
            </div>
        </div>
        <div id="default-padding-big" class="col-md-12"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mark-icon">
                    <ul class="list-inline">
                        <li>
                            <span><i class="material-icons" name="favorite">favorite_border</i></span> 
                            <span class="mark-text"> 11,896</span>
                        </li>
                        <li>&nbsp;</li>
                        <li>
                            <span><i class="material-icons" name="star">star_border</i></span>
                            <span class="mark-text"> 関心数</span>
                        </li>
                        <li>&nbsp;</li>
                        <li>
                            <span><i class="material-icons">share</i></span>
                            <span class="mark-text"> 共有回数</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
                
        <div id="default-padding-mid" class="col-md-12"></div>
        {{-- container class END --}}
    </div>
    {{-- read-novel-view END --}}
    
    {{--quickMenu & viewer & background MODAL START--}}
        @if (isset($data['noBack']))
            @php	
                echo NovelController::quickMenu($data);
                echo NovelController::viewerModal();
            @endphp
        @else
            @php	
                echo NovelController::quickMenu($data);
                echo NovelController::viewerModal();
                echo NovelController::backgroundModal($data['belong_to_novel']);
            @endphp
        @endif
    {{--quickMenu & viewer & background MODAL END--}}
    
    {{-- writer-word START --}}
    <div id="writer-word">
        {{-- container class START --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li><h5><strong>「作家ンさん」の一言</strong></h5></li>
                        <li><small>{!! $data['created_at'] !!}</small></li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h5>{!! $data['writers_postscript'] !!}</h5>
                </div>
                <div id="default-padding-small" class="col-md-12"></div>
                <div class="col-md-12 text-right">
                    <ul class="list-inline">
                        <li><button class="btn btn-default btn-block"><strong>その他の小説</strong></button></li>
                        <li><button class="btn btn-default btn-block"><strong>作家の部屋</strong></button></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- container class END --}}
    </div>
    {{-- writer-word END --}}
    <div id="default-padding-mid-1"></div>
    {{-- episode-icon START --}}
    <div id="episode-icon" class="section-padding">
        {{-- container class START --}}
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-left">
                    <a name="arrow-back" data-id="{{ $data['episode_count']-1 }}" href="/novel/read/novel_read_view/{{$data['belong_to_novel']}}&{{ $data['episode_count']-1 }}">
                        <p><i class="material-icons move-icon">arrow_back</i></p>
                        <h4 class="move-text">前へ</h4>
                    </a>
                </div>
                <div class="col-md-4 text-center">
                    <a href="/novel/info/novel_info/{{$data['belong_to_novel']}}">
                        <p><i class="material-icons move-icon">menu</i></p>
                        <h4>目次</h4>
                    </a>
                </div>
                <div class="col-md-4 text-right">
                    <a name="arrow-forward" data-id="{{ $data['episode_count']+1 }}" href="/novel/read/novel_read_view/{{$data['belong_to_novel']}}&{{ $data['episode_count']+1 }}">
                        <p><i class="material-icons move-icon">arrow_forward</i></p>
                        <h4 class="move-text">次へ</h4>
                    </a>
                </div>
            </div>
        </div>
        {{-- container class END --}}
    </div>
    {{-- episode-icon END --}}
    <div id="default-padding-big"></div>
    {{-- novel-review START --}}
        <div id="novel-review">
            {{-- container class START --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h3>レビュー <small>(1)</small></h3>
                    </div>
                    <div class="col-md-6 text-right sort">
                        <h5>
                            <span class="sort-text">最新から</span> <span><i class="material-icons selectedIcon" name="check">check</i></span>
                            &nbsp;&nbsp;&nbsp;
                            <span class="sort-text">推薦から</span> <span><i class="material-icons" name="check">check</i></span>
                        </h5>
                    </div>
                    <div id="default-padding-mid" class="col-md-12"></div>
                    {{--소설 리뷰 작성 부분 View 만들기--}}

                    
                    <div class="col-md-12 review-list">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- USER COMMENT --}}
                                <div class="input-group input-group-lg userComment">
                                    <input type="text" class="form-control" placeholder="ログイン後、利用して下さい。">
                                    <span class="input-group-addon">登録</span>
                                </div>
                            </div>
                            <div id="default-padding-big" class="col-md-12"></div>
                            <div class="col-md-9 text-left">
                                <span><strong>yeye17</strong></span>
                                &nbsp;
                                <span><small>2017-05-01 00:29:24</small></span>
                            </div>
                            <div class="col-md-3 text-right thumb-up">
                                <span><i class="material-icons" name="thumb">thumb_up</i></span>
                                <span class="thumb-text">12</span>
                            </div>
                            <div id="default-padding-small" class="col-md-12"></div>
                            <div class="col-md-12">
                                <span><small>{!! $data['episode_count'] !!}話</small></span>
                                &nbsp;
                                <span>まず、ストーリー、話の中にどんどん引き込まれて、続きが凄く気になる。</span>
                            </div>
                            <div id="default-padding-small-1" class="col-md-12"></div>
                            <div class="col-md-12 review" data-toggle="collapse" href="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
                                <span class="re-review-text"><small>コメント</small></span>
                                <span><i class="material-icons" name="arrow">keyboard_arrow_down</i></span>
                            </div>
                            <div class="col-md-12 collapse" id="collapseComment">
                                <div class="input-group input-group-mg commentReply">
                                    <input type="text" class="form-control" placeholder="ログイン後、利用して下さい。">
                                    <span class="input-group-addon">登録</span>
                                </div>
                            </div>
                            <div id="default-padding-small-1" class="col-md-12"></div>
                        </div>
                    </div>
                    <div id="default-padding-mid" class="col-md-12"></div>
                </div>
                {{-- row class END --}}
            </div>
            {{-- container class END --}}
            
        </div>
        {{-- novel-review END --}}

        {{-- JHM STYLE --}}
        <link rel="stylesheet" href="/css/jhm-style.css">
        {{-- BOOK STYLE --}}
        {{-- <link rel="icon" type="image/png" href="/pics/favicon.png" /> --}}
        {{-- JHM SCRIPT --}}
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="/js/JHM-Custom/jhm-selectIcon-custom.js"></script>
        <script src="/js/JHM-Custom/jhm-readNovel-custom.js"></script>
        <script src="/js/JHM-Custom/jhm-quick.js"></script>
        <script src="/js/JHM-Custom/jhm-comment.js"></script>
        <script src="/js/JHM-Custom/jhm-arrow.js"></script>
@endsection