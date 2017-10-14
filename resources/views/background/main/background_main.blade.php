@extends('layouts.master')

@section('content')

	@include('partials.mySubNavi')
	 <div class="row">
	 	<div class="col-xs-2 col-sm-1 col-md-1 text-center height-max-set" style="height: 100vh"></div>
		<div class="col-xs-11 col-sm-9 col-md-9 height-max-set" style= "height: 100vh" >
			<br>
			@isset($data[0]['cover_img_src'])
				@for($i = 0; $i < count($data) ; $i++)
					<table class="table table-condensed">
						<tr>
							<th>표지</th>
							<th>제목</th>
							<th>장르</th>
							<th>관리</th>
						</tr>
						<tr>
							<td rowspan='2' style="width:220px">
								@php
									$img_src = "/upload/images/".$data[$i]['cover_img_src'];
								@endphp
								<a href="#">
									<img src="{{$img_src}}" class = "img-rounded" alt="" style="height:180px; align:right" > 
								</a>
							</td>
							<td>제목</td>
							<td>장르</td>
							<td>
								<a class="btn btn-default" href="/background/{{$data[$i]['id']}}" role="button">배경 설정</a>
								<a class="btn btn-default" href="/chapter/{{$data[$i]['id']}}" role="button">챕터 설정</a>
							</td>
						</tr>
						<tr>
							<td colspan='3'>df</td>
						</tr>
					</table>
				@endfor
			@endisset
		</div>

		<div class="col-xs-3 col-sm-2 col-md-2 height-max-set background_tag" style="height: 100vh">
			
		</div>
	</div>
@endsection
