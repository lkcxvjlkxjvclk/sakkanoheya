<div class="modal fade" tabindex="-1" role="dialog" id="episode">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">회차 등록</h4>
      </div>
       <form class="form-horizontal" action="/chapter/add/episode" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="chapter_id" value="{{$data['chapter_id']}}">
        {{--  <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
        <div class="modal-body table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>회차 표지</th>
                    <th>회차 제목</th>
                    <th>챕터 등록</th>
                </tr>
                @for ($i = 0 ; $i < count($data)-1 ; $i++)
                    <tr>
                        <td>
                             <img src="/upload/images/{{$data[$i]['cover_img_src']}}" alt="episode img" class="img-circle" style="width : 50px; height:50px"> 
                        </td>
                        <td>
                            {{$data[$i]['episode_title']}}
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="episode_id_{{$data[$i]['id']}}" name="episode_id[]" value="{{$data[$i]['id']}}" aria-label="episode_id">
                                </label>
                            </div>
                        </td>
                    </tr>
                @endfor
            </table>
        </div>
        <div class="modal-footer">
          
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-default ownership_submit">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
