<div class="default-padding"></div>
@extends('layouts.master')


@section('content')
  <script src="{{URL::asset('js/jquery.textcomplete.js')}}"></script>

  <style>
    .set_row {
      border-top: #EAEAEA 2px solid;
      padding: 10px;
    }

    .main_title {
      color:#BDBDBD;
      font-size:24px;
    }

    .menu_title {
      font-size:18px;
      padding-right: 8px;
    }

    .novel-title{
      font-size:18;
      font-weight: bold;
    }
    .menu_input {
      border:none;
    }

    .menu_select {
      border: #BDBDBD 2px solid;
      padding: :5px;
    }
    .check_box {
      background-color: blue;
    }

    .check_novel_period {
      padding-left: 10px;
      padding-right: 10px;
    }


    /*회색 #BDBDBD  파랑 #fdfdfd*/
    .set-notice-btn{
      display: inline-block;
      text-align: center;
      padding: 4px;
      width:100px;
      color: #BDBDBD;
      font-size: 16px;
      line-height: normal;
      background-color: #fdfdfd;
      cursor: pointer;
      border: 2px solid #BDBDBD;
      margin: 0 auto;
    }

    .selected-notice{
      color: #00D8FF;
      border: 2px solid #00D8FF;
    }

    .set-charge-btn{
      display: inline-block;
      text-align: center;
      padding: 4px;
      width:100px;
      color: #BDBDBD;
      font-size: 16px;
      line-height: normal;
      background-color: #fdfdfd;
      cursor: pointer;
      border: 2px solid #BDBDBD;
      margin: 0 auto;
    }

    .selected-charge{
      color: #00D8FF;
      border: 2px solid #00D8FF;
    }

    /* 커버 이미지 */

    .image_list_box {
      background-color:#EAEAEA;
    }
    .image_list{
      height:200px;
      width:80%;
      margin-left: auto;
      margin-right: auto;
    }
    .image_cell {
      display: inline-block;
      height:100%;
      width:50px;
      text-align: center;
    }

    .cover-img {
      position:relative;
      height:100%;
      width:65%;
      margin-left: auto;
      margin-right: auto;
      display: block;
    }

    .cover-img > img {
      height:100%;
      width:100%;

    }
    .quitBox {
      display: inline-block;
      position:absolute;
      right:0;
      margin-right:auto;
      background: #f90;
      color: #fff;
      font-family: 'Helvetica', 'Arial', sans-serif;
      font-size: 2em;
      font-weight: bold;
      text-align: center;
      width: 40px;
      height: 40px;
      border-radius: 5px;
    }

    .selected-image {
      border:2px solid #5CD1E5;
    }

    .img_upload_label{
      display: inline-block;
      padding: .5em .75em;
      color: #00D8FF;;
      font-size: inherit;
      line-height: normal;
      vertical-align: middle;
      background-color: #fdfdfd;
      cursor: pointer;
      border: 2px solid #00D8FF;;
      border-radius: .25em;

    }
    .img_upload_btn{
      position: absolute;
      width: 1px; height: 1px;
      padding: 0; margin: -1px;
      overflow: hidden;
      clip:rect(0,0,0,0);
      border: 0;
    }

    /*에디터 부*/

    .edit-div {
      padding: 0;
      padding-bottom: 10px;
      height:500px;
    }

    .edit-box {
      border:#EAEAEA 2px solid;
      margin-bottom: 10px;
      overflow-y: scroll;
      padding-left: 5px;

    }

    .episode-editor-div {
      display: inline-block;
      vertical-align: middle;
      height:100%;
    }

    .background-box {
      position:absolute;
      padding: 4px;
      display: inline-block;
      height:100%;
      background-color: #cefff5;
      vertical-align: middle;
      margin-bottom: 5px;
      width:220px;
    }


    .background-div {
      border-bottom: #D8D8D8 2px solid;
    }

    .background-top{
      height:6%;
      /*background-color: red;*/
      font-size: 18px;
      font-weight: bold;
      text-align: center;

    }

    .background-search{
      text-align: center;
      padding-top: 2px;
      padding-bottom: 2px;
      height:16%;
      /*background-color:purple;*/
    }

    btn-group > button {
      margin:0;
      padding:0;
      width: 50px;
    }
    /* 배경설정 컨텐츠 */
    .background-content{
      height:71%;
      /*background-color: blue;*/
    }

    .basic-info-div{
      padding-top: 3px;
      /*background-color: yellow;*/
      padding-left: 0px;
      padding-right: 0px;
    }
    .basic-cha-img{
      /*background-color: blue;*/
      text-align: center;
      padding-right: 10px;
      min-height: 30%;
    }
    .basic-cha-img > img {
    }
    .basic-cha-info{
      display:inline-block;
      padding:0;
      padding-left: 2px;
      text-align: left;
      /*background-color: green;*/
      min-height: 30%;
    }

    .info-div{
      padding-left: 0px;
      padding-right: 0px;
      height: 25%;
    }

    .info-header{
      text-align: center;
      font-weight: bold;
    }
    .info-content{
      overflow-y: scroll;
      padding : 1px;
      background-color: white;
      height: 70%;
    }

    .tag-info-div{

      padding-left: 0px;
      padding-right: 0px;
      height: 18%;
    }



    .tag-info-header{
      text-align: center;
      font-weight: bold;
    }
    .tag-info-content{
      padding : 1px;
      height: 70%;
    }
    .tag-info-color{
      padding:10px;
      height:32px;
      width:32px;
      padding-left: 10px;
      border: 2px solid #BDBDBD;
    }

    /* 배경설정 푸터 */
    .background-footer{
      height:7%;
      /*background-color: green;*/
    }

    .writers-postscript-div {
      height:100px;
    }

    .btn_div {
      text-align: center;
      align-items: center;
      height: 100px;
    }
    .func_btn {
      cursor: pointer;
      vertical-align: middle;
      border: #7CC8C9 2px solid;
      color: #7CC8C9;
      font-size: 24px;
      width: 80%;
      height: 60px;
      padding-top: 10px;
      margin: 0 auto;
    }

    /* 마우스 오버 시 캐릭터 팝업 */
    .pop-menu {
      z-index:1000;
      position: absolute;
      background-color:#C0C0C0;
      border: 1px solid black;
      padding: 2px;
    }

    .pop-menu > img {
      z-index:1000;
      position: absolute;
      width:150px;
      height:150px;
    }
    /* background 모달 디자인 */
    .bgModal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .bg-modal-content{
      z-index:3;
      border-radius:5px;
      margin:0;
    }

    .bg-modal-header {
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      padding: 12px;
      height:10%;
      background-color: #DBDBDB;
    }

    .bg-modal-header > span {
      display: inline block;
    }

    .bg-modal-body{
      height:90%;
    }

    .bg-modal-top {
      height:30%;
      border-bottom: 3px solid #d9d9d9;
      margin:10px;
      overflow-y: scroll;
    }
    .bg-modal-middle {
      height:30%;
      border-bottom: 3px solid #d9d9d9;
      margin:10px;
      overflow-y: scroll;
    }
    .bg-modal-bottom {
      height:30%;
      margin:10px;
      overflow-y: scroll;
    }
    .bgTitle {
      font-size: 30px;
    }

    .bg-modal-content {

        background-color: #fefefe;
        margin: 9% auto; /* 15% from the top and centered */
        padding: 0px;
        border: 1px solid #888;
        height:600px;
        width: 60%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .bgClose {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .bgClose:hover,
    .bgClose:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* 모달 내부 컨텐츠 css*/
    .bg-div{
      height:100%;
      display: inline-block;
    }

    .bg-img-div{
      text-align: center;
      height:100%;
    }

    .bg-img-div >span {
      font-size:15px;
      font-weight: bold;
    }
    .cha-img-size {
      width:130px;
      height:130px;
    }

    .bg-cha-info {
      font-size: 18px;
      margin-top:20px;
    }

    .bg-cha-info > span{
      font-weight:bold;
    }

    .bg-refer-div > span{
      font-size: 24px;
      font-weight: bold;
    }

    .refer-info{
      height:43px;
      border:3px solid #c9c9c9;
      overflow-y: scroll;
    }
    .tag-info{
      height:43px;
      border:3px solid #c9c9c9;
      overflow-y: scroll;
    }
    .tag-color-box {
      display: inline-block;
      background-color: #3c9182
    }

    /* 로딩*/

  	#loading {
  		height: 100%;
  		left: 0px;
  		position: fixed;
  		_position:absolute;
  		top: 0px;
  		width: 100%;
  		filter:alpha(opacity=50);
  		-moz-opacity:0.5;
  		opacity : 0.5;
  	}

  	.loading {
  		background-color: white;
  		z-index: 199;
  	}

  	#loading_img{
  		position:absolute;
  		top:50%;
  		left:50%;
  		height:35px;
  		margin-top:-75px;	//	이미지크기
  		margin-left:-75px;	//	이미지크기
  		z-index: 200;
  	}

  .relation-list > span {
    font-size: 16px;
    font-weight: bold;
    margin: 3px;
  }

  .ownership-list > span {
    font-size: 16px;
    font-weight: bold;
    margin: 3px;
  }
  .active {
    z-index:1;
  }

  .case-btn{

  }

    #timeline {

    }
  </style>


  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="write_novel_set">
    <div class="container">
      <div class="row set_row">
        <div class="col-md-12 main_title">회차 / 공지 쓰기</div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <span class="menu_title">소설 제목</span>
          <span class="novel-title">{{ $tasks['novelTitle'] }}</span>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <label class="set-notice-btn selected-notice" data-notice="episode">회차</label>
          <label class="set-notice-btn" data-notice="notice">공지</label>
          <label class="set-charge-btn selected-charge" data-charge="free">무료</label>
          <label class="set-charge-btn" data-charge="charge">유료</label>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <span class="menu_title">회차 제목</span>
          <input id="episode-title" class="menu_input" type="text" placeholder="회차 제목을 입력해주세요." size=50>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-10 menu_title">표지 이미지
        </div>

        <div class="col-md-2">
          <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
            <label class="img_upload_label">이미지 업로드
              <input class="img_upload_btn" id="imgFile" name="imgFile" type='file'>
            </label>
          </form>
        </div>
      </div>

      <div class="row set_row image_list_box">
        <div class="image_list center-slick" data-href="{{URL::to('upload/images')}}">
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12 menu_title">내용</div>
      </div>
      <div class="col-md-12 edit-div">
        <div id="editdiv" class="col-md-10 edit-box episode-editor-div" contenteditable="true">
          episode content
        </div>
        <div class="col-md-2 background-box">
          <div class="background-div background-top">
            &nbsp;&nbsp;&nbsp;소설 배경 설정
            <span id="bgBtn" class="pull-right glyphicon glyphicon-resize-full"></span>
          </div>
          <div class="background-div background-search">

            <div class="input-group col-md-12">
      				<div id="radioBtn" class="btn-group">
      					<a class="case-btn btn btn-primary btn-sm notActive"  data-title="characters"></a>
                <a class="case-btn btn btn-primary btn-sm notActive" data-title="items">사물</a>
      					<a class="case-btn btn btn-primary btn-sm notActive" data-title="maps">장소</a>
                <a class="case-btn btn btn-primary btn-sm notActive" data-title="timetables">사건</a>
      				</div>
    			  </div>
            <div class="ui-widget">
              <label for="tags"></label>
              <input id="tags" class="form-control">
            </div>
          </div>
          <div class="background-div background-content">

          </div>
          <div class="pull-down background-div background-footer">
            <button type="button" id="applyTag" class="form-control">태그 적용</button>
          </div>
        </div>
      </div>

      <div class="edit-box writers-postscript-div" contenteditable="true">
        writers postscript
      </div>

      <div class="row set_row">
        <div class="col-md-6 btn_div"><div class="func_btn episode-cancel">취소</div></div>
        <div class="col-md-6 btn_div"><div class="func_btn episode-save">저장</div></div>
      </div>

    </div>
  </div>

  <!-- The Modal -->
  <div id="bgModal" class="bgModal">

    <div class="bg-modal-content">
      <div class="bg-modal-header"><span class="bgTitle">상세 소설 배경</span><span class="bgClose">&times;</span></div>
      <div class="bg-modal-body">
        <div class="bg-modal-top">



        </div>
        <div class="bg-modal-middle">

        </div>
        <div class="bg-modal-bottom">

        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/js/custom/history.js"></script>
