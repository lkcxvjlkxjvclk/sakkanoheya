<script src ="{{url(asset('js/jscolor.js?ver=1'))}}"></script>
<script type="text/javascript" src="/js/custom/tag_event.js"></script>
<script> var a = tag_click( <?=json_encode($datas['tag_data'])?>, <?=json_encode($datas['page'])?> ); </script>

<h3>タグ登録</h3>
<form id="add_tag" name="add_tag" action="{{ route('tagsAdd.store') }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {{-- 현재 페이지 정보 전달 --}}
    <input type="hidden" name="page" value="{{$datas['page']}}">
    {{-- 대상 id값 전달 --}}
    <input type="hidden" id="object_id" name="object_id" value="">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">タグの名</h3>
        </div>
        <div class="panel-body">
            <input type="text" id="tag_name" name="tag_name" class="form-control" placeholder="Text input">
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">タグの色</h3>
        </div>
        {{-- <div class="panel-body">
            <input type="text" id="tag_color" name="tag_color" class="form-control" placeholder="Text input">
        </div> --}}
        <div id="colorPalette" class="palette">
				&nbsp;HEX value: <button class="color-palette jscolor {valueElement:'chosen-value'}">Color Picker</button>
				<input class="form-control panel-body" id="chosen-value" name="tag_color" value="000000" size = "6">
		</div>
    </div>
    <button type="submit" name="tag_submit" id="tag_submit" class="btn btn-default">Submit</button>   
</form>