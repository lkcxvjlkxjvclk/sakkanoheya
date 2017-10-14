<div class="modal fade" tabindex="-1" role="dialog" id="character">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">登場人物登録</h4>
      </div>
      
      <div class="modal-body">
        @php
          use App\Http\Controllers\BackgroundHistoryTablesController;
          $list = BackgroundHistoryTablesController::show_characters();
        @endphp
        @if($list[0])
          @foreach ($list as $character)
              @php
                $img_src = "/img/background/characterImg/".$character['img_src'];
              @endphp
              <img src="{{$img_src}}" alt="character image" class="img-circle img-things-size character_list" id="{{$character['id']}}" style="margin : 17px">
          @endforeach
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="/js/custom/character_effect.js"></script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default character_effect_submit" data-dismiss="modal">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
