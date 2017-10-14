@extends('layouts.master')

@section('content')

	@include('partials.mySubNavi')
	@include('background.tag')
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="/js/custom/history.js"></script>
		<script type="text/javascript" src="/js/custom/chapter_click.js"></script>
		<style>
			.pie { fill : orange; stroke : white; }
			.total { font-size : 9pt; text-anchor : middle; }
			.pieNum { font-size : 10px; text-anchor : middle; }
		</style>

		<div class="col-xs-2 col-sm-2 col-md-2 height-max-set" style= "border-right: 2px solid #efefef ; height: 100vh">
			<div class="novel_id" id="root" value="{{$data['novel']['id']}}">
				<h3 class="text-center">{{$data['novel']['title']}}</h3>
			</div>
			<div class="row chapter_side" id="test">
				<table class="table table-condensed">
					@isset($data['chapter'])
						@for($i = 0; $i < count($data['chapter']) ; $i++)
							<tr>
								<th>제목</th>
								<th>내용</th>
							</tr>
							<tr>
								<td style="width:80px">
								{{--  {{var_dump($data)}}   --}}
									<button type="button" name="chapter_click" class="btn btn-link chapter_click chapter_val" id="chapter_id{{$i}}" value="{{$data['chapter'][$i]['chapter_id']}}">
										{{$data['chapter'][$i]['chapter_name']}} 
										<div id="chapter_name{{$i}}" value="{{$data['chapter'][$i]['chapter_name']}}"></div>
									</button>     
								</td>
								<td>
									{{$data['chapter'][$i]['chapter_content']}}  
								</td>
							</tr>
						@endfor
					@endisset
				</table>
			</div>
			<div>
				{{-- 등록 챕터 목록 --}}
				<div class="inner"></div>
				{{-- 소유 사물 등록 아이콘, 모달 호출 --}}
				@php 
					use App\Http\Controllers\ChaptersController;
					echo ChaptersController::chapter_modal(); 
				@endphp
				<br>
				<div class="text-center" data-toggle="modal" data-target="#abc">
					<p class="remote">
						<a class="setView" href="#">
							<i class="fa fa-plus-square-o fa-3x "></i>
						</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 height-max-set" style= "border-right: 2px solid #efefef ; height: 100vh" >
			<div class="chapter_data">

			</div>
		</div>
		<div class="col-xs-9 col-sm-6 col-md-6 height-max-set">
			<div>
				<div class="row" style="border-bottom : 2px solid #efefef">
					<div class="col-md-6" style="">
						<div id="timeline" style="height:40vh"></div>
						<div id="timeline_button"></div>
						<div id="timeline_name" style=""></div>
					</div>
					<div class="col-md-6">회차 글자수
						<svg id="myGraph" style="width : 320px; height : 240px; border : 1px solid black;"></svg>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">추천수0</div>
					<div class="col-md-6">회차 조회수</div>
				</div>
			</div>
		</div>
	</div>
@endsection
