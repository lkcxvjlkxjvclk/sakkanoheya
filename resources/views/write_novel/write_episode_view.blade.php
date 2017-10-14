fvcc<div class="default-padding"></div>
@extends('layouts.master')


@section('content')
  <script src="{{URL::asset('js/jquery.textcomplete.js')}}"></script>

  <style>
    .sticky {
      position: fixed;
      top:0;
      z-index: 100;
      border-top: 0;
    }
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

    .cover-div {
      padding-bottom: 0px;
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

    #coverHideBtn {
      display: inline-block;
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


    .timetable-div {

      z-index: 10;
      background-color: #D4F4FA;
      border:#EAEAEA 2px solid;
      padding: 0px;
      padding-top: 10px;
    }

    .timetable-content-div {
      height: 190px;
    }

    .timetable-btn-div {
      padding: 0px;
      text-align: center;
      padding-bottom: 10px;

    }

    .timetable-btn-ul {
      padding : 0px;
      margin:0px;
    }

    .timetable-btn-li {
      font-size:16px;
      font-weight:bold;
    }

    .edit-box {
      border:#EAEAEA 2px solid;
      margin-bottom: 10px;
      overflow-y: scroll;
      padding-left: 5px;
    }
    .edit-div {
      z-index: 0;
      padding: 0;
      padding-bottom: 10px;
      height:1000px;
      font-size:20px;
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
      width:250px;
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


    }

    .basic-cha-span {
      display:inline-block;
      vertical-align: middle;
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

  .window-div{

  }
  .window-header {
    background-color: #EAEAEA;
    vertical-align:middle;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    padding-right: 0px;
    padding-left: 2px;
  }
  .window-content{
    padding: 0px;
  }
  .window-header-clear{
    text-align: right;
    padding-right: 0px;
  }
  .window-clear-icon{
    font-size:33px;
  }

  /* 사건 테이블 css*/
  .table-div{
    padding:0px;
    overflow-y: scroll;
  }
  .timetable-info-table {
    padding-left: 10px;
    table-layout: fixed;
    word-break:break-all;
  }
  .timetable-info-table > tr {
    height:100px;
  }
  .timetable-info-tr {
    height:40px;
  }
  .timetable-info-table > td {
    word-break:break-all;
  }

  .window-attr-div {
    padding: 0px;
    text-align: center;
    font-size: 18px;
    font-weight:bold;
    background-color: #B2EBF4;
  }

  .selected-attr {
    background-color: #5CD1E5;
  }

  .subject-td {
    text-align: center;
    font-weight: bold;
    background-color: #FAECC5;

  }

  .content-td {
    padding-left: 5px;
    padding-right: 5px;
  }

  .attr-content-div {
    word-break:break-all;
    padding:0px;
    max-height:300px;
    overflow-y: scroll;
  }

  .attr-content {
    padding:0px;
  }

  .cha-info-div {
    margin: 0px;
    margin-top: 5px;
    text-align: center;
  }
  .rellist-info-div {
    background-color:#EAEAEA;
    margin: 0px;
    padding:0px;
    text-align: center;
  }

  .cha-img-div {
    font-weight: bold;
    padding-left: 5px;
    padding-right: 5px;
  }
  .cha-effect-div {
    padding:0px;
    display:table;
    text-align: left;
    height:90px;
  }
  .cha-effect-content {
    display:table-cell;
    vertical-align: middle;
  }

  .rel-effect-div{
    padding:0px;
    display:table;
    text-align: center;
    height:90px;
    font-weight:bold;
  }

  #mouse-cursor-div {
    display:none;
    pointer-events: none;
    z-index:1000;
    width:30px;
    height:30px;
    position:absolute;
    margin-top: -30px;
    margin-left: -30px;
    left:500px;
    top:500px;
  }
  #mouse-cursor-color {
    width:8px;
    height:8px;
    background-color: blue;
  }

  .ready-img-div{
    position:absolute;
    z-index:1000;
  }

  .bgInfo-window-div{
    position:absolute;
  }
  </style>


  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="write_novel_set">
    <div class="container">
      <div class="row set_row">
        <div class="col-md-12 main_title">小説作成</div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <span class="menu_title">タイトル</span>
          <span class="novel-title">{{ $tasks['novelTitle'] }}</span>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <label class="set-notice-btn selected-notice" data-notice="episode">エピソード</label>
          <label class="set-notice-btn" data-notice="notice">お知らせ</label>
          <label class="set-charge-btn selected-charge" data-charge="free">無料</label>
          <label class="set-charge-btn" data-charge="charge">有料</label>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <span class="menu_title">タイトル</span>
          <input id="episode-title" class="menu_input" type="text" placeholder="タイトルを入力してください。" size=50>
        </div>
      </div>

      <div class="row set_row cover-div">
        <div class="col-md-9 menu_title">カバーイメージ
        </div>

        <div class="col-md-3">
          <div class="col-md-10">
            <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
              <label class="img_upload_label">イメージ登録
                <input class="img_upload_btn" id="imgFile" name="imgFile" type='file'>
              </label>
            </form>
          </div>
          <div class="col-md-2">
              <p type="button" name="button" id='coverHideBtn' data-toggle='on'><i class="coverHideBtn material-icons" style='font-size:40px;'>&#xE313;</i></p>
          </div>
        </div>
      </div>

      <div class="row set_row image_list_box">
        <div class="image_list center-slick" data-href="{{URL::to('upload/images')}}">
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12 menu_title">内容<i class='material-icons pull-right' data-toggle='on' id='helperHideBtn' style='font-size:40px;'>&#xE316;</i></div>
      </div>
      <div class="timetable-div col-md-12">
        <div class="col-md-12 timetable-content-div" id='timeline'>
        No Timetable Data
        </div>

        <div class="col-md-12 timetable-btn-div">
          <ul class="pager timetable-btn-ul">
          </ul>
        </div>
      </div>

      <div class="col-md-12 edit-div">

        <div id="editdiv" class="col-md-12 edit-box episode-editor-div" contenteditable="true">
          episode content



        </div>
      </div>
      <div class="edit-box writers-postscript-div" contenteditable="true">
        writers postscript
      </div>

      <div class="row set_row">
        <div class="col-md-6 btn_div"><div class="func_btn episode-cancel">キャンセル</div></div>
        <div class="col-md-6 btn_div"><div class="func_btn episode-save">登録</div></div>
      </div>

    </div>
  </div>
  <div id='mouse-cursor-div'>
    <div id="mouse-cursor-color">
    </div>
  <i class="material-icons">&#xE243;</i></div>

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
              "novelId" : {{$tasks["novelId"]}},
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              data = data[0];
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
                appendEle += "    名前 | " + data.name + "<br>";
                appendEle += "    年齢 | " + data.age + "<br>";
                appendEle += "    性別 | " + data.gender + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    主な情報";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle += data.info;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    タグ情報";
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
                appendEle += "    名前 | " + data.name + "<br>";
                appendEle += "    種類 | " + data.category + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    主な情報";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle += data.info;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    タグ情報";
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
                appendEle += "    名前 | " + data.event_names + "<br>";
                appendEle += "    道具 | " + data.add_items + "<br>";
                appendEle += "    </span>";
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 info-div background-div'>";
                appendEle += "  <div class='col-md-12 info-header'>";
                appendEle += "    主な情報";
                appendEle += "  </div>";
                appendEle += "  <div class='col-md-12 info-content'>";
                appendEle +=      data.event_contents;
                appendEle += "  </div>";
                appendEle += "</div>";

                appendEle += "<div class='col-md-12 tag-info-div'>";
                appendEle += "  <div class='col-md-12 tag-info-header'>";
                appendEle += "    タグ情報";
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
      $(".tag-span").off().on("mouseenter",function(event){
        var bgCase = $(this).attr("data-case");
        var bgId =$(this).attr("data-id");
        var popMenu = $("." + bgCase + "-" +bgId + "-" +"pop");
        if(!$(".popTag-menu").is(":visible") && tagPaintCursor == false){
          // 팝 메뉴가 이미 존재할 경우
          if(popMenu.length > 0){
            popMenu.show();
            popMenu.offset({ top: event.pageY, left: event.pageX})


          } else {
            popBackgroundInfo(event,bgCase,bgId);
          }

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
            "novelId" : {{$tasks["novelId"]}},
            "bgCase"  : bgCase,
            "bgId"    : bgId
          },
          success: function (data) {
             data = data[0];

             console.log(data);
            var addEle = "";
            switch(bgCase){
              case "characters":
                addEle += "<div class='basic-info-div pop-menu popChaInfo-menu "+bgCase+"-"+bgId+"-"+"pop'>";
                addEle += "  <div class='col-md-4 basic-cha-img'>";
                addEle += "    <img class='img-circle img-things-size' src='/img/background/characterImg/"+ data.img_src +"'><br>";
                addEle += "    <span style='font-weight:bold;'>" + data.name + "</span>";
                addEle += "  </div>";
                addEle += "  <div class='col-md-8 basic-cha-info'>";
                addEle += "    <br>";
                addEle += "    <span>";
                addEle += "    名前 | " + data.name + "<br>";
                addEle += "    年齢 | " + data.age + "<br>";
                addEle += "    性別 | " + data.gender + "<br>";
                addEle += "    </span>";
                addEle += "  </div>";
                addEle += "</div>";

              break;
              case "items":
              addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
              addEle += "  <div class='col-md-4 basic-cha-img'>";
              addEle += "    <img class='img-circle img-things-size' src='/img/background/itemImg/"+ data.img_src +"'><br>";
              addEle += "    <span style='font-weight:bold;'>" + data.name + "</span>";
              addEle += "  </div>";
              addEle += "  <div class='col-md-8 basic-cha-info'>";
              addEle += "    <br>";
              addEle += "    <span>";
              addEle += "    名前 | " + data.name + "<br>";
              addEle += "    種類 | " + data.category + "<br>";
              addEle += "    </span>";
              addEle += "  </div>";
              addEle += "</div>";
              break;

              case "relations":
              addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
              addEle += "  <div class='col-md-4 basic-cha-img'>";
              addEle += "    <img class='img-circle img-things-size' src='/img/background/relationImg/"+ data.cover_src +"'>";
              addEle += "    <br><span style='font-weight:bold;'>" + data.title + "</span>";
              addEle += "  </div>";
              addEle += "  <div class='col-md-8 basic-cha-info'>";
              addEle += "    <span class='basic-cha-span'><br><br>";
              addEle += "    タイトル | " + data.title;
              addEle += "    </span>";
              addEle += "  </div>";
              addEle += "</div>";
              break;
              case "maps":
              addEle += "<div class='basic-info-div pop-menu popChaInfo-menu'>";
              addEle += "  <div class='col-md-4 basic-cha-img'>";
              addEle += "    <img class='img-circle img-things-size' src='/img/background/mapImg/mapCover/"+ data.cover_src +"'>";
              addEle += "    <br><span style='font-weight:bold;'>" + data.title + "</span>";
              addEle += "  </div>";
              addEle += "  <div class='col-md-8 basic-cha-info'>";
              addEle += "    <span class='basic-cha-span'><br><br>";
              addEle += "    タイトル | " + data.title;
              addEle += "    </span>";
              addEle += "  </div>";
              addEle += "</div>";
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
            alert("小説を登録しました！");
            location.href ="/write_novel/my_novel";
          },
          error: function (error) {
            alert("ERROR");
          }
      });
    }

    // 헬퍼툴 연대표 호출
    getTimetableHelper()
    // 핼퍼툴의 연대표 호출
    function getTimetableHelper(){
      var ttData = callTimetablesInfo();
      console.log(ttData);
      if(ttData.length > 0){
        ready(timetableConvert(ttData));
        setTimetableBtn(ttData);
      }

        function setTimetableBtn(ttData){
          ttData.forEach(function(fd){
            console.log(fd);
            $(".timetable-btn-ul").append(" <li><a class='timetable-btn-li' href='#' data-id='" + fd.background_id + "'>" + fd.event_names+ "</a></li> ");
          })
          setTImetableBtnEvent()
          function setTImetableBtnEvent(){
            $(".timetable-btn-li").off().on("click",function(e){
              e.preventDefault();
              var editorOffset = $(".edit-box").offset();
              var btnOffset = $(this).offset();
              var id = $(this).attr("data-id");
              var eleId = "timetablesWin" + id
              var width = 300;
              var height = 200;
              var bgCase = "timetables";
              if( $("#" + eleId).length < 1 ){
                if(popWindow(width,height,btnOffset.left - width/2 + 20,editorOffset.top,"cl",eleId)){
                  setWindowContent(eleId, bgCase, id);
                }
              } else {
                if( $("#" + eleId).css('display') == 'none' ) $("#" + eleId).show();
                else $("#" + eleId).hide();
              }

            });
          }


        }
    }

    // 윈도우 띄우기
    // 길이, 높이, X, Y, 클래스, 아이디
    var zindex = 100;
    // 이동시 false, 생성시 true
    function popWindow(width, height, winX, winY, winCl, winId){
      //해당 윈도우가 이미 존재할 경우
      var curEle = $("#" + winId);
      if( curEle.length > 0){
        curEle.offset({top:winY, left:winX});
        return false;
      } else {
        var eleStr = "<div id='" + winId + "' class='draggable-window "+ winCl +"'></div>";
        var appendedEle = $(eleStr).appendTo("body")
                 .css({top: winY + "px", left: winX + "px"})
                 .css('z-index', ++zindex)
                 .css('position', 'absolute')
                 .css('border', "2px solid black")
                 .css('background-color', 'white')
                 .css('width', width + "px")
                 .css('min-height', height + "px");
        appendedEle.draggable({handle:'.window-header, .table-div, .timetable-window-attr-div'});
        appendedEle.on('mousedown', function(){
          $(this).css("z-index", ++zindex);
        })
        appendedEle.resizable({
          resize:function(event,ui){
            console.log(event);
            console.log(ui);
            console.log(ui.originalSize);
          }
        })
        return true;
      }
    }

    // 해당 윈도우의 컨텐츠를 만듦
    function setWindowContent(eleId, bgCase, bgId){
      switch(bgCase){
        case "characters" :
        setWindowCharacters(bgId);
        break;
        case "items" :
        setWindowItems(bgId);
        break;
        case "relations" :
        setWindowRelations(bgId);
        break;
        case "maps" :
        setWindowMaps(bgId);
        break;
        case "timetables" :
        setWindowTimetables(bgId);
        break;
        default:
        alert("error occured");
      }
      // 사건 컨텐츠
      function setWindowTimetables(){
        var winEle = $("#" + eleId);
        var addEle = "";

        $.ajax({
            type: "get",
            url: "/write_novel/call_background_info",
            async: false,
            data: {
              "novelId" : {{$tasks["novelId"]}},
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              console.log(data);
              data = data[0];

              addEle += "<div class='window-div'>"
              addEle += "  <div class='col-md-12 window-header'>"
              addEle += "   <div class='col-md-10 window-header-text'>"
              addEle += "    事件-" + data.event_names;
              addEle += "   </div>"
              addEle += "   <div class='col-md-2 window-header-clear' >"
              addEle += "     <i class='pull-right material-icons window-clear-icon' data-case='timetables' data-id='" + data.background_id +"'>clear</i>"
              addEle += "   </div>"
              addEle += "  </div>"
              addEle += "  <div class='col-md-12 window-content'>"
              addEle += "   <div class='col-md-12 table-div'>"
              addEle += "    <table class='timetable-info-table'>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td width='30%' class='subject-td'>事件名</td>"
              addEle += "        <td width='70%' class='content-td'>" + data.event_names + "</td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>事件説明</td>"
              addEle += "        <td class='content-td'>" + data.event_contents + "</td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>追加説明</td>"
              addEle += "        <td class='content-td'>"
              data.refer_info.split("^").forEach(function(ri){
                addEle += ri + "<br>";
              });
              addEle += "         </td>";
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>事件開始日</td>"
              addEle += "        <td class='content-td'>" + data.start_days + "</td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>事件終了日</td>"
              addEle += "        <td class='content-td'>" + data.end_days + "</td>"
              addEle += "      </tr>"
              addEle += "    </table>"
              addEle += "   </div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='characters' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-3 window-attr-div'>人物</div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='items' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-3 window-attr-div'>事物</div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='relations' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-3 window-attr-div'>関係</div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='maps' class='"+bgCase+"-window-attr-div attr-div-"  + bgCase + "-" + data.background_id + " col-md-3 window-attr-div'>地図</div>"
              addEle += "  </div>"
              addEle += "  <div class='col-md-12 attr-content-div'>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-characters-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-items-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-relations-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-maps-div-" + bgCase + "-" + data.background_id + "'></div>"

              addEle += "  </div>"
              addEle += "</div>"

              winEle.append(addEle)
              // 인물,사물,관계,지도 컨텐츠 감춤
              $(".attr-content-" + data.id).hide();

              // 닫기버튼 이벤트
              setClearBtnEvent();
              // 인물,사물,관계,지도 버튼
              setAttrBtnEvent();
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        function setClearBtnEvent(){
          $(".window-clear-icon").off().on("click",function(){
            var bgId = $(this).attr("data-id");
            var bgCase = $(this).attr("data-case");
            $("#" + bgCase +"Win" + bgId).hide();
          });
        }

        function setAttrBtnEvent(){
          $(".timetables-window-attr-div").off().on("mouseover",function(){
            $(this).css("background-color","#5CD1E5");
          })

          $(".timetables-window-attr-div").on("mouseout",function(){
            if(!$(this).hasClass("selected-attr"))
              $(this).css("background-color","#B2EBF4");
          })

          $(".timetables-window-attr-div").on("click",function(){
            var attr = $(this).attr("data-attr");
            var bgCase = $(this).attr("data-case");
            var timeTableId = $(this).attr("data-timetable-id");
            var attrDiv = $(".attr-" + attr + "-div-" + bgCase + "-" + timeTableId);
            var sameEle = $(".attr-div-"  + bgCase + "-" + timeTableId)

            console.log(".attr-" + attr + "-div-"  + bgCase + "-" + timeTableId);
            if(!attrDiv.hasClass("hasCalled"))
              setAffectInfo(timeTableId, attr ,attrDiv);


            // check : selected == false
            if(!$(this).hasClass("selected-attr")){
              // 모든 div select 속성 제거
              sameEle.removeClass("selected-attr");
              sameEle.css("background-color","#B2EBF4");
              // 현재 div select 속성 추가
              $(this).addClass("selected-attr");
              $(this).css("background-color","#5CD1E5");
              // 모든 attr-div 숨김
              $(".attr-content-"  + bgCase + "-" + timeTableId).hide();
              // 현재 attr-div 보임
              attrDiv.show();

            // check : selected == true
            } else {
              // 모든 div select 속성 제거
              sameEle.removeClass("selected-attr");
              sameEle.css("background-color","#B2EBF4");
              // 모든 attr-div 숨김
              $(".attr-content-"  + bgCase + "-" + timeTableId).hide()   ;
            }

          })
        }
      }
      function setWindowCharacters(){
        var winEle = $("#" + eleId);
        var addEle = "";

        $.ajax({
            type: "get",
            url: "/write_novel/call_background_info",
            async: false,
            data: {
              "novelId" : {{$tasks["novelId"]}},
              "bgCase"  : bgCase,
              "bgId"    : bgId
            },
            success: function (data) {
              console.log(data);
              data = data[0];
              var imgRoot = "/img/background/characterImg/";

              addEle += "<div class='window-div'>"
              addEle += "  <div class='col-md-12 window-header'>"
              addEle += "   <div class='col-md-10 window-header-text'>"
              addEle += "    人物-" + data.name;
              addEle += "   </div>"
              addEle += "   <div class='col-md-2 window-header-clear' >"
              addEle += "     <i class='pull-right material-icons window-clear-icon' data-case='" + bgCase +"' data-id='" + data.background_id +"'>clear</i>"
              addEle += "   </div>"
              addEle += "  </div>"
              addEle += "  <div class='col-md-12 window-content'>"
              addEle += "   <div class='col-md-12 table-div'>"
              addEle += "    <table class='timetable-info-table'>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td width='30%' class='subject-td'>人物</td>"
              addEle += "        <td width='70%' class='content-td'><img class='img-circle img-things-size' src='" + imgRoot + data.img_src + "'>  <b>" + data.name + "</b></td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>情報</td>"
              addEle += "        <td class='content-td'>" + data.info + "</td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>年/性別</td>"
              addEle += "        <td class='content-td'>" + data.age + " / "+data.gender + "</td>"
              addEle += "      </tr>"
              addEle += "      <tr class='timetable-info-tr'>"
              addEle += "        <td class='subject-td'>追加説明</td>"
              addEle += "        <td class='content-td'>"
              data.refer_info.split("^").forEach(function(ri){
                addEle += ri + "<br>";
              });
              addEle += "         </td>";
              addEle += "      </tr>"
              addEle += "    </table>"
              addEle += "   </div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='own-items' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-4 window-attr-div'>所有事物</div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='belong-relations' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-4 window-attr-div'>参加関係</div>"
              addEle += "     <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' data-attr='belong-timetables' class='"+bgCase+"-window-attr-div attr-div-" + bgCase + "-" + data.background_id + " col-md-4 window-attr-div'>参加事件</div>"
              addEle += "  </div>"
              addEle += "  <div class='col-md-12 attr-content-div'>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-own-items-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-belong-relations-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "   <div data-case='"+bgCase+"' data-timetable-id='"+data.background_id+"' class='col-md-12 attr-content attr-content-" + bgCase + "-" + data.background_id + " attr-belong-timetables-div-" + bgCase + "-" + data.background_id + "'></div>"
              addEle += "  </div>"
              addEle += "</div>"

              winEle.append(addEle)
              // 인물,사물,관계,지도 컨텐츠 감춤
              $(".attr-content-" + data.id).hide();

              // 닫기버튼 이벤트
              setClearBtnEvent();
              // 인물,사물,관계,지도 버튼
              setAttrBtnEvent();
            },
            error: function (error) {
              alert("오류발생");
            }
        });
        function setClearBtnEvent(){
          $(".window-clear-icon").off().on("click",function(){
            var bgId = $(this).attr("data-id");
            var bgCase = $(this).attr("data-case");
            $("#" + bgCase +"Win" + bgId).hide();
          });
        }

        function setAttrBtnEvent(){
          $("."+bgCase+"-window-attr-div").off().on("mouseover",function(){
            $(this).css("background-color","#5CD1E5");
          })

          $("."+bgCase+"-window-attr-div").on("mouseout",function(){
            if(!$(this).hasClass("selected-attr"))
              $(this).css("background-color","#B2EBF4");
          })

          $("."+bgCase+"-window-attr-div").on("click",function(){
            var attr = $(this).attr("data-attr");
            var bgCase = $(this).attr("data-case");
            var timeTableId = $(this).attr("data-timetable-id");
            var attrDiv = $(".attr-" + attr + "-div-" + bgCase + "-" + timeTableId);
            var sameEle = $(".attr-div-" + bgCase + "-" + timeTableId)

            console.log(".attr-" + attr + "-div-" + bgCase + "-" + timeTableId);
            console.log(".attr-belong-relations-characters-1")
            // 각 대상별 다른 부분 ********************************************************
            if(!attrDiv.hasClass("hasCalled"))
              setCharacterAffectInfo(bgCase, timeTableId, attr, attrDiv);
            //***************************************************************************

            // check : selected == false
            if(!$(this).hasClass("selected-attr")){
              // 모든 div select 속성 제거
              sameEle.removeClass("selected-attr");
              sameEle.css("background-color","#B2EBF4");
              // 현재 div select 속성 추가
              $(this).addClass("selected-attr");
              $(this).css("background-color","#5CD1E5");
              // 모든 attr-div 숨김
              $(".attr-content-" + bgCase + "-" + timeTableId).hide();
              // 현재 attr-div 보임
              attrDiv.show();

            // check : selected == true
            } else {
              // 모든 div select 속성 제거
              sameEle.removeClass("selected-attr");
              sameEle.css("background-color","#B2EBF4");
              // 모든 attr-div 숨김
              $(".attr-content-" + bgCase + "-" + timeTableId).hide()   ;
            }


            function setCharacterAffectInfo(bgCase, bgId, attr, setDiv){
              switch(attr){
                case "own-items" :
                  setOwnItemsInfo();
                  break;
                case "belong-relations" :
                  setBelongRelationsInfo();
                  break;
                case "belong-timetables" :
                  setBelongTimetablesInfo();
                  break;
              }
              function setOwnItemsInfo(){
                $.ajax({
                    type: "get",
                    url: "/write_novel/call_own_items_with_tag",
                    data: {
                      "bgCase"  : bgCase,
                      "bgId"    : bgId
                    },
                    success: function (data) {

                      var bgData = data["affect_info"];
                      var tagData = data["tag_info"];

                      var appendEle = "";
                      console.log(data);
                      appendEle = createOwnItemsElement(bgCase, bgData, tagData);
                      setDiv.append(appendEle);
                      setDiv.addClass("hasCalled");

                      setTagBtnEvent();
                      setWinImgEvent();
                    },
                    error: function (error) {
                      alert("오류발생");
                    }
                });
                function createOwnItemsElement(bgCase, bgData, tagData){
                  var addEle = "";
                  // 이미지 루트 설정
                  var imgRoot = "/img/background/itemImg/";

                  // 엘리먼트 내용
                  bgData.forEach(function(dt){
                    var name      = dt.name;
                    var img       = dt.img_src;
                    var info      = dt.info;
                    var bgId      = dt.item_id;
                    var bgCase    = "items";
                    var tagEle    = "";

                    // 태그 엘리먼트 생성
                    tagEle += "<select class='" + bgCase + "-" + bgId  + "-" +"select' style='width:60%; height:26px;'>";
                    tagEle += "<option selected='selected' disabled='disabled' value='select-default'>タグ名</option>"
                    tagData.forEach(function(td){
                      if(td.object_id == bgId ){
                        tagEle += "<option data-kind='" + td.kind + "' data-id='" + td.object_id + "' style='background-color:" + td.color + "' value='"+td.color+"'>" + td.tag_name + "</option>";
                      }
                    })
                    tagEle += "</select>";
                    tagEle += "<button data-case='"+ bgCase +"' data-id='"+ bgId +"' class='tag-set-btn'>適用</button>"


                    console.log(dt);
                    addEle += "<div class='col-md-12 cha-info-div'>"
                    addEle += " <div class='col-md-6 cha-img-div'>"
                    addEle += "   <img data-id='" + bgId + "' data-case='" + bgCase + "' class='window-img-circle img-circle img-things-size' src='"+  imgRoot + img +"'><br>" + name
                    addEle += " </div>"
                    addEle += " <div class='col-md-6 cha-effect-div'>"
                    addEle += "    <div class='cha-effect-content'>" + info + tagEle + "</div>"
                    addEle += " </div>"
                    addEle += "</div>"
                  });
                  return addEle;
                }
              }
              function setBelongRelationsInfo(){
                $.ajax({
                    type: "get",
                    url: "/write_novel/call_belong_relations_with_tag",
                    data: {
                      "bgCase"  : bgCase,
                      "bgId"    : bgId
                    },
                    success: function (data) {
                      console.log(data);
                      var listInfo  = data["list_info"];
                      var relInfo   = data["rel_info"];
                      var chaInfo   = data["cha_info"];
                      var tagInfo   = data["tag_info"];

                      var appendEle = "";
                      console.log(data);
                      appendEle = createBelongRelationsElement(listInfo, relInfo, chaInfo, tagInfo);
                      setDiv.append(appendEle);
                      setDiv.addClass("hasCalled");

                      setTagBtnEvent();
                      setWinImgEvent();
                    },
                    error: function (error) {
                      alert("오류발생");
                    }
                });
                function createBelongRelationsElement(listInfo, relInfo, chaInfo, tagData){
                  var addEle = "";
                  // 이미지 루트 설정
                  var relImgRoot = "/img/background/relationImg/";
                  var chaImgRoot = "/img/background/characterImg/";

                  // 엘리먼트 내용
                  listInfo.forEach(function(li){
                    var title     = li.title;
                    var img       = li.cover_src;
                    var bgId      = li.listnum;
                    var bgCase    = "relations";
                    var tagEle    = "";

                    // 태그 엘리먼트 생성
                    tagEle += "<select class='" + bgCase + "-" + bgId  + "-" +"select' style='width:60%; height:26px;'>";
                    tagEle += "<option selected='selected' disabled='disabled' value='select-default'>タグ名</option>"
                    tagData.forEach(function(td){
                      if(td.object_id == bgId){
                        tagEle += "<option style='background-color:" + td.color + "' value='"+td.color+"'>" + td.tag_name + "</option>";
                      }
                    })
                    tagEle += "</select>";
                    tagEle += "<button data-case='"+ bgCase +"' data-id='"+ bgId +"' class='tag-set-btn'>適用</button>"

                    addEle += "<div class='col-md-12 rellist-info-div'>"
                    addEle += " <div class='col-md-6 cha-img-div'>"
                    addEle += "   <img data-id='" + bgId + "' data-case='" + bgCase + "' class='window-img-circle img-circle img-things-size' src='"+  relImgRoot + img +"'><br><b>" + title + "</b>";
                    addEle += " </div>"
                    addEle += " <div class='col-md-6 cha-effect-div'>"
                    addEle += "    <div class='cha-effect-content'>" + tagEle + "</div>"
                    addEle += " </div>"
                    addEle += "</div>"

                    //console.log(dt);
                    relInfo.forEach(function(ri){

                      if(ri.listnum == bgId){
                        var sourceData = getChaDataById(chaInfo, ri.source)
                        var targetData = getChaDataById(chaInfo, ri.target)

                        addEle += "<div class='col-md-12 cha-info-div'>"
                        addEle += " <div class='col-md-4 cha-img-div'>"
                        addEle += "   <img data-id='" + sourceData.cha_id + "' data-case='characters' class='window-img-circle img-circle img-things-size' src='"+  chaImgRoot + sourceData.img_src +"'><br>" + sourceData.name
                        addEle += " </div>"
                        addEle += " <div class='col-md-4 rel-effect-div'>"
                        addEle += "    <div class='cha-effect-content'>" + ri.relationship + "</div>"
                        addEle += " </div>"
                        addEle += " <div class='col-md-4 cha-img-div'>"
                        addEle += "   <img data-id='" + targetData.cha_id + "' data-case='characters' class='window-img-circle img-circle img-things-size' src='"+  chaImgRoot + targetData.img_src +"'><br>" + targetData.name
                        addEle += " </div>"
                        addEle += "</div>"
                      }
                    })

                    // 아이디로 캐릭터 정보 추출
                    function getChaDataById(chaInfo, chaId){
                      for(var i=0; i < chaInfo.length; i++){
                        if(chaInfo[i].cha_id == chaId)
                          return chaInfo[i];
                      }
                      return false;
                    }


                  });
                  return addEle;
                }

              }
              function setBelongTimetablesInfo(){
                $.ajax({
                    type: "get",
                    url: "/write_novel/call_belong_timetables_with_tag",
                    data: {
                      "bgCase"  : bgCase,
                      "bgId"    : bgId
                    },
                    success: function (data) {
                      console.log(data);

                      var affectInfo  = data["affect_info"];
                      var tagInfo     = data["tag_info"];

                      var appendEle = "";
                      console.log(data);
                      appendEle = createBelongTimetablesElement(affectInfo, tagInfo);
                      setDiv.append(appendEle);
                      setDiv.addClass("hasCalled");

                      setTagBtnEvent();
                      setWinImgEvent();
                    },
                    error: function (error) {
                      alert("오류발생");
                    }
                });
                function createBelongTimetablesElement(affectInfo, tagInfo){
                  var addEle = "";
                  // 이미지 루트 설정
                  var chaImgRoot = "/img/background/characterImg/";

                  // 엘리먼트 내용
                  affectInfo.forEach(function(ai){
                    var eventTitle    = ai.event_names;
                    var eventContent  = ai.eventContents;
                    var effectContent = ai.affect_content;
                    var bgId          = ai.timetable_id;
                    var bgCase        = "timetables";
                    var tagEle        = "";

                    // 태그 엘리먼트 생성
                    tagEle += "<select class='" + bgCase + "-" + bgId  + "-" +"select' style='width:60%; height:26px;'>";
                    tagEle += "<option selected='selected' disabled='disabled' value='select-default'>タグ名</option>"
                    tagInfo.forEach(function(td){
                      if(td.object_id == bgId){
                        tagEle += "<option style='background-color:" + td.color + "' value='"+td.color+"'>" + td.tag_name + "</option>";
                      }
                    })
                    tagEle += "</select>";
                    tagEle += "<button data-case='"+ bgCase +"' data-id='"+ bgId +"' class='tag-set-btn'>適用</button>"

                    addEle += "<div class='col-md-12 cha-info-div'>"
                    addEle += " <div class='col-md-6 cha-img-div'>"
                    addEle += "   <i data-id='" + bgId + "' data-case='" + bgCase + "' class='window-img-circle img-circle img-things-size material-icons' style='background-color:#EAEAEA; font-size:65'>&#xE878;</i><br>" + eventTitle
                    addEle += " </div>"
                    addEle += " <div class='col-md-6 cha-effect-div'>"
                    addEle += "    <div class='cha-effect-content'>" + effectContent + tagEle + "</div>"
                    addEle += " </div>"
                    addEle += "</div>"
                  });
                  return addEle;
                }
              }
            }
          })
        }
      }
    }


    // 사건에 영향을 끼친 정보 호출하여 setDiv에 적용
    // 태그페인트 정보
    var tagPaintActivated = false;
    var tagPaintCursor = false;
    var tagPaintCase = '';
    var tagPaintId = '';
    var tagPaintColor = '';
    function setAffectInfo(timetableId, bgCase, setDiv=null){
      $.ajax({
          type: "get",
          url: "/write_novel/call_affect_info_with_tag",
          data: {
            "timetableId"  : timetableId,
            "bgCase"       : bgCase
          },
          success: function (data) {

            console.log(data);
            bgData = data["affect_info"];
            tagData = data["tag_info"];
            var appendEle = "";
            appendEle = createCharacterElement(bgCase, bgData, tagData);
            setDiv.append(appendEle);
            setDiv.addClass("hasCalled");

            setTagBtnEvent();
            setWinImgEvent();
          },
          error: function (error) {
            alert("오류발생");
          }
      });

      function createCharacterElement(bgCase, bgData, tagData){
        var addEle = "";
        // 이미지 루트 설정
        var imgRoot = "/img/background/";
        switch(bgCase){
          case "characters":
            imgRoot += "characterImg/";
          break;
          case "items":
            imgRoot += "itemImg/";
          break;
          case "relations":
            imgRoot += "relationImg/";
          break;
          case "maps":
            imgRoot += "mapImg/mapCover/";
          break;
        }

        // 엘리먼트 내용
        bgData.forEach(function(dt){
          var name = dt.name;
          var img = dt.img_src;
          var bgId = dt.id
          var tagEle = "";
          var affectId = dt.affect_id;

          // 태그 엘리먼트 생성
          tagEle += "<select class='" + dt.affect_table + "-" + dt.affect_id + "-" +"select' style='width:60%; height:26px;'>";
          tagEle += "<option selected='selected' disabled='disabled' value='select-default'>タグ名</option>"
          tagData.forEach(function(td){
            if(td.object_id == affectId){
              tagEle += "<option style='background-color:" + td.color + "' value='"+td.color+"'>" + td.tag_name + "</option>";
            }
          })
          tagEle += "</select>";
          tagEle += "<button data-case='"+dt.affect_table+"' data-id='"+dt.affect_id+"' class='tag-set-btn'>適用</button>"

          switch(bgCase){
            case "characters":
              bgId = dt.cha_id;
            break;
            case "items":

            break;
            case "relations":
              name = dt.title;
              img = dt.cover_src;
              break;
            case "maps":
              name = dt.title;
              img = dt.cover_src;
              break;
          }

          console.log(dt);
          addEle += "<div class='col-md-12 cha-info-div'>"
          addEle += " <div class='col-md-6 cha-img-div'>"
          addEle += "   <img data-id='" + bgId + "' data-case='" + bgCase + "' class='window-img-circle img-circle img-things-size' src='"+  imgRoot + img +"'><br>" + name
          addEle += " </div>"
          addEle += " <div class='col-md-6 cha-effect-div'>"
          addEle += "    <div class='cha-effect-content'>" + dt.affect_content + tagEle + "</div>"
          addEle += " </div>"
          addEle += "</div>"
        });
        return addEle;
      }

    }
    // 태그 버튼 이벤트
    function setTagBtnEvent(){
      $(".tag-set-btn").off().on("click",function(){
        var bgCase    = $(this).attr("data-case");
        var bgId      = $(this).attr("data-id");
        var selectEle = $("." + bgCase + "-" + bgId + "-select");

        // 아무런 태그도 선택하지않았거나 이미 활성화 된 경우 비활성화
        if(selectEle.val() != null && tagPaintActivated == false) {
          tagPaintActivated = true;
          tagPaintCursor = true;
          tagPaintCase = $(this).attr("data-case");
          tagPaintId = $(this).attr("data-id");
          tagPaintColor = selectEle.val();
          $(".tag-set-btn").html("キャンセル");
          setMouseCursorPaint();
        } else {
          tagPaintActivated = false;
          tagPaintCursor = false;
          tagPaintCase = '';
          tagPaintId = '';
          tagPaintColor = '';
          $(".tag-set-btn").html("適用");
          disableMouseCursorPaint();
        }

      })
    }

    // 이미지 드래그 이벤트
    var lastClickedImgEle = null;
    var intervalEle;
    var curMouseX = 0;
    var curMouseY = 0;
    var imgDivHeight = 300;
    var imgDivWidth = 300;
    var winId;
    // 각 이미지에 이벤트 적용
    function setWinImgEvent(){
      $(".window-img-circle").off().on("mousedown",function(event){
        event.preventDefault();
        // 마우스 왼쪽버튼에만 반응
        if (event.which != 1) return false;

        lastClickedImgEle = $(this);

        // 클래스별 크기 지정 + 대상에따른 윈도우 팝업
        var bgCase  = lastClickedImgEle.attr("data-case")
        var bgId    = lastClickedImgEle.attr("data-id")
        setWinSize(bgCase);
        winId   = bgCase + "Win" + bgId;

        // 이미 존재할 경우 -> 새로운 창을 띄우지 않음
        if($("#" + winId).length <= 0 && popWindow(imgDivWidth, imgDivHeight, curMouseX-imgDivWidth/2, curMouseY-imgDivHeight/2, "cl", winId)){
            setWindowContent(winId, bgCase, bgId);
            $("#" + winId).hide();
        };

        // 실제 너비, 높이 적용
        imgDivWidth = $("#" + winId).width();
        imgDivHeight = $("#" + winId).height();

        var addEle = "<div class='ready-img-div'></div>";
        $("body").append(addEle);
        $(".ready-img-div").css("width",0);
        $(".ready-img-div").css("height",0);
        $(".ready-img-div").css("opacity",0.1);
        $(".ready-img-div").css("left",event.pageX);
        $(".ready-img-div").css("top",event.pageY);
        $(".ready-img-div").css("background-color","#BDBDBD");
        $(".ready-img-div").animate({
          height:imgDivHeight,
          width:imgDivWidth,
          opacity:0.35
        }, 600);

        // 언제나 마우스를 가운데로 위치
        intervalEle = setInterval(function(){
          var height = $(".ready-img-div").height();
          var width = $(".ready-img-div").width();
          $(".ready-img-div").offset({top:curMouseY-height/2, left:curMouseX-width/2});
        }, 10)
      });

      // 배경설정 대상에 따른 윈도우 크기 설정
      function setWinSize(bgCase){
        switch(bgCase){
          case "characters" :
            imgDivHeight = 230;
          break;
          case "items" :
          break;
          case "relations" :
          break;
          case "maps":
          break;
          case "timetables" :
          break;
        }
      }
    }

    // 움직일때마다 마우스의 위치 적용
    $("body").mousemove(function(event){
        curMouseX = event.pageX;
        curMouseY = event.pageY;
    });

    // 마우스를 땔 경우 - 윈도우 준비 모션 종료
    $("body").on("mouseup",function(event){
      // 마우스 왼쪽버튼에만 반응
      if (event.which != 1) return false;
      if(lastClickedImgEle != null){
        // 윈도우 준비모션 종료
        $(".ready-img-div").remove();
        clearInterval(intervalEle);
        $("#" + winId).show();
        $("#" + winId).offset({top:curMouseY-imgDivHeight/2, left:curMouseX-imgDivWidth/2});

        // 선택 이미지 타겟 초기화
        lastClickedImgEle = null;

      }
    });


    // 태그 페인트 이벤트 - 커서 모양 변화
    $("body").mousemove(function(event){
      if(tagPaintCursor) setMouseCursorPaint();
      else disableMouseCursorPaint();
    });

    // 스크롤 이벤트 ( 드래그 윈도우 동시 이동 )
    var scrollPosition = $(window).scrollTop();
    $(window).scroll(function(event){
      var curPosition = $(window).scrollTop();
      var moveHeight = scrollPosition - curPosition;
      var dragWindow = $(".draggable-window");

      $(".draggable-window").each(function(){
        var curTop = $(this).offset().top
        $(this).offset({top:curTop - moveHeight});
      })
      scrollPosition = curPosition;
    });

    // 마우스 포인터 활성화
    function setMouseCursorPaint(){
      $("#mouse-cursor-div").show();
      $("#mouse-cursor-div").offset({ top: event.pageY, left: event.pageX})
      $("#mouse-cursor-color").css("background-color", "#" + tagPaintColor);
      $("body").css('cursor','none');
    }
    // 마우스 포인터 비활성화
    function disableMouseCursorPaint(){
      $("#mouse-cursor-div").hide();
      $("body").css('cursor','default');
    }

    // 태그 페인트 이벤트 - 선택부분 태그화
    $('#editdiv').on("mouseup",function(){
      var curSel = window.getSelection();
      sel = curSel;

      // 한글자 이상 선택하였을 경우
      if(curSel.toString().length > 0 && curSel.baseNode.parentNode.id=="editdiv" && tagPaintActivated == true){
        surroundSelection("#" + tagPaintColor, tagPaintCase, tagPaintId);
        tagPaintActivated = false;
        tagPaintCursor = false;
        tagPaintCase = '';
        tagPaintId = '';
        tagPaintColor = '';
        $(".tag-set-btn").html("適用");
        disableMouseCursorPaint();
      }
    })


    // 케이스, 아이디로 해당 배경정보 호출
    function callBackgroundInfo(bgCase, bgId){
      var bgData;
      $.ajax({
          type: "get",
          url: "/write_novel/call_background_info",
          async: false,
          data: {
            "novelId" : {{$tasks["novelId"]}},
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
            "novelId" : {{$tasks["novelId"]}},
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

    // 표지이미지 접기 버튼
    $("#coverHideBtn").on("click",function(){
      var toggle = $(this).attr("data-toggle");
      if(toggle == 'on'){
        $(".image_list_box").slideUp("fast");
        $(this).html("<i class='material-icons' style='font-size:40px;'>&#xE316;</i>");
        $(this).attr("data-toggle","off")

      } else {
        $(".image_list_box").slideDown("fast");
        $(this).html("<i class='material-icons' style='font-size:40px;'>&#xE313;</i>");
        $(this).attr("data-toggle","on")
      }

    });

    // 헬퍼 숨기기 버튼
    $("#helperHideBtn").on("click",function(){
      var toggle = $(this).attr("data-toggle");
      if(toggle == 'on'){
        $(".timetable-div").slideUp("fast");
        $(this).html("&#xE316;");
        $(this).attr("data-toggle","off")

      } else {
        $(".timetable-div").slideDown("fast");
        $(this).html("&#xE313;");
        $(this).attr("data-toggle","on")
      }

    });


    // 스티키 메뉴
    var firstWidth = $('.timetable-div').width()+4;
    var stickyNavTop = $('.timetable-div').offset().top;
    var stickyNav = function(){
    var scrollTop = $(window).scrollTop()+40;
    if($("#coverHideBtn").attr("data-toggle")=='off') scrollTop += $(".image_list_box").height();
      if (scrollTop > stickyNavTop) {

          $('.timetable-div').addClass('sticky');
          $('.timetable-div').css("width", firstWidth)
          $(".navbar").slideUp("fast");

      } else {
          $('.timetable-div').removeClass('sticky');
          $(".navbar").slideDown("fast");
      }
    }
    stickyNav();
    $(window).scroll(function() {
      stickyNav();
    });


  })(jQuery);


</script>
@endsection
