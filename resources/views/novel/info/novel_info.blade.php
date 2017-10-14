@extends('layouts.master')

@section('content')
@php
    use App\Http\Controllers\NovelController;
@endphp
<script type="text/javascript" src="/js/JHM-Custom/info_genre.js"></script>
<script type="text/javascript" src="/js/JHM-Custom/day_info.js"></script>
<script>info_genre( <?=json_encode($data)?> )</script>
<script>day_info( <?=json_encode($data)?> )</script>
<div class="default-padding"></div>
        {{-- novel-info-1 START --}}
        <div id="novel-info-1" class="section-padding">
            {{-- container class START --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-left novel-info-upper-text">
                        <h3><strong>
                            {!! $data[0]['title'] !!}
                        </strong></h3>
                        <h5><small>作者</small>&nbsp;小説家さん</h5>
                    </div>
                    <div class="col-md-1 text-center novel-info-upper-icon">
                        <i class="material-icons" name="favorite">favorite_border</i>
                        <h4>1</h4>
                    </div>
                    <div class="col-md-1 text-center novel-info-upper-icon">
                        <i class="material-icons">chat</i>
                        <h4>レビュー</h4>
                    </div>
                    <div class="col-md-1 text-center novel-info-upper-icon">
                        <i class="material-icons" name="star">star_border</i>
                        <h4>関心数</h4>
                    </div>
                    <div class="col-md-1 text-center novel-info-upper-icon">
                        <i class="material-icons">share</i>
                        <h4>共有回数</h4>
                    </div>
                </div>
                <hr />
            </div>
            {{-- container class END --}}
        </div>
        {{-- novel-info-1 END --}}
        <div id="default-padding-small"></div>
        {{-- novel-info-2 START --}}
        <div id="novel-info-2">
            {{-- container class START --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="/upload/images/{{ $data[0]['cover_img_src'] }}" width="225" />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-2">
                                <i class="fa fa-user-o hit-icon" aria-hidden="true"></i>
                                &nbsp;
                                1
                            </div>
                            <div class="col-md-2 upload-day">
                                <b name="upload_day"></b> 連載
                            </div>
                            <div class="col-md-2">
                                <b name="genre">
                                </b>
                            </div>
                        </div>
                    </div>
                    <div id="default-padding-mid" class="col-md-9"></div>
                    <div class="col-md-9">
                        <p class="lead">
                            <strong>
                                {!! $data[0]['summary_intro'] !!}
                            </strong>
                        </p>
                        <p>{!! $data[0]['intro'] !!}</p>
                    </div>
                    <div id="default-padding-mid-1" class="col-md-9"></div>
                    @if (isset($data[0]['noEpi']))
                        <h1>今、準備しています。</h1>
                    @else
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control input-lg" onchange="location = this.value;">
                                        @for ($i = count($data); $i > 0; $i--)
                                        <option value="/novel/read/novel_read_view/{{$data[0]['novelId']}}&{{$i}}">
                                            {{$i}}
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <a href="/novel/read/novel_read_view/{{$data[0]['novelId']}}&1">
                                        <button class="btn btn-default btn-block novel-1st-read-Btn">第一話から</button>
                                    </a>
                                </div>
                                @if (!isset($data[0]['noBack']))
                                    <div class="col-md-4">
                                        <button class="btn btn-default btn-block novel-background-read-Btn" data-toggle="modal" data-target="#backgroundModal">
                                            小説設定
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- container class END --}}
        </div>
        {{--quickMenu & viewer & background MODAL START--}}
        @if (!isset($data[0]['noEpi']) && !isset($data[0]['noBack']))  
            @php
                echo NovelController::backgroundModal($data[0]['novelId']);
            @endphp
        @endif
        {{--quickMenu & viewer & background MODAL END--}}
        {{-- novel-info-2 END --}}
        <div id="default-padding-big" class="col-md-12"></div>
        @if (!isset($data[0]['noEpi']))
            {{-- novel-info-3 START --}}
            <div id="novel-info-3" class="section-padding">
                {{-- container class START --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h3>
                                話数 <small>({{count($data)}})</small>
                            </h3>
                        </div>
                        <div class="col-md-6 text-right sort">
                            <h5>
                                <span class="sort-text">最近話から</span> <span><i class="material-icons selectedIcon" name="check">check</i></span>
                                &nbsp;&nbsp;&nbsp;
                                <span class="sort-text">第一話から</span> <span><i class="material-icons"  name="check">check</i></span>
                            </h5>
                        </div>
                        
                        <div id="default-padding-small" class="col-md-12"></div>
                            @php 
                                $i = count($data);
                            @endphp
                            @foreach ($data as $d)
                                <div class="col-md-12">
                                    <div class="episode">
                                        <div class="row">
                                            <a href="/novel/read/novel_read_view/{{$d['belong_to_novel']}}&{{ $i }}">
                                                <div class="col-md-3">
                                                    <div>
                                                        <img src="/upload/images/{{ $d['episode_cover_src'] }}" width="261" height="160" />
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="episode-list">
                                                        <div class="col-md-12">
                                                            <h4 name="episode-table">{{ $i }}. {!! $d['episode_title'] !!}</h4>
                                                        </div>
                                                        <div id="default-padding-small-0" class="col-md-12"></div>
                                                        <div class="col-md-2">
                                                            <i class="fa fa-star" aria-hidden="true"></i>&nbsp;1
                                                        </div>
                                                        <div class="col-md-2">
                                                            <small>レビュー</small>&nbsp;<strong>1</strong>
                                                        </div>
                                                        <div class="col-md-8">
                                                            {!! $d['created_at'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="default-padding-small" class="col-md-12"></div>
                                @php 
                                    $i--;
                                @endphp
                            @endforeach
                        
                        {{--PAGE--}}
                        <div id="default-padding-small-1" class="col-md-12"></div>
                    </div>
                    {{-- row class END --}}
                </div>
                {{-- container class END --}}
            </div>
            {{-- novel-info-3 END --}}
            <div id="default-padding-mid-1" class="col-md-12"></div>
            
        @endif

    

        {{-- JHM STYLE --}}
        <link rel="stylesheet" href="/css/jhm-style.css">
        {{-- JHM SCRIPT --}}
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="/js/JHM-Custom/jhm-selectIcon-custom.js"></script>
        <script src="/js/JHM-Custom/jhm-comment.js"></script>
        <script src="/js/JHM-Custom/jhm-arrow.js"></script>
@endsection