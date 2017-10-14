{{-- comment START --}}
<div id="comment">
    <div class="col-md-8 text-left">
        <h5>댓글 <small>(1)</small></h5>
    </div>
    {{--  <div class="col-md-6 text-left">
        <h3>소설리뷰 <small>(1)</small></h3>
    </div>
    <div class="col-md-6 text-right sort">
        {{--  <h5>
            <span class="sort-text">최신순</span> <span><i class="material-icons selectedIcon" name="check">check</i></span>
            &nbsp;&nbsp;&nbsp;
            <span class="sort-text">추천순</span> <span><i class="material-icons" name="check">check</i></span>
        </h5>  --}}
    {{--  </div>  --}}
    <div id="default-padding-mid" class="col-md-12"></div>
    <div class="col-md-12 review-list">
        <div class="row">
            <div class="col-md-12">
                {{-- USER COMMENT --}}
                <div class="input-group userComment-small">
                    <input type="text" class="form-control" placeholder="로그인 후 이용해주세요.">
                    <span class="input-group-addon">등록</span>
                </div>
            </div>
            <div id="default-padding-big" class="col-md-12"></div>
            <div class="col-md-9 text-left">
                <span><strong>이대감</strong></span>
                &nbsp;
                <span><small>2017-05-01 00:29:24</small></span>
            </div>
            <div class="col-md-3 text-right thumb-up">
                <span><i class="material-icons" name="thumb">thumb_up</i></span>
                <span class="thumb-text">0</span>
            </div>
            <div id="default-padding-small" class="col-md-12"></div>
            <div class="col-md-12">
                <span>ㅎㅇ!</span>
            </div>
            <div id="default-padding-small-1" class="col-md-12"></div>
            <div class="col-md-12 review" data-toggle="collapse" href="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
                <span class="re-review-text"><small>답글</small></span>
                <span><i class="material-icons" name="arrow">keyboard_arrow_down</i></span>
            </div>
            <div class="col-md-12 collapse" id="collapseComment">
                <div class="input-group input-group-mg commentReply">
                    <input type="text" class="form-control" placeholder="로그인 후 이용해주세요.">
                    <span class="input-group-addon">등록</span>
                </div>
            </div>
            <div id="default-padding-small-1" class="col-md-12"></div>
        </div>
    </div>
    <div id="default-padding-mid" class="col-md-12"></div>
</div>
{{-- comments END --}}

{{-- JHM STYLE --}}
<link rel="stylesheet" href="/css/jhm-style.css">
{{-- JHM SCRIPT --}}
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/JHM-Custom/jhm-selectIcon-custom.js"></script>
<script src="/js/JHM-Custom/jhm-comment.js"></script>
<script src="/js/JHM-Custom/jhm-arrow.js"></script>