@extends('layouts.master')




@section('content')
	@include('partials.mySubNavi')

	@include('background.tag')
		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		 <script type="text/javascript" src="/js/custom/history.js"></script>
		 <script type="text/javascript" src="/js/custom/additional_items.js"></script>
		 <script type="text/javascript" src="/js/custom/timetable_event.js"></script>
		 <script type="text/javascript" src="/js/custom/effect_get_click.js"></script>
		 <script> ready(  <?=json_encode($data)?>  ) </script>
		 <script> timetableEvent( <?=json_encode($data)?> );</script>

		 <div class="col-xs-16 col-sm-11 col-md-11" style= "background-color : #e8d6b3" >
			<br>
			<div class="row" id="timeline" >
			</div>
			<nav aria-label="...">
				<ul class="pager" id="timetableList">
					<?php
						if($data[0]){
							 
							for($i = 0 ; $i < count($data) ; $i++){
							?>
								<li class="event_list" id="{{$i}}" style="font-size:16px; font-weight:bold"><a href="#">{{$data[$i]['event_name']}}</a></li>
							<?php
							}
						}
					?>
				</ul>
			</nav>
		</div>

		<div class="col-xs-16 col-sm-11 col-md-11 height-max-set" style="height: 50vh; overflow:auto">
			<div class="row" id="list">
			{{-- {{ var_dump($data) }} --}}
				<form class="form-horizontal" id="time_table" name="time_table" action="{{ route('historyTable.store') }}" method="POST">
					{!! csrf_field() !!}
					<div class="col-xs-8 col-sm-5 col-md-5">
						<h3 id="name">事件追加</h3>
						{{-- 사건 제목 등록 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">題目</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="event_name" id="event_name" placeholder="事件の名">
							</div>
						</div>
						{{-- 사건 내용 등록 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">内容</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="3" name="event_content" id="event_content"></textarea>
							</div>
						</div>
						{{-- 사건 추가사항 추가 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-3 control-label" for="formGroupInputLarge">追加事項</label>
							<div class="col-sm-5 refer_info_div">
								<input type="text" class="form-control refer_info" name="refer_info[]" placeholder="追加事項">
							</div>
							<div class="col-sm-2">
								<i class="fa fa-plus-circle" aria-hidden="true" id="additional_items" style="font-size:200%"></i>
							</div>
						</div>
						{{-- 사건 기간 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">期間</label>
							<div class="col-xs-4">
								<input type="text" name="start_day" id="start_day" class="form-control" placeholder="2017.01.01">
							</div>
							<label class="col-sm-2 control-label" for="formGroupInputLarge">~</label>
							<div class="col-xs-4">
								<input type="text" name="end_day" id="end_day" class="form-control" placeholder="2017.12.31">
							</div>
						</div>
					</div>

					{{-- 추가사항 등록 스크립트 --}}

					{{-- 화면 분할 오른쪽 --}}
					<div class="col-xs-7 col-sm-5 col-md-5 height-max-set background_tag">
						{{-- timetable Id 를 저장하기 위한 공간 --}}
						<div id="timetable_id" value="timetable_value"></div>
						<br><br><br>
						{{-- 등장인물 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">登場人物</label>
							<div class="col-sm-10">
								{{-- 인물 아이콘 목록 --}}
								<div class="inner_character">

								</div>
								{{-- 인물 등록 아이콘, 모달 호출 --}}
								@php
									use App\Http\Controllers\BackgroundHistoryTablesController;
									echo BackgroundHistoryTablesController::characters_effect_modal();
								@endphp
								<div data-toggle="modal" data-target="#character">
									<p class="remote">
										<a class="setView" href="#">
											<i class="fa fa-plus-square-o fa-3x" id="characters" value="0"></i>
										</a>
									</p>
								</div>
							</div>
						</div>
						{{-- 등장사물 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">登場事物</label>
							<div class="col-sm-10">
							{{-- 사물 아이콘 목록 --}}
								<div class="inner_items"></div>
								{{-- 사물 등록 아이콘, 모달 호출 --}}
								@php
									echo BackgroundHistoryTablesController::items_effect_modal();
								@endphp
								<div data-toggle="modal" data-target="#items">
									<p class="remote">
										<a class="setView" href="#">
											<i class="fa fa-plus-square-o fa-3x effect" id="items"></i>
										</a>
									</p>
								</div>
							</div>
						</div>
						{{-- 배경장소 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">背景場所</label>
							<div class="col-sm-10">
							{{-- 장소 아이콘 목록 --}}
								<div class="inner_maps"></div>
								@php
									echo BackgroundHistoryTablesController::maps_effect_modal();
								@endphp
								{{-- 장소 등록 아이콘, 모달 호출 --}}
								<div data-toggle="modal" data-target="#maps">
									<p class="remote">
										<a class="setView" href="#">
											<i class="fa fa-plus-square-o fa-3x effect" id="maps"></i>
										</a>
									</p>
								</div>
							</div>
						</div>
						{{-- 관계 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">連関関係</label>
							<div class="col-sm-10">
							{{-- 관계 아이콘 목록 --}}
								<div class="inner_relations"></div>
								@php
									echo BackgroundHistoryTablesController::relations_effect_modal();
								@endphp
								{{-- 관계 등록 아이콘, 모달 호출 --}}
								<div data-toggle="modal" data-target="#relations">
									<p class="remote">
										<a class="setView" href="#">
											<i class="fa fa-plus-square-o fa-3x effect" id="relations"></i>
										</a>
									</p>
								</div>
							</div>
						</div>
						{{-- 기타 --}}
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label" for="formGroupInputLarge">その他</label>
							<div class="col-sm-10">
							<textarea class="form-control" id = "other" name="other" rows="3"></textarea>
							</div>
						</div>
						{{-- 등록,삭제,수정 버튼 --}}
						<button type="submit" id="submit_delete" class="btn btn-default">Delete</button>
						<button type="submit" id="submit_history" class="btn btn-default">Submit</button></button>
					</div>
				</form>

				<div class="col-xs-3 col-sm-2 col-md-2 height-max-set background_tag">
					<form class="form-horizontal main-navigation">
						<div class="form-group form-group-sm">
							<br>
							<label class="col-sm-2 control-label" for="formGroupInputSmall">検索</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="formGroupInputSmall" placeholder="Small input">
							</div>
							<br>
							<br>
							<button type="submit" class="btn btn-default">検索</button>
						</div>
					</form>
					 <div class="row">
					 {{-- $page에 태그 값이 참조할 테이블의 이름을 넣어준다. --}}
					 	 <?php
						  	$page = "timetables";
						  	use App\Http\Controllers\TagsAddController;
							echo TagsAddController::view_return($page,$data);
						  ?>
					 </div>
				</div>
			</div>
		</div>
	{{-- 태그 div.row 닫는 태그 --}}
	</div>
@endsection
