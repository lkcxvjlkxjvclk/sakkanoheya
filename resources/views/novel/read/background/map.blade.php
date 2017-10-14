<script src="/js/JHM-Custom/map_info.js"></script>
<script>map_info( <?=json_encode($data)?> )</script>
@php
    use App\Http\Controllers\BackgroundHistoryTablesController;

    $list = BackgroundHistoryTablesController::show_maps();
@endphp
<div class="row">
    @if($list[0])
    <div class="col-md-1" name="map-view">
        @foreach ($list as $map)
            @php
                $img_src = "/img/background/mapImg/mapCover/".$map['img_src'];
            @endphp
            <img id="{{$map['id']}}" src="{{$img_src}}" alt="map image" class="img-circle img-things-size map_list" name="img_icon">
        @endforeach
    @else
    <div class="col-md-12" name="map-view">
        <strong>まだ公開された小説設定がありません。</strong>
    @endif
    </div>
    <div class="col-md-11" name="map-info">
        {{-- MAP IMG --}}
    </div>
</div>