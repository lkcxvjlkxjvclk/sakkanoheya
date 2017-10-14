@extends('layouts.master2')

@section('content')

@php
	use App\Http\Controllers\MainController;
@endphp

<div class="default-padding"></div>
{{--BANNER START--}}
	<div id="banner" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="autoplay-top">
					@if (empty($data[0]['title']))
						<div class="col-md-12">
								<a href="#">
									<div class="jumbotron">
										<h3 class="novel">조금만</h3>
										<h2 class="small">기다려보아</h2>
										<br/>
										<p class="big">우하하하하하</p>
										<div class="btn btn-banner">자세히 보기<i class="fa fa-search"></i></div>
									</div>
								</a>
						</div>
					@else
						@for ($i = 0; $i < count($data); $i++)
							<div class="col-md-12">
								<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
									<div class="jumbotron">
										<input type="hidden" name="genre" value="{!! $data[$i]['genre'] !!}"/>
										<h3 class="novel" name="genre"></h3>
										<h2 class="small">{!! $data[$i]['summary_intro'] !!}</h2>
										<br/>
										<p class="big">{!! $data[$i]['title'] !!}</p>
										<div class="btn btn-banner">자세히 보기<i class="fa fa-search"></i></div>
									</div>
								</a>
							</div>
						@endfor

					@endif

				</div>
			</div>
		</div>
	</div>
	{{--BANNER END--}}

	{{--CTA1 START--}}
	{{--<div class="cta-1">
		<div class="container">
			<div class="row text-center white">
				<h1 class="cta-title">Say Hey to Tempo!!</h1>
				<p class="cta-sub-title">Full Responsive HTML5 Bootstrap Template.</p>
			</div>
		</div>
	</div>--}}
	{{--CTA1 END--}}
	<div id="default-padding-mid"></div>

	{{--today & best NOVEL START--}}
	@php
	echo MainController::todayNovelView($data);
	echo MainController::bestNovelView($data);
	@endphp
	{{--today & best NOVEL END--}}

	<div id="default-padding-big"></div>

	{{--EVENT START--}}
	<div id="event" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>2017 공모전</h1>
					<p>누구나 참가 가능한 공모전 개최! <br>작가의 방이 작가님들과 함께합니다. </p>
					<hr class="pg-titl-bdr-btm" />
				</div>
				<div class="autoplay">
					@if (empty($data[0]['title']))
						<h1>곧 소설이 업로드됩니다.</h1>
					@else
						@for ($i = 0; $i < count($data); $i++)
							<div class="col-md-6">
								<div class="team-info">
									<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
										<div class="img-sec">
											<img src="upload/images/{{ $data[$i]['cover_img_src'] }}" class="img-responsive">
										</div>
										<div class="fig-caption">
											<h3>{!! $data[$i]['title'] !!}</h3>
											<p class="marb-20">작가 글반죽</p>
											{{-- <p>Follow me:</p>
											<ul class="team-social">
												<li class="bgblue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li class="bgred"><a href="#"><i class="fa fa-google-plus"></i></a></li>
												<li class="bgblue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li class="bgblue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
											</ul> --}}
										</div>
									</a>
								</div>
							</div>
						@endfor
					@endif


				</div>
			</div>
		</div>
	</div>
	{{--EVENT END--}}

	{{--CTA2 START--}}
	<div class="cta2">
		<div class="container">
			<div class="row white text-center">
				<h3 class="wd75 fnt-24">“당신의 인생 작품을 선택하세요.” - 2017 공모전</h3>
				<p class="cta-sub-title"></p>
				<a href="#" class="btn btn-default">자세히 보기</a>
			</div>
		</div>
	</div>
	{{--CTA2 END--}}

	{{--CONTACT START--}}
	<div id="about" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>作家のヘヤ</h1>
					<p>작가의 안식처, <br>작가의 방 </p>
					<hr class="pg-titl-bdr-btm" />
				</div>
                {{-- <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>

				<div class="form-sec">
                	<form action="" method="post" role="form" class="contactForm">
                    	<div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control text-field-box" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control text-field-box" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control text-field-box" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>

                            <button class="button-medium" id="contact-submit" type="submit" name="contact">Submit Now</button>
                        </div>
                    </form>
                </div> --}}
			</div>
		</div>
	</div>
	<!--CONTACT END-->
	<link rel="stylesheet" href="/css/jhm-style.css">

	<script src="/js/jquery-3.2.0.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jquery.easing.min.js" type="text/javascript"></script>
	<script src="/js/jquery.mixitup.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/slick.js"></script>
	<script type="text/javascript" src="/js/custom.js"></script>
	<script type="text/javascript" src="/js/d3.layout.js"></script>
	<script type="text/javascript" src="/js/JHM-Custom/welcome_genre.js"></script>

@endsection
