<table class="table table-hover text-center">
    <thead>
        <tr>
            <td>No.</td>
            <td>タイトル</td>
            <td>投稿者</td>
            <td>投稿日</td>
            {{--  <td>조회수</td>
            <td>추천</td>  --}}
        </tr>
    </thead>
    <tbody>
        @if (isset($data[0]['empty']))
            <tr>
                <td>書き込みがありません。</td>
                <td>.</td>
                <td>.</td>
                <td>.</td>
                {{--  <td>.</td>
                <td>.</td>  --}}
            </tr>
        @else
            @foreach ($data as $list)
                {{-- $list['blog_id'] DataType INT   --}}
                <tr data-href="/community/{{ $list['blog_owner_id'] }}&{{ $list['blog_id'] }}&{{ $list['community_id'] }}&{{ $list['board_id'] }}">
                    <td>.</td>
                    <td>{{ $list['board_title'] }}</td>
                    <td>{{ $list['writer_name'] }}</td>
                    <td>{{ $list['created_at'] }}</td>
                    {{--  <td>{{ $list[$i]['board_hit'] }}</td>
                    <td>{{ $list[$i]['board_like'] }}</td>  --}}
                </tr>
            @endforeach
        @endif
    </tbody>    
</table>

<div class="row text-right">
    <div class="col-md-12">
        <a href="/yerriel/blog/community/create" class="btn btn-default">書く</a>
    </div>
</div>

{{-- JHM SCRIPT --}}
<script type="text/javascript" src="/js/JHM-Custom/community_click.js"></script>