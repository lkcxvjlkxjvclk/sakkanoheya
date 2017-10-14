@php
	use App\Http\Controllers\BlogController;
@endphp
<div class="container">
    <div class="row">
        {{-- BLOG SIDE MENU DIV START --}}
        <div id="blog-side-menu" class="col-md-4">
            {{-- USER IMG --}}
            <div class="user_icon text-center">
                <i class="material-icons">account_circle</i>
            </div>
            {{-- USER PROFILE --}}
            <div class="user_profile">
            <input type="hidden" value="1" name="user_id" />
                <div class="user_info text-center">
                    <strong>{!! $data[0]['blog_owner_name'] !!} </strong>
                    &nbsp;
                    (
                         {!! $data[0]['blog_owner_id'] !!} 
                    )
                </div>
                
                <div class="profile_text">
                    {!! $data[0]['blog_introduce'] !!}
                </div>
                <div id="default-padding-mid"></div>
                <div class="user_setting text-center">
                {{-- 블로그 메뉴 있을 때 없을 때 마우스 막아놓기!   --}}
                    {{--  <a href="{{ route('blog.create') }}">  --}}
                    <a href="/yerriel/blog/create">
                        <div>
                            <i class="material-icons">border_color</i>
                        </div>
                        <div>ポスト</div>
                    </a>
                    &nbsp;&nbsp;
                    {{-- 관리 : 사용자의 블로그일 때만 표시   --}}
                    <a href="/yerriel/blog/{{$data[0]['id']}}/setMap">
                        <div>
                            <i class="material-icons">settings</i>
                        </div>
                        <div>管理</div>
                    </a>
                </div>
            </div>
            <hr />
            {{-- BLOG MENU NAV --}}
            <div class="user_novel_nav">
                <strong>私の小説</strong>
                {{-- 소설 있을 때 없을 때   --}}
                <ul>
                    @php
                        {{-- @param DataType STRING   --}}
                        echo BlogController::showAllNovel($data[0]['blog_owner_id']);
                    @endphp
                </ul>
            </div>
            <hr />
            <div class="blog_menu_nav">
                <strong>作家の部屋</strong>
                {{-- 블로그 메뉴 있을 때 없을 때   --}}
                @if ($data[0]['blog_menu_id'] == "empty")
                    <h5>メニューがありません。</h5>
                @else
                    @php
                        echo BlogController::showAllMenu($data[0]['id']); 
                    @endphp
                @endif
            </div>
            <hr />
            <div class="blog_reader_menu_nav">
                <strong>
                    <a href="/{{$data[0]['blog_owner_id']}}/blog/community">読者コミュニティー</a>
                </strong>
            </div>
            <hr />
            {{-- BLOG INFO BAR --}}
            <div class="blog_info_bar">
                <strong>活動情報</strong>
                {{-- BLOG FOLLOW - NUMBER --}}
                <div class="blog_follow_info">
                    <div>
                        <h1>000</h1>
                    </div>
                    <div name="blogInfoNumText">
                        &nbsp; 人が
                    </div>
                    <br />
                    この部屋に関心があります。
                </div>
                {{-- WRITER NOVEL INFO - NUMBER --}}
                <div class="writer_novel_info">
                    <div>
                        <h1>000</h1>
                    </div>
                    <div name="blogInfoNumText">
                        &nbsp; 数の
                    </div>
                    <br />
                    小説を執筆しました。
                </div>
            </div>
            <hr />
            {{-- BLOG COUNTER --}}
            <div class="blog_counter">
                <small>訪問者の数</small>
                {{-- <br /> --}}
                <div class="blog_visit_info">
                    <div>
                        <strong class="text-uppercase">Today</strong>
                    </div>
                    <div class="blog_visitNum">
                        <strong>
                            {!! $data[0]['today_hit'] !!}
                        </strong>
                    </div>
                </div>
                <div class="blog_visit_info">
                    <div>
                        <strong class="text-uppercase">Total</strong>
                    </div>
                    <div class="blog_visitNum">
                        <strong>
                            {!! $data[0]['total_hit'] !!}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
        {{-- BLOG SIDE MENU DIV END --}}







