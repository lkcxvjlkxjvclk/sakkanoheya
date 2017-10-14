<script src="/js/JHM-Custom/character_info.js"></script>
<script>character_info( <?=json_encode($data)?> )</script>
<div class="row">
    @if ($data[0] == 0) 
    <div class="col-md-12 text-center" name="character-view">
        <strong>まだ公開された小説設定がありません。</strong>
    @else
        <div class="col-md-3 text-center" name="character-view">
        @foreach ($data as $character)
            <img id="{{$character['id']}}" src="/img/background/characterImg/{{$character['img_src']}}" alt="character image" class="img-circle img-things-size character_list event_list" name="img_icon">
        @endforeach
    @endif
    </div>
    <div class="col-md-9 table-responsive" name="character-info">
		<table class="table">
            <tr>
                <td>
                    <strong>名前</strong>
                </td>
                <td name="character-name">
                    {{-- NAME --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>年齢</strong>
                </td>
                <td name="character-age">
                    {{-- AGE --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>性別</strong>
                </td>
                <td name="character-gender">
                    {{-- GENDER --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>内容</strong>
                </td>
                <td name="character-info">
                    {{-- INFO --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>作家の設定</strong>
                </td>
                <td name="character-refer_info">
                    {{-- REFER INFO --}}
                </td>
            </tr>
            <tr>
                <td name="character-item">
                    {{-- <strong>{{$data[0]['name']}}의 물건 --}}
                </td>
                <td>
                    {{-- ITEM --}}
                </td>
            </tr>
		</table>

    </div>
</div>