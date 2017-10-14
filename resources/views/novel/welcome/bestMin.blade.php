

{{--BEST-NOVEL START--}}
	<div id="best-novel" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					@if (empty($data[0]['title']))
						<h1>全ての小説</h1>
					@else
						<h1>全ての小説</h1>
					@endif
					<p>ジャンル別に多様な小説</p>
					<hr class="pg-titl-bdr-btm" />
				</div>
				<div class="port-sec">
					<div class="col-md-12 fil-btn text-center">
							<div class="filter wrk-title active" data-filter="all">全て</div>
							<div class="filter wrk-title" data-filter=".romance">ロマンス</div>
							<div class="filter wrk-title" data-filter=".fantasy">ファンタジー</div>
							<div class="filter wrk-title" data-filter=".martial">武侠</div>
							<div class="filter wrk-title" data-filter=".scifi">SF</div>
							<div class="filter wrk-title" data-filter=".detective">推理</div>
							<div class="filter wrk-title" data-filter=".agenovel">歴史</div>
							<div class="filter wrk-title lst-cld" data-filter=".horror">ホラー</div>
					</div>
					<div id="Container">
						@if (empty($data[0]['title']))
							<h1>待ってください。</h1>
						@else
							@for ($i = 0; $i < count($data); $i++)
								<div class="filimg mix {{ $data[$i]['genre'] }} col-md-4 col-sm-4 col-xs-12" data-myorder="2">
									<a href="/novel/info/novel_info/{{ $data[$i]['id'] }}">
										<img src="upload/images/{{ $data[$i]['cover_img_src'] }}" class="img-responsive">
									</a>
								</div>
							@endfor
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	{{--BEST-NOVEL END--}}
