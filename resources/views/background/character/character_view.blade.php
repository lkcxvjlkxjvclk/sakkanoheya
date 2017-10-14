@extends('layouts.master')

@section('content')

	@include('partials.mySubNavi')
	@include('background.tag')
		<script type="text/javascript" src="/js/custom/character_event.js"></script>
		<script type="text/javascript" src="/js/custom/additional_items.js"></script>
		<script>character_event( <?=json_encode($data)?> )</script>
		<div class="col-xs-6 col-sm-4 col-md-4 height-max-set" style= "background-color : #e8d6b3; height: 100vh" >
			<div class="row">
				@if($data[0])
					@foreach ($data as $character)
					<?php $img_src = "/img/background/characterImg/".$character['img_src']; ?>
					<img src="{{$img_src}}" alt="character image" class="img-circle img-things-size character_list event_list" id="{{$character['id']}}" name="character_icon" style="margin : 17px">
					@endforeach
				@endif
			</div>
		</div>
		<div class="col-xs-5 col-sm-5 col-md-5 height-max-set" >
			<form class="form-horizontal" id="character" name="character" action="{{ route('character.store') }}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			{{-- <input type="hidden" name="page" value="{{$datas['page']}}"> --}}
			<input type="hidden" name="page" id="" value="character">
				{{-- 캐릭터 id를 저장하기 위한 공간 --}}
				<div id="character_id" value="charcter_value"></div>
				<h3 id="name">人物登録</h3>
				{{-- 캐릭터 이름 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">名前</label>
					<div class="col-sm-10">
					<input class="form-control" type="text" id="character_name" name="character_name" placeholder="名前" value="">
					</div>
				</div>
				{{-- 캐릭터 내용 등록 --}}

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">内容</label>
					<div class="col-sm-10">
					<textarea class="form-control" rows="3" id="character_content" name="character_content"></textarea>
					</div>
				</div>
				{{-- 캐릭터 추가사항 --}}
				<div class="form-group form-group-lg" scroll="auto" style="overflow-x:hidden; height:100px">
					<label class="col-sm-3 control-label" for="formGroupInputLarge">追加事項</label>
					<div class="col-sm-5 refer_info_div">
						<input type="text" class="form-control refer_info" name="refer_info[]" placeholder="追加事項">
					</div>
					<div class="col-sm-2">
						<i class="fa fa-plus-circle" aria-hidden="true" id="additional_items" style="font-size:200%"></i>
					</div>
				</div>
				{{-- 이미지 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-3 control-label" for="formGroupInputLarge">イメージ登録</label>
					<div class="col-sm-10">
						
						<input type="file" name="character_img_upload" id="character_img_upload">
					</div>
				</div>
				{{-- 캐릭터 나이, 성별 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">年齢</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="age" name="age" placeholder="年齢">
					</div>
					<label class="col-sm-2 control-label" for="formGroupInputLarge">性別</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="gender" name="gender" placeholder="性別">
					</div>
				</div>
				{{-- 캐릭터 소유 사물 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-4 control-label" for="formGroupInputLarge">所有事物</label>
				</div>
				<div>
					{{-- 소유 사물 아이콘 목록 --}}
					<div class="inner"></div>
					{{-- 소유 사물 등록 아이콘, 모달 호출 --}}
					@php 
						use App\Http\Controllers\BackgroundCharactersController;
						echo BackgroundCharactersController::ownership_modal();
					@endphp
					<div data-toggle="modal" data-target="#abc">
						<p class="remote">
							<a class="setView" href="#">
								<i class="fa fa-plus-square-o fa-3x"></i>
							</a>
						</p>
					</div>
				</div>
				
				
				<button type="submit" class="btn btn-default">Submit</button>
			</form >
		</div>



		<div class="col-xs-3 col-sm-2 col-md-2 height-max-set background_tag" style="height: 100vh">
			{{-- add_tag.blade.php 구현하고, 컨트롤러로 div안에 불러오는 형식으로 변경 할 것. --}}
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
					@php 
						$page = "characters";
						use App\Http\Controllers\TagsAddController;
						echo TagsAddController::view_return($page,$data);
					@endphp
			</div>
		</div>
	</div>
@endsection
