<script src="/js/JHM-Custom/relation_info.js"></script>
<script>relation_info( <?=json_encode($data)?> )</script>

<div class="row">
	@if ($data[0] == 0)
	<div class="col-md-12" name="relation-view">
		<strong>まだ公開された小説設定がありません。</strong>
	@else	
	<div class="col-md-1" name="relation-view">
		@foreach ($data as $relation)
			<img id="{{$relation['id']}}" src="/img/background/relationImg/{{$relation['relHref']}}" alt="relation image" class="img-circle img-things-size relation_list" name="img_icon" />
		@endforeach
	@endif
	</div>		
	<div class="col-md-11" name="relation-info">
		{{-- RELATION IMG --}}
	</div>	
</div>