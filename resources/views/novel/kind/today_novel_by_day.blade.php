@extends('layouts.master')

@section('content')
	<script src="/js/JHM-Custom/today_novel_date.js"></script>
	<script>today_novel_date( <?=json_encode($data)?> )</script>

	<div class="default-padding"></div>
	<a class="btn btn-primary" data-toggle="collapse" href="#collapseBanner" aria-expanded="true" aria-controls="collapseBanner">
		X
	</a>
	
	<div class="collapse in" id="collapseBanner">

			{{--BANNER START--}}
			<div name="banner" class="section-padding">
				<div class="container">
					<div class="row">
						<div class="autoplay-top">
							@for ($i = 0; $i < count($data); $i++)
								<div class="col-md-12">
									<div class="row">
										<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
											<div class="col-md-7" name="banner-info">
												<div class="jumbotron">
													<input type="hidden" name="genre" value="{!! $data[$i]['genre'] !!}"/>
													<h3 class="novel" name="genre"></h3>
													<h2 class="small">{!! $data[$i]['summary_intro'] !!}</h2>
													<br/>
													<p class="big">{!! $data[$i]['title'] !!}</p>
													<div class="btn btn-banner">자세히 보기<i class="fa fa-search"></i></div>
												</div>
											</div>
											{{--  <div class="col-md-5" name="banner-img">
												<img src="upload/images/{{ $data[$i]['cover_img_src'] }}" alt="" data-adaptive-background="1"/>
											</div>  --}}
										</a>
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
			{{--BANNER END--}}
			
	</div>
	<div id="default-padding-mid"></div>
    {{--SELECT-SPACE START--}}
    <div id="select-space" class="section-padding">
        <div class="container">
            <div class="row">

				
				<div class="col-md-12 text-center">
					<ul class="list-inline">
						<span class="text-left">ALL &nbsp;&nbsp;&nbsp;</span>
						<span class="text-left">완결 &nbsp;</span>
						<li class="fake-circle"></li>
						<li name="dayCircle">
							<strong class="circle-icon">
								月
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
                            	火
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
								{{-- <a href="#wed" class="btn-link-tab" data-day="wed">수</a> --}}
                            	水
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
                            	木
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
                            	金
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
                            	土
							</strong>
                        </li>
						<span class="fake-circle"></span>
                        <li name="dayCircle">
							<strong class="circle-icon">
                            	日
							</strong>
                        </li>
						<span class="fake-circle"></span>

						<span class="text-right">
							<a data-toggle="collapse" href="#collapseGenreMenu" aria-expanded="false" aria-controls="collapseGenreMenu">
								&nbsp; ジャンル &nbsp;&nbsp;&nbsp;
							</a>
						</span>
						{{-- <span class="text-right"> 정렬</span> --}}
						<span class="dropdown">
							<a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								 정렬
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li>인기순</li>
								<li>조회순</li>
								<li>추천순</li>
							</ul>
						</span>

					</ul>

				</div>

				<div id="default-padding-small"></div>

				<div class="collapse" id="collapseGenreMenu">
					<div class="port-sec">
						<div class="col-md-12 fil-btn text-center">
							<div class="filter wrk-title" data-filter="all">전체</div>
							<div class="filter wrk-title" data-filter=".romance">로맨스</div>
							<div class="filter wrk-title" data-filter=".fantasy">판타지</div>
							<div class="filter wrk-title" data-filter=".horror">호러</div>
						</div>
					</div>
				</div>

				


				<div id="Container">
					@if (empty($data[0]['title']))
						<h1>기다려보아</h1>
					@else
						@for ($i = 0; $i < count($data); $i++)
							<div class="filimg mix {{ $data[$i]['genre'] }} col-md-4 col-sm-4 col-xs-12" data-myorder="2">
								
								{{-- NOVEL'S PERIOD INPUT HIDDEN   --}}
								<input type="hidden" name="novel_period" value="{!! $data[$i]['period'] !!}"/>

								<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
									<img src="/upload/images/{{ $data[$i]['cover_img_src'] }}" class="img-responsive">
								</a>
							</div>
						@endfor
					@endif
				</div>




















            </div>
			{{--row END--}}
        </div>
		{{--container END--}}
    </div>
    {{--SELECT-SPACE END--}}
	
	<div id="default-padding-mid"></div>

    {{-- JHM STYLE --}}
    <link rel="stylesheet" href="/css/jhm-style.css">
	{{-- JHM SCRIPT --}}
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/js/JHM-Custom/jhm-todayNovel-custom.js"></script>
	<script type="text/javascript" src="/js/JHM-Custom/welcome_genre.js"></script>
	<script src="/js/jquery-3.2.0.js"></script>
	<script src="/js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="/js/jquery.mixitup.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/slick.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>
@endsection