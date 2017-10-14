@extends('layouts.master')

@section('content') 
		@include('partials.mySubNavi')
		@include('background.tag')
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="/js/custom/history.js"></script>
		<script type="text/javascript" src="/js/custom/share_click.js"></script>
		
		{{-- 설정 정보 호출 div   --}}
		<div class="col-xs-6 col-sm-4 col-md-4 height-max-set" style= "background-color : #e8d6b3; height:100vh; overflow:auto" >
			<div>
				<i class="fa fa-clock-o share_icon" aria-hidden="true" id="timetables" style="font-size : 55px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-user share_icon" aria-hidden="true" id="characters" style="font-size : 60px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-shopping-cart share_icon" aria-hidden="true" id="items" style="font-size : 55px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-users share_icon" aria-hidden="true" id="relations" style="font-size : 50px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-map share_icon" aria-hidden="true" id="maps" style="font-size : 50px"></i>
			</div>
			<br/>
			<div id="none_set_open_background">
				<h4>非公開設定</h4>
			</div>
			<div id="open_background" style="height:400px; border-top: 2px solid #e0e0e0">
				<h4>公開設定</h4>
			</div>
		</div>
		<div class="col-xs-7 col-sm-6 col-md-6 height-max-set" >
			<div class='form_background_data'>
				<form class='form-horizontal set_open_background_data' id='open_background' name='open_background' action='share/insert_open_background' method='POST' enctype='multipart/form-data'>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
		{{-- 1의 공간을 남겨둠   --}}
	{{-- 태그 div.row 닫는 태그 --}}
	</div>
@endsection
