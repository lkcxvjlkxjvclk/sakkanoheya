<div class="modal fade" tabindex="-1" role="dialog" id="maps">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">背景場所登録</h4>
      </div>
      
      <div class="modal-body">
        @php
          use App\Http\Controllers\BackgroundHistoryTablesController;
          $list = BackgroundHistoryTablesController::show_maps();
        @endphp
        @if($list[0])
          @foreach ($list as $map)
              @php
                $img_src = "/img/background/mapImg/mapCover/".$map['img_src'];
              @endphp
              <img src="{{$img_src}}" alt="map image" class="img-circle img-things-size map_list" id="{{$map['id']}}" style="margin : 17px">
          @endforeach
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="/js/custom/map_effect.js"></script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default map_effect_submit" data-dismiss="modal">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
