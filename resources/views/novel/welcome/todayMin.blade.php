
{{--TODAY-NOVEL START--}}
<div id="today-novel" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					@if (empty($data[0]['title']))
						<h1>今日の小説</h1>
					@else
						<h1><a class="noDeco" href="#">今日の小説</a></h1>
					@endif
					<p>今日の <br>人気の小説! </p>
					<hr class="pg-titl-bdr-btm" />
				</div>
					@if (empty($data[0]['title']))
						<h1>ちょっと</h1>
					@else
						@for ($i = 0; $i < count($data); $i++)
							<div class="col-md-4">
								<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
									<div class="service-box">
										<div class="service-icon"><img src="upload/images/{{ $data[$i]['cover_img_src'] }}" /></div>
										<div class="service-text">
											<input type="hidden" name="genre" value="{!! $data[$i]['genre'] !!}"/>
											<h5 class="genre" name="genre"></h5>
											<h3>{!! $data[$i]['title'] !!}</h3>
											<p> <i class="fa fa-pencil"></i> 作家さん</p>
											<p> <b>{!! $data[$i]['summary_intro'] !!}</b></p>
										</div>
									</div>
								</a>
							</div>
						@endfor
					@endif
			</div>
		</div>
	</div>
    {{--TODAY-NOVEL END--}}

