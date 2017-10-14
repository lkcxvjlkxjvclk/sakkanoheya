
 @foreach ($data as $menuB)
    <div class="board_title">
        <ul class="list-inline">
            
            @if ($menuB->is_notice == "on")
                <li>
                    <strong>[ノーティス]</strong>
                </li>
            @endif
            <li>
                <h4>
                    <strong>{!! $menuB->board_title !!}</strong>
                </h4>
            </li>
            <li>
                <small>| {!! $menuB->menu_title !!}</small>
            </li>
            <li class="board_timestamp">
                <small>{!! $menuB->created_at !!}</small>
            </li> 
        </ul>
        
    </div>
    <div name="title_line"></div>
    <div class="board_content">
        <div id="default-padding-big"></div>
        {!! $menuB->board_content !!}
    </div>
@endforeach
 
<div class="text-center">
      {{ $data->appends(['data' => $data->currentPage()])->links() }}    
</div>