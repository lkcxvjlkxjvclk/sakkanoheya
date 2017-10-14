 {{--  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>   --}}
 {{--  <script type="text/javascript" src="/js/custom/history.js"></script>   --}}
<div class="modal fade" tabindex="-1" role="dialog" id="timetable_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">사건 등록</h4>
      </div>
        <form class="form-horizontal" action="/chapter/addtimetable" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="chapter_id" value="{{$_COOKIE['chapter_id']}}"> 
        {{--  <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
        @php
            $hostname=$_SERVER["REQUEST_URI"]; 
        @endphp
        <input type="hidden" name="hostname" value="{{$hostname}}">
        <div class="modal-body table-responsive">
            <div class="" id="timeline2">
                {{--  {{var_dump($data)}}  --}}
                 <script> ready( <?=json_encode($data)?>,2 ); </script> 
            </div>
            <div class="row" id="timeline_name">
                <nav aria-label="...">
                    <ul class="pager" id="timetableList">
                        <?php
                            if($data[0]){
                                for($i = 0 ; $i < count($data) ; $i++){
                                ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="timetable_id[]" value="{{$data[$i]['id']}}"> 
                                        <li class="event_list" id="{{$i}}"><a href="#">{{$data[$i]['event_name']}}</a></li>
                                    </label>     
                                <?php
                                }
                            }
                        ?>
                        
                    </ul>
                </nav>
            </div>   
        </div>
        <div class="modal-footer">
          
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-default ownership_submit">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
