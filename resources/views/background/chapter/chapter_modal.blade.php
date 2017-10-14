<div class="modal fade" tabindex="-1" role="dialog" id="abc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">챕터 등록</h4>
      </div>
      <form class="form-horizontal" action="{{ route('chapter.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--  <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
        <div class="modal-body">
          @php
            $hostname=$_SERVER["REQUEST_URI"]; 
            $id = explode("/",$hostname);
            {{--  echo $id[2];  --}}
          @endphp
          {{-- novel id  --}}
             <input name="novel_id" id="novel_id" type="hidden" value="{{$id[2]}}">   
          {{-- chapter name  --}}
          <div class="form-group">
            <label class="col-sm-2 control-label" for="chapter_name">챕터 제목</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="chapter_name" id="chapter_name" placeholder="챕터 제목">
            </div>            
          </div>
          {{-- chapter content  --}}
          <div class="form-group">
            <label for="chapter_content" class="col-sm-2 control-label">챕터 설명</label>
            <div class="col-sm-10">
              <textarea name="chapter_content" name="chapter_content" id="chapter_content" cols="30" rows="10" id="chapter_content" class="form-control"></textarea>
            </div>
          </div>
        
          
          {{--  <script type="text/javascript" src="/js/custom/ownership_add.js"></script>  --}}
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default ownership_submit">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
