@foreach ($noticeData as $data)
    <div class="board_title">
        <ul class="list-inline">
            <li>
                <strong>[ノーティス]</strong>
            </li>
            <li>
                <h4>
                    <strong>{!! $data['board_title'] !!}</strong>
                </h4>
            </li>
            <li>
                <small>| {!! $data['blog_menu_id'] !!}</small>
            </li>
            <li class="board_timestamp">
                <small>{!! $data['created_at'] !!}</small>
            </li> 
        </ul>
    </div>
    <div name="title_line"></div>
    <div class="board_content">
        <div id="default-padding-big"></div>
        {!! $data['board_content'] !!}
    </div>
@endforeach
<div class="text-center">
    {{ $noticeData->appends(['noticeData' => $noticeData->currentPage()])->links() }}  
</div>