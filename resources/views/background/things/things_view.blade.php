@extends('layouts.master')

@section('content') 
	@include('partials.mySubNavi')

	@include('background.tag')
		<script type="text/javascript" src="/js/custom/item_event.js"></script>
		<script type="text/javascript" src="/js/custom/additional_items.js"></script>
		<script>item_event( <?=json_encode($data)?> )</script>
		<div class="col-xs-6 col-sm-4 col-md-4 height-max-set" style= "background-color : #e8d6b3; height: 100vh" >
			<div class="row">
				@if($data[0])
					@foreach ($data as $item)
					<?php $img_src = "/img/background/itemImg/".$item['img_src']; ?>
					
					<img src="{{$img_src}}" alt="item image" class="img-circle img-things-size item_list event_list" id="{{$item['id']}}" name="item_icon" style="margin : 17px">
					@endforeach
				@endif
			</div>
		</div>
		<div class="col-xs-5 col-sm-5 col-md-5 height-max-set" >
			<h3 id="name">事物登録</h3>
			<form class="form-horizontal" id="item" name="item" action="{{ route('things.store') }}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			{{-- 사물 이름 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">名前</label>
					<div class="col-sm-10">
					<input class="form-control" type="text" id="item_name" name="item_name" placeholder="Large input">
					</div>
				</div>
				{{-- 사물 내용 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">内容</label>
					<div class="col-sm-10">
					<textarea class="form-control" rows="3" id="item_content" name="item_content"></textarea>
					</div>
				</div>
				{{-- 사물 분류 등록 --}}
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="formGroupInputLarge">分類</label>
					<div class="col-sm-10">
					<input class="form-control" type="text" id="item_cate" name="item_cate" placeholder="Large input">
					</div>
				</div>
				{{-- 사물 추가사항 --}}
				<div class="form-group form-group-lg">
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
						<input type="file" id="item_img_upload" name="item_img_upload" >
					</div>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<div class="col-xs-3 col-sm-2 col-md-2 height-max-set background_tag" style="height: 100vh" >
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
						<?php 
						$page = "items";
						use App\Http\Controllers\TagsAddController;
						echo TagsAddController::view_return($page,$data);
						?>
			</div>
		</div>
	{{-- 태그 div.row 닫는 태그 --}}
	</div>
@endsection
