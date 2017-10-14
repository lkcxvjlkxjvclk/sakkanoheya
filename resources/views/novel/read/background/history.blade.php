<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/js/custom/history.js"></script>
<script type="text/javascript" src="/js/JHM-Custom/history_info.js"></script>
<script>ready(  <?=json_encode($data)?>  )</script>
<script>history_info(  <?=json_encode($data)?>  )</script>
@php
    use App\Http\Controllers\BackgroundHistoryTablesController;

    // print_r($data[0]['id']);
    $timetable_id = $data[0]['id'];
    // $timetable_id = 3;

    $characterList = BackgroundHistoryTablesController::open_characters($timetable_id);
    $itemList = BackgroundHistoryTablesController::open_items($timetable_id);
    $mapList = BackgroundHistoryTablesController::open_maps($timetable_id);  

@endphp
<div class="row">
    <div class="col-md-6">
        <div id="timeline">

        </div>
        <ul class="pager" id="timetableList">
            @if ($data[0] == 0)
                <strong>まだ公開された小説設定がありません。</strong>
            @else
                @for ($i = 0; $i < count($data); $i++)
                    <li name="event_list" id="{{$i}}"><a href="#">{!! $data[$i]['event_name'] !!}</a></li>
                @endfor
            @endif
		</ul>
    </div>

    <div class="col-md-6" name="history-info">
        <table class="table">
            <tr>
                <td>
                    <strong>タイトル</strong>
                </td>
                <td name="event-name">
                    {{-- EVENT NAME --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>内容</strong>
                </td>
                <td name="event-content">
                    {{-- EVENT CONTENT --}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>登場人物</strong>
                </td>
                <td name="event-character">
                    @if ($data[0] == 0)
                        <input type="hidden" value="EMPTY" />
                    @elseif (empty($characterList))
                        
                    @else
                        @foreach ($characterList as $character)
                              {!! $character['name'] !!}
                            &nbsp;
                        @endforeach
                    @endif

                </td>
            </tr>
            <tr>
                <td>
                    <strong>登場事物</strong>
                </td>
                <td name="event-item">
                    @if ($data[0] == 0)
                        <input type="hidden" value="EMPTY" />
                    @elseif (empty($itemList[0]))

                    @else
                        @foreach ($itemList as $item)
                              {!! $item['name'] !!}
                            &nbsp;
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <strong>背景場所</strong>
                </td>
                <td name="event-map">
                    @if ($data[0] == 0)
                        <input type="hidden" value="EMPTY" />
                    @elseif (empty($mapList[0]))

                    @else
                        @foreach ($mapList as $map)
                            {!! $map['name'] !!}
                            &nbsp;
                        @endforeach
                    @endif
                </td>
            </tr>
		</table>



    </div>
</div>