<script>
  (function ($) {
    var loading = $('<div id="loading" class="loading"></div><img id="loading_img" alt="loading" src="/img/write_novel/viewLoading.gif" />')
						.appendTo(document.body).hide();

    // 인물,사물,장소,사건 분류 버튼
    $(".case-btn").on('click',function(){
      if($(this).hasClass("active")){
        $(this).removeClass("active");
        $(this).addClass("notActive");
      } else {
        $(this).removeClass("notActive");
        $(this).addClass("active");
      }
      setAutocomplete();
    });
    var source = Array();
    // characetrs, thing, place, event여부에 따른 자동완성
    function setAutocomplete(){
      source = Array();
      $("a.active").map(function(d){
        source = source.concat(getTags($(this).data("title")));
      });
      console.log(source);

      $( "#tags" ).autocomplete({
        source: source,
        select: function (event,ui) {
          setBackgroundContent(ui.item);
        }
      }).data("ui-autocomplete")._renderItem = function (ul, item) {
        var kind = "";
        if(item.kind == "characters") kind = "인물";
        else if(item.kind == "items") kind = "사물";
        else if(item.kind == "maps")  kind = "지도";
        else if(item.kind == "timetables") kind ="사건";
        else kind = "미분류";

         return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<a class='col-md-12'>" + item.value+ "<div class='pull-right' style='background-color:#"+item.color+"'>TC</div>" + "<div class='pull-right'>"+ kind + "</div>"  + "</a>")
             .appendTo(ul);
     };
    }

    // 서버로부터 characters, items, timetables, maps 대한 데이터를 불러옴
    var sourceData = Array();
    function setSourceData(data){ sourceData = data; return sourceData;};
    function getTags(tagCase=null){
      $.ajax({
          type: "get",
          async: false,
          url: "/write_novel/get_tags",
          data: {
            "tagCase" : tagCase
          }
      }).done(function(data){
        setSourceData(data);
      });
      return sourceData;
    };

    // soureData로 부터 케이스, 아이디에 해당하는 태그만 추출
    function filterSourceData(tagCase, tagId){
      var filter = source;
      console.log(filter);
      filter = filter.filter(function(data){
        return (data.kind == tagCase) && (data.object_id == tagId)
      });
      console.log(filter);
      return filter;
    }

    // tag에 정보에 따른 정보 출력
    function setBackgroundContent(item){

      // 케이스별로 정보 출력 $(".background-content")
      console.log("item");
      console.log(item);
      callBackgroundInfo(item.kind, item.object_id);

      // 케이스 + 아이디로 정보 호출
      function callBackgroundInfo(bgCase, bgId){
        $.ajax({
            type: "get",
            url: "/write_novel/call_background_info",
            async: false,
            data: {
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              data = data[0];
              console.log("asdasd");
              console.log(data);
              var div = $(".background-content");
              // 캐릭터 정보 출력
              if(bgCase == "characters"){
                var appendEle = "";
                var filterTag = filterSourceData("characters", bgId);
                //appendEle += data.cha_id + data.name + data.info + data.age + data.gender + data.img_src;
                appendEle += "<div class='col-md-12 basic-info-div background-div'>";
                appendEle += "<input id='bgHidden' type='hidden' data-kind='characters' data-id='"+bgId+"'>"
                appendEle += "  <div class='col-md-6 basic-cha-img'>";
                appendEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ data.img_src +"'>";
                appendEle += "    <br><span>" + data.name + "</span>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-6 basic-cha-info'>";
                appendEle += "    <br>";
                appendEle += "    <span>";
                appendEle += "    이름 | " + data.name + "<br>";
                appendEle += "    나이 | " + data.age + "<br>";
                appendEle += "    성별 | " + data.gender + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    주요 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle += data.info;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    태그 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-9 tag-info-content'>";
                appendEle += "    <select class='form-control tag-list-select'>";
                filterTag.forEach(function(d){
                  appendEle += "      <option data-kind='" + d.kind + "' data-id='" + d.object_id + "' data-color='" + d.color + "'>" + d.value + "</option>";
                });
                appendEle += "    </select>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-3 tag-info-color'></div>";
                appendEle += "</div>";
              // 사물 정보 출력
              }else if (bgCase == "items"){
                var appendEle = "";
                var filterTag = filterSourceData("items", bgId);
                //appendEle += data.cha_id + data.name + data.info + data.age + data.gender + data.img_src;
                appendEle += "<div class='col-md-12 basic-info-div background-div'>";
                appendEle += "<input id='bgHidden' type='hidden' data-kind='items' data-id='"+bgId+"'>"
                appendEle += "  <div class='col-md-6 basic-cha-img'>";
                appendEle += "    <img class='img-circle img-things-size' src='/img/background/itemImg/"+ data.img_src +"'>";
                appendEle += "    <span>" + data.name + "</span>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-6 basic-cha-info'>";
                appendEle += "    <br>";
                appendEle += "    <span>";
                appendEle += "    이름 | " + data.name + "<br>";
                appendEle += "    종류 | " + data.category + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    주요 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle += data.info;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    태그 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-9 tag-info-content'>";
                appendEle += "    <select class='form-control tag-list-select'>";
                filterTag.forEach(function(d){
                  appendEle += "      <option data-kind='" + d.kind + "' data-id='" + d.object_id + "' data-color='" + d.color + "'>" + d.value + "</option>";
                });
                appendEle += "    </select>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-3 tag-info-color'></div>";
                appendEle += "</div>";
              // 사건 정보 출력
              }else if (bgCase == "timetables"){
                var appendEle = "";
                var filterTag = filterSourceData("timetables", bgId);
                //appendEle += data.cha_id + data.name + data.info + data.age + data.gender + data.img_src;
                appendEle += "<div class='col-md-12 basic-info-div background-div'>";
                appendEle += "<input id='bgHidden' type='hidden' data-kind='timetables' data-id='"+bgId+"'>"
                appendEle += "  <div class='col-md-6 basic-cha-img'>";
                //appendEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ data.img_src +"'>";
                appendEle += "    <br><br><span>" + data.event_names + "</span>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-6 basic-cha-info'>";
                appendEle += "    <br>";
                appendEle += "    <span>";
                appendEle += "    이름 | " + data.event_names + "<br>";
                appendEle += "    도구 | " + data.add_items + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    주요 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle +=      data.event_contents;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    태그 정보";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-9 tag-info-content'>";
                appendEle += "    <select class='form-control tag-list-select'>";
                filterTag.forEach(function(d){
                  appendEle += "      <option data-kind='" + d.kind + "' data-id='" + d.object_id + "' data-color='" + d.color + "'>" + d.value + "</option>";
                });
                appendEle += "    </select>";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-3 tag-info-color'></div>";
                appendEle += "</div>";
              // 맵 정보 출력
              }else if (bgCase == "maps"){

              }else{
                alert("미분류 에러로 정보 출력 불가");
              }
              div.empty();
              div.append(appendEle);
              setTagColor();
            },
            error: function (error) {
              alert("오류발생");
            }
        });

        function setTagColor(){
          var color = $(".tag-list-select option:selected").attr("data-color");
          $(".tag-info-color").css("background-color",color);

          $(".tag-list-select").change(function(){
            color = $(".tag-list-select option:selected").attr("data-color");
            $(".tag-info-color").css("background-color",color);
          });
        }
      }
    }

    //**********************************************************************************//
    //                               오른쪽 마우스 액션                                  //
    //**********************************************************************************//
    // 태그 적용 버튼
    var sel;
    $("#applyTag").on('click',function(){applyTag()});

    function applyTag(selection = null){
      var tagColor = $(".tag-list-select option:selected").attr("data-color");
      var tagCase  = $(".tag-list-select option:selected").attr("data-kind");
      var tagId    = $(".tag-list-select option:selected").attr("data-id");

      // alert(tagColor + tagCase + tagId);
      var curSel = selection;
      if(selection == null)
        curSel = window.getSelection();
      // 한글자 이상 선택하였을 경우
      if(curSel.toString().length > 0 && curSel.baseNode.parentNode.id=="editdiv" && tagId != null){
        sel = curSel;
        surroundSelection(tagColor, tagCase, tagId);
      }
    }

    //에디트 박스 클릭시
    $("#editdiv").on("click",function(){
      removeAllContextMenu();
    });

    //에디트 박스 오른쪽 마우스 클릭 시
    $("#editdiv").on("contextmenu",function(event){
      event.preventDefault();
      var curSel = window.getSelection();
      var tagId    = $(".tag-list-select option:selected").attr("data-id");
      // span 태그 충돌 방지
      if(!$(".popTag-menu").is(":visible")){

        removeAddTagMenu();
        if(curSel.toString().length > 0 && curSel.baseNode.parentNode.id=="editdiv" && tagId != null)
        popAddTagMenu(event, curSel);
      }
    });

    $("#editdiv").on("contextmenu",function(event){
      event.preventDefault();
      var curSel = window.getSelection();
      var tagId    = $(".tag-list-select option:selected").attr("data-id");
      // span 태그 충돌 방지
      if(!$(".popTag-menu").is(":visible")){

        removeAddTagMenu();
        if(curSel.toString().length > 0 && curSel.baseNode.parentNode.id=="editdiv" && tagId != null)
        popAddTagMenu(event, curSel);
      }
    });

    var allTagInfos = getTags();
    $('#editdiv').textcomplete([
        { // html
            mentions: getFromTagInfo(allTagInfos,"value"),
            infos:['info_a','info_b','info_a_c'],
            match: /@([^\u0000-\u007f]{2,}|\w{2,}|[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]+)$/,
            search: function (term, callback) {
                callback($.map(this.mentions, function (mention, index) {
                    var mentionString = mention + "<span class='pull-right' data-index='^nst" + index + "^ned' style='background-color:#" + allTagInfos[index].color + "'>TC</span>";
                    return (mention.indexOf(term) === 0 ? mentionString : null)
                }));
            },
            index: 1,
            replace: function (mention) {
                // 적용 정보 data-case, data-id, bg-color
                var start = mention.indexOf("^nst") + 4;
                var end = mention.indexOf("^ned");
                var mentionIndex = mention.substring(start, end);

                var spanIndex = mention.indexOf("<span");
                var mentionString = mention.substring(0,spanIndex);

                var spanAttr = " ";
                spanAttr += " class='tag-span'";
                spanAttr += " data-case='" + allTagInfos[mentionIndex].kind + "'";
                spanAttr += " data-id='" + allTagInfos[mentionIndex].object_id + "'";
                spanAttr += " style=' font-weight:bold; background-color:#" + allTagInfos[mentionIndex].color + ";'";

                return "<span" + spanAttr + ">" + mentionString + '</span>\u200b';
            },
            after: function(){
                setTagSpanEvent();
            }
        }
    ]);

    // 태그 정보로 부터 특정 정보만 추출 value, (color, kind, object_id) 노필요
    function getFromTagInfo(tagInfo, grepCase){
      var grepArr = new Array();

      if(grepCase == "value"){
        for(var i =0; i < tagInfo.length; i++){
          grepArr.push(tagInfo[i].value)
        }
      }
      return grepArr;
    }

    //에디트 박스 엔터
    $('div[contenteditable]').keydown(function(e) {

      if (e.keyCode === 13 && $(".textcomplete-dropdown").css('display') == 'none') {
        document.execCommand('insertHTML', false, '<br><br>');

        return false;
      }
    });
    // 선택한 구분에 태그 적용
    function surroundSelection(tagColor, tagCase, tagId) {
        var span = document.createElement("span");
        span.style.fontWeight = "bold";
        span.style.backgroundColor = tagColor;
        span.className = "tag-span";
        span.contentEditable = "true";

        // span.setAttribute("onmouseover","popChaInfo(\'" + chaName+ "\')");
        // span.setAttribute("onmouseout","removeChaInfo()");
        span.setAttribute("data-color",tagColor);
        span.setAttribute("data-case",tagCase);
        span.setAttribute("data-id",tagId);
            if (sel.rangeCount) {

                var range = sel.getRangeAt(0).cloneRange();
                var startNode = range.startContainer
                var startOffset = range.startOffset;

                var endElement = document.createTextNode("\u200b");
                try {
                    range.surroundContents(span);
                } catch (e) {
                  alert("태그를 중복하여 사용할 수 없습니다.");
                }

                range.collapse(false);
                range.insertNode(endElement);


                sel.removeAllRanges();
                sel.addRange(range);
            }
        setTagSpanEvent();
    }

    // 태그 이벤트 적용
    function setTagSpanEvent(){
      $(".tag-span").off().on("mouseover",function(event){
        var bgCase = $(this).attr("data-case");
        var bgId =$(this).attr("data-id")
        if(!$(".popTag-menu").is(":visible")){
          popBackgroundInfo(event,bgCase,bgId);
        }
      });

      $(".tag-span").on("mouseout",function(event){
        removeChaInfo();
      });

      $(".tag-span").on("contextmenu",function(event){
        event.preventDefault();
        removeAllContextMenu();
        popTagMenu(event,$(this));
      });
    }

    // 태그 마우스 오버 시 정보 출력
    function popBackgroundInfo(event, bgCase, bgId){
      $.ajax({
          type: "get",
          url: "/write_novel/call_background_info",
          async: false,
          data: {
            "bgCase"  : bgCase,
            "bgId"    : bgId
          },
          success: function (data) {
             data = data[0];
             console.log("asd");
             console.log(data);
            var addEle = "";
            switch(bgCase){
              case "characters":
                addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
                addEle += "  <div class='col-md-6 basic-cha-img'>";
                addEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ data.img_src +"'><br>";
                addEle += "    <span>" + data.name + "</span>";
                addEle += "  </div>";
                addEle += "  <div class='col-md-6 basic-cha-info'>";
                addEle += "    <br>";
                addEle += "    <span>";
                addEle += "    이름 | " + data.name + "<br>";
                addEle += "    나이 | " + data.age + "<br>";
                addEle += "    성별 | " + data.gender + "<br>";
                addEle += "    </span>";
                addEle += "  </div>";
                addEle += "</div>";
                //addEle += "<div class=''>asd</div>";
              break;
              case "items":
              addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
              addEle += "  <div class='col-md-6 basic-cha-img'>";
              addEle += "    <img class='img-circle img-things-size' src='/img/background/itemImg/"+ data.img_src +"'><br>";
              addEle += "    <span>" + data.name + "</span>";
              addEle += "  </div>";
              addEle += "  <div class='col-md-6 basic-cha-info'>";
              addEle += "    <br>";
              addEle += "    <span>";
              addEle += "    이름 | " + data.name + "<br>";
              addEle += "    종류 | " + data.category + "<br>";
              addEle += "    </span>";
              addEle += "  </div>";
              addEle += "</div>";
              break;

              case "timetables":
              addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
              addEle += "  <div class='col-md-6 basic-cha-img'>";
              //addEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ data.img_src +"'>";
              addEle += "    <br><span>" + data.event_names + "</span>";
              addEle += "  </div>";
              addEle += "  <div class='col-md-6 basic-cha-info'>";
              addEle += "    <br>";
              addEle += "    <span>";
              addEle += "    이름 | " + data.event_names + "<br>";
              addEle += "    도구 | " + data.add_items + "<br>";
              addEle += "    </span>";
              addEle += "  </div>";
              addEle += "</div>";
              break;
              case "maps":
              break;
            }
            $(addEle).appendTo("body")
                .css({top: event.pageY + "px", left: event.pageX + "px"});
          },
          error:function(){
            alert("no!");
          }
      });
    }

    // 태그 적용 메뉴 오른쪽마우스
    function popTagMenu(event,removeEle){
      //alert("스판 로느쪽");
      $("<div class='pop-menu popTag-menu'><button>태그 제거</button></div>")
          .appendTo("body")
          .css({top: event.pageY + "px", left: event.pageX + "px"});

          $(".popTag-menu").off().on("click",function(){
            removeEle.contents().unwrap();
            removeTagMenu();
          });
    }

    // editDiv 오른쪽 마우스 클릭시 메뉴
    function popAddTagMenu(event, selection = null){
      $("<div class='pop-menu popAddTag-menu'><button>태그 적용</button></div>")
          .appendTo("body")
          .css({top: event.pageY + "px", left: event.pageX + "px"});
      $(".popAddTag-menu > button").on("click", function(){
        applyTag(selection);
        removeAddTagMenu();
      });
    }

    // 태그 마우스 아웃 시 정보 삭제
    function removeChaInfo(){
      $(".popChaInfo-menu").hide();
    }

    // 오른쪽 마우스 태그 메뉴 삭제
    function removeTagMenu(){
      $(".popTag-menu").hide();
    }

    // editDiv 오른쪽 마우스 메뉴 삭제
    function removeAddTagMenu(){
      $(".popAddTag-menu").hide();
    }

    // 모든 contextmenu 삭제
    function removeAllContextMenu(){
      removeChaInfo();
      removeTagMenu();
      removeAddTagMenu();
    }
    // 회차/공지 선택
    $('.set-notice-btn').on("click", function(){
      $(".set-notice-btn").removeClass("selected-notice");
      $(this).addClass("selected-notice");
    });

    // 유.무료 선택
    $('.set-charge-btn').on("click", function(){
      $(".set-charge-btn").removeClass("selected-charge");
      $(this).addClass("selected-charge");
    });

    // 표지 이미지 리스트 슬릭 설정
    $('.center-slick').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });

    // 기존의 표지 이미지 출력
    getCoverImage();
    function getCoverImage(){
      <?php for($i=0; $i < count($tasks['coverImg']); $i++){?>

        var addSlickEle = "";
        addSlickEle += "<div class='image_cell'>";
        addSlickEle += "  <div class='cover-img' data-href={{ $tasks['coverImg'][$i]->cover_img_src }} >";
        addSlickEle += "    <div class='quitBox'>";
        addSlickEle += "      <span id='x'>X</span>";
        addSlickEle += "    </div>";
        addSlickEle += "    <img draggable='false' src={{URL::asset('upload/images')}}/{{ $tasks['coverImg'][$i]->cover_img_src }}";
        addSlickEle += "  </div>";
        addSlickEle += "</div>";
        $(".image_list").slick('slickAdd',addSlickEle);
        $(".image_cell").find(".quitBox").hide();

        // 클릭이벤트
        $(".image_cell").off().on('click',function(){
          $('.image_cell').removeClass("selected-image");
          $(this).addClass("selected-image");
        });

        // 마우스오버 : 삭제버튼 show
        $(".image_cell").on('mouseover',function(){
          $(this).find(".quitBox").show();
        });
        // 마우스아웃 : 삭제버튼 hide
        $(".image_cell").on('mouseout',function(){
          $(this).find(".quitBox").hide();
        });

        // X박스 클릭 : 이미지 삭제
        $(".image_cell").find(".quitBox").off().on("click",function(){
          var imageCell = $(this).parent().parent();

          var coverImg = $(this).parent();
          var index = imageCell.attr("data-slick-index");

          coverImg.animate({
            opacity:0.25,
            width:"0",
            height:"0",
            top:"50%"
          }, 500, function(){
            $(".image_list").slick('slickRemove',index);
            $(".image_list").slick('slickAdd',"");
          });

          // DB처리
          $.ajax({
              type: "get",
              url: "/write_novel/removeEpisodeCover",
              data: {
                "novelId" : {{$tasks["novelId"]}},
                "removeFile" : coverImg.attr("data-href")
              },
              success: function (data) {
                console.log(data);
              },
              error: function (error) {
                alert("오류발생");
              }
          });
        });
      <?php } ?>
    }

    // 커버 이미지 업로드 이벤트
    $("#imgFile").change(function () {
        // 파일이 있을경우
        if (this.files && this.files[0]) {

            // ajax로 DB추가
            var input = $("#imgFile");
            var formData = new FormData();
            formData.append("imgFile",$("#imgFile")[0].files[0]);
            formData.append("novelId",{{$tasks["novelId"]}});
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url: "/write_novel/addEpisodeCover",
              type: "post",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data){
                  //슬릭 생성
                  var addSlickEle = "";
                  addSlickEle += "<div class='image_cell'>";
                  addSlickEle += "  <div class='cover-img' data-href="+data+">";
                  addSlickEle += "    <div class='quitBox'>";
                  addSlickEle += "      <span id='x'>X</span>";
                  addSlickEle += "    </div>";
                  addSlickEle += "    <img draggable='false' src={{URL::asset('upload/images')}}/"+data+">";
                  addSlickEle += "  </div>";
                  addSlickEle += "</div>";
                  $(".image_list").slick('slickAdd',addSlickEle);
                  $(".image_cell").find(".quitBox").hide();

                  // 클릭이벤트
                  $(".image_cell").off().on('click',function(){
                    $('.image_cell').removeClass("selected-image");
                    $(this).addClass("selected-image");
                  });

                  // 마우스오버 : 삭제버튼 show
                  $(".image_cell").on('mouseover',function(){
                    $(this).find(".quitBox").show();
                  });
                  // 마우스아웃 : 삭제버튼 hide
                  $(".image_cell").on('mouseout',function(){
                    $(this).find(".quitBox").hide();
                  });

                  // X박스 클릭 : 이미지 삭제
                  $(".image_cell").find(".quitBox").off().on("click",function(){
                    var imageCell = $(this).parent().parent();

                    var coverImg = $(this).parent();
                    var index = imageCell.attr("data-slick-index");

                    coverImg.animate({
                      opacity:0.25,
                      width:"0",
                      height:"0",
                      top:"50%"
                    }, 500, function(){
                      $(".image_list").slick('slickRemove',index);
                      $(".image_list").slick('slickAdd',"");
                    });

                    // DB처리
                    $.ajax({
                        type: "get",
                        url: "removeEpisodeCover",
                        data: {
                          "novelId" : {{$tasks["novelId"]}},
                          "removeFile" : coverImg.attr("data-href")
                        },
                        success: function (data) {
                          console.log(data);
                        },
                        error: function (error) {
                          alert("오류발생");
                        }
                    });

                  });

              }
            });
        }
    });

    // 취소 버튼
    $(".episode-cancel").on("click",function(){
      history.go(-1);
    });


    $('.episode-editor-div').on('paste', function (e) {
      var pasteData = e.originalEvent.clipboardData.getData('text');

      e.preventDefault();
      pasteData = pasteData.replace(/(?:\r\n|\r|\n)/g, '<br />');
      //e.originalEvent.clipboardData.setData('text/plain', pasteData);

      pasteHtmlAtCaret(pasteData);
    });
    function pasteHtmlAtCaret(html) {
      var sel, range;
      if (window.getSelection) {
          // IE9 and non-IE
          sel = window.getSelection();
          if (sel.getRangeAt && sel.rangeCount) {
              range = sel.getRangeAt(0);
              range.deleteContents();

              // Range.createContextualFragment() would be useful here but is
              // non-standard and not supported in all browsers (IE9, for one)
              var el = document.createElement("div");
              el.innerHTML = html;
              var frag = document.createDocumentFragment(), node, lastNode;
              while ( (node = el.firstChild) ) {
                  lastNode = frag.appendChild(node);
              }
              range.insertNode(frag);

              // Preserve the selection
              if (lastNode) {
                  range = range.cloneRange();
                  range.setStartAfter(lastNode);
                  range.collapse(true);
                  sel.removeAllRanges();
                  sel.addRange(range);
              }
          }
      } else if (document.selection && document.selection.type != "Control") {
          // IE < 9
          document.selection.createRange().pasteHTML(html);
      }
    }


    // 저장 버튼
    $(".episode-save").on("click",function(){
      // 소설 정보 변수화
      var novelId  = {{ $tasks['novelId']}};
      var isNotice = $(".selected-notice").attr("data-notice")=="notice" ? 1 : 0 ;
      var isCharge = $(".selected-charge").attr("data-charge")=="charge" ? 1 : 0;
      var coverImg = $(".selected-image").find(".cover-img").attr("data-href");
      var title    = $("#episode-title").val();
      var episode  = $(".episode-editor-div").html();
      var postScript = $(".writers-postscript-div").html();


      // ajax 소설 저장 요청
      createEpisode(novelId, isNotice, isCharge, coverImg, title, episode, postScript);
      // 마이페이지 - 소설 목록 페이지 이동


    });

    // DB 소설 생성
    function createEpisode(novelId, isNotice, isCharge, coverImg, title, episode, postScript){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          type: "post",
          url: "/write_novel/create_episode",
          data: {
            "novelId"  : novelId,
            "isNotice" : isNotice,
            "isCharge" : isCharge,
            "coverImg" : coverImg,
            "title"    : title,
            "episode"  : episode,
            "postScript": postScript
          },
          success: function (data) {
            alert("소설이 생성되었습니다!");
            location.href ="/write_novel/my_novel";
          },
          error: function (error) {
            alert("오류발생");
          }
      });
    }

    // background 모달 이벤트
    setBackgroundModal()
    function setBackgroundModal(){
      var modal = document.getElementById('bgModal');
      var btn = document.getElementById("bgBtn");
      var span = document.getElementsByClassName("bgClose")[0];

      btn.onclick = function() {

        var bgKind = $("#bgHidden").attr("data-kind");
        var bgId = $("#bgHidden").attr("data-id");
        if(bgKind != null && bgId !=null){
          modal.style.display = "block";
          $(".case-btn").removeClass("active");
          $(".case-btn").addClass("notActive");

          setModalContent(bgKind,bgId);
        } else {
          alert("먼저 태그를 선택해 주세요.");
        }
      }

      span.onclick = function() {
          modal.style.display = "none";
      }

      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }

    }

    // 모달 컨텐츠 변경


    function setModalContent(bgCase, bgId){

      removeModalContent();
      switch(bgCase){
        case "characters" :
        setModalCharacters(bgId);
        break;
        case "items" :
        setModalItems(bgId);
        break;
        case "maps" :
        setModalMaps(bgId);
        break;
        case "timetables" :
        setModalTimetables(bgId);
        break;
        default:
        alert("error occured");


      }

      var topModal = $(".bg-modal-top");
      var middleModal = $(".bg-modal-middle");
      var bottomModal = $(".bg-modal-bottom");
      function removeModalContent(){
          $(".bg-modal-top").empty();
          $(".bg-modal-middle").empty();
          $(".bg-modal-bottom").empty();
      }

      // 캐릭터 상세 정보 출력
      function setModalCharacters(bgId){
        var chaData = callBackgroundInfo("characters",bgId)[0];
        var tagData = callTagInfo("characters",bgId);
        var ttData = callTimetablesInfo("characters",bgId);
        var relData = callRelationInfo(bgId);
        var ownerData = callOwnershipInfo(bgId);
        console.log(tagData);
        var referInfo = chaData.refer_info;
        referInfo = referInfo.split("^");
        // 상위 정보
        var topEle = "";

        topEle += "<div class='bg-div bg-img-div col-md-3'>"
        topEle += "  <img src='/img/background/characterImg/" + chaData.img_src+ "'  class='img-circle cha-img-size'><br>"
        topEle += "  <span>"+chaData.name+"</span>"
        topEle += "</div>"

        topEle += "<div class='bg-div bg-basic-div col-md-9'>"

        topEle += "  <div class='bg-div bg-cha-info col-md-6'>"
        topEle += "    <span>이름</span> | "+chaData.name+"<br>"
        topEle += "    <span>성별</span> | "+chaData.gender+"<br>"
        topEle += "    <span>나이</span> | "+chaData.age+"<br>"
        topEle += "    <span>설명</span> | "+chaData.info
        topEle += "  </div>"

        topEle += "  <div class='bg-div bg-refer-div col-md-6'>"
        topEle += "    <span>추가 정보</span>"
        topEle += "    <div class='refer-info'>"
        referInfo.forEach(function(ri){
            topEle += "<div>"+ri+"</div>";
        });

        topEle += "    </div>"
        topEle += "    <span>태그 정보</span>"
        topEle += "    <div class='tag-info'>"
        tagData.forEach(function(td){
            topEle += "<div>"+td.value+"<div class='tag-color-box'>TC</div></div>";
        });
        topEle += "    </div>"
        topEle += "  </div>"
        topEle += "</div>"

        $(".bg-modal-top").append(topEle);

        // 중간 정보
        var middleEle ="";
        middleEle += "<div class='row col-md-12' id='timeline' ></div><br>";

        $(".bg-modal-middle").append(middleEle);
        console.log(ttData);
        if(ttData.length > 0)
          ready(timetableConvert(ttData));

        // 하위 정보
        var bottomEle = "";
        bottomEle += "<div class='col-md-6 bg-div relation-div'>";
        if(relData.length > 0)
        relData.forEach(function(rd){
          var sourceInfo = callBackgroundInfo("characters",rd.target)[0];
          var targetInfo = callBackgroundInfo("characters",rd.source)[0];
          bottomEle += "  <div class='relation-list'>";
          bottomEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ sourceInfo.img_src +"'>";
          bottomEle += "    <span>" + rd.relationship + "</span>";
          bottomEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ targetInfo.img_src +"'>";
          bottomEle += "  </div>";
        });
        bottomEle += "</div>";
        bottomEle += "<div class='col-md-6 bg-div ownership-div'>";
        console.log(ownerData);
        if(ownerData.length > 0)
        ownerData.forEach(function(od){
          var itemInfo = callBackgroundInfo("items",od.item_id)[0];
          bottomEle += "  <div class='ownership-list'>";
          bottomEle += "    <img class='img-circle img-things-size' src='/img/background/itemImg/"+ itemInfo.img_src +"'>&nbsp;&nbsp;";
          bottomEle += "    <span>" + itemInfo.name + "</span>";
          bottomEle += "  </div>";
        });
        bottomEle += "</div>";
        $(".bg-modal-bottom").append(bottomEle);
      }

      // 사물 상세 정보 출력
      function setModalItems(bgId){
      }
      // 맵 상세 정보 출력
      function setModalMaps(bgId){
      }
      // 사건 상세 정보 출력
      function setModalTimetables(bgId){
      }

      // 케이스, 아이디로 해당 배경정보 호출
      function callBackgroundInfo(bgCase, bgId){
        var bgData;
        $.ajax({
            type: "get",
            url: "/write_novel/call_background_info",
            async: false,
            data: {
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              bgData = data;
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        return bgData;
      }
      // 케이스, 아이디로 해당 태그 호출
      function callTagInfo(bgCase, bgId){
        var bgData;
        $.ajax({
            type: "get",
            url: "/write_novel/get_tag_by_id",
            async: false,
            data: {
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              bgData = data;
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        return bgData;
      }
      // 타임테이블 정보 호출
      function callTimetablesInfo(bgCase=null, bgId=null){
        var timetablesInfo;
        $.ajax({
            type: "get",
            url: "/write_novel/get_timetables_info",
            async: false,
            data: {
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              timetablesInfo = data;
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        return timetablesInfo;
      }
      // 타임테이블 배열을 표형 데이터로 반환
      function timetableConvert(data){
        var tableData = new Array();
        data.forEach(function(td){
          var cData = {
            "event_name"    : td.event_names,
            "start_day"     : td.start_days,
            "end_day"       : td.end_days
          };
          tableData.push(cData);
        });
        return tableData;
      }
      // 캐릭터 아이디로 관계를 호출
      function callRelationInfo(chaId){
        var bgData;
        $.ajax({
            type: "get",
            url: "/write_novel/call_relation_info",
            async: false,
            data: {
              "chaId"    : chaId
            },
            success: function (data) {
              bgData = data;
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        return bgData;
      }
      // 캐릭터 아이디로 소유물건을 호출
      function callOwnershipInfo(chaId){
        var bgData;
        $.ajax({
            type: "get",
            url: "/write_novel/call_ownership_info",
            async: false,
            data: {
              "chaId"    : chaId
            },
            success: function (data) {
              bgData = data;
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        return bgData;
      }


    }
  })(jQuery);


</script>
@endsection
