<div class="default-padding"></div>
@extends('layouts.master')


@section('content')

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

    .check_circle {
      vertical-align: middle;
      width: 13px;
      height: 13px;
      background: #BDBDBD;
      -moz-border-radius: 50px;
      -webkit-border-radius: 50px;
      border-radius: 50px;
    }

    .selected_period > img {
      background: #00D8FF;
    }
    .novel_period_day_table {
      display: inline-block;
      border-collapse:separate;
      border-spacing:1px;
      vertical-align: middle;
    }
    .novel_period_day {
      border:#BDBDBD 2px solid;
      width:30px;
      height:30px;
      text-align:center;
    }
    .selected_day {
      border:#00D8FF 2px solid;
      color: #00D8FF;
    }

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
    .intro_box {
      border:#EAEAEA 2px solid;
      margin-bottom: 10px;
      overflow-y: scroll;
      padding-left: 5px;
    }

    .detail_intro_box {
      height:250px;
    }

    .summary_intro_box {
      height:100px;
    }

    .btn_div {
      text-align: center;
      align-items: center;
      height: 100px;
    }
    .func_btn {
      vertical-align: middle;
      border: #7CC8C9 2px solid;
      color: #7CC8C9;
      font-size: 24px;
      width: 80%;
      height: 60px;
      padding-top: 10px;
      margin: 0 auto;

    }

  </style>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="write_novel_set">
    <div class="container">
      <div class="row set_row">
        <div class="col-md-12 main_title">小説登録</div>
      </div>

      <div class="row set_row">
        <div class="col-md-12">
          <span class="menu_title">タイトル</span>
          <input id="novel-title" class="menu_input" type="text" placeholder="小説のタイトルを入力してください。" size=50>
        </div>
      </div>
      <div class="row set_row">
        <div class="col-md-6">
          <span class="menu_title">ジャンル</span>
          <select id="genre" class="menu_select" name="">
            <option value="romance">ロマンス</option>
            <option value="fantasy">ファンタジー</option>
            <option value="scifi">SF</option>
            <option value="martial">武侠</option>
            <option value="detective">推理</option>
            <option value="horror">ホラー</option>
            <option value="agenovel">歴史</option>
          </select>
        </div>

        <div class="col-md-6">
          <span class="menu_title">連載周期</span>
          <span class="check_novel_period free_publish selected_period" data-case="free-publish"><img src="{{URL::asset('img/write_novel/check.png')}}" class="check_circle">自由連載</span>
          <span class="check_novel_period day_publish" data-case="day-publish"><img src="{{URL::asset('img/write_novel/check.png')}}" class="check_circle">周期連載</span>

          <table class="novel_period_day_table day_activate">
            <tr>
              <td class="novel_period_day" data-day="mon">月</td>
              <td class="novel_period_day" data-day="tue">火</td>
              <td class="novel_period_day" data-day="wed">水</td>
              <td class="novel_period_day" data-day="thu">目</td>
              <td class="novel_period_day" data-day="fri">金</td>
              <td class="novel_period_day" data-day="sat">土</td>
              <td class="novel_period_day" data-day="sun">日</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-10 menu_title">カバーイメージ

        </div>
        <div class="col-md-2">
          <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="">
            <label class="img_upload_label">イメージ登録
              <input class="img_upload_btn" id="imgFile" name="imgFile" type='file'>
            </label>
          </form>
        </div>
      </div>


      <!--표지 이미지가 들어갈 리스트-->
      <div class="row set_row image_list_box">
        <div class="image_list center-slick" data-href="{{URL::to('upload/images')}}">
          <?php  ?>
        </div>
      </div>

      <div class="row set_row">
        <div class="col-md-12 menu_title">小説紹介</div>
      </div>
      <div class="intro_box detail_intro_box" contenteditable="true">
        detail intro box
      </div>
      <div class="intro_box summary_intro_box" contenteditable="true">
        summary intro box
      </div>

      <div class="row set_row">
        <div class="col-md-6 btn_div"><div class="func_btn novel-cancel">キャンセル</div></div>
        <div class="col-md-6 btn_div"><div class="func_btn novel-save">アップロード</div></div>
      </div>

    </div>
  </div>

<script>
  (function ($) {
    // 자유/요일연재 선택
    $('.check_novel_period').bind("click", function(){
      // 체크 되어 있지 않다면
      $('.check_novel_period').removeClass("selected_period");
      $(this).addClass("selected_period");

      // 요일 연재의 경우 요일 활성화
      if($(this).hasClass("day_publish")){
        activateDayCell();
      // 요일연재가 아닐경우 요일 비활성화
      } else {
        deactivateDayCell();
      }
    });

    // 요일 선택
    $(".novel_period_day").bind("click", function(){
      // 요일 선택이 활성화 된 경우에만 선택됨
      if($(".novel_period_day_table").hasClass("day_activate")){
        if($(this).hasClass("selected_day"))
          $(this).removeClass("selected_day");
        else
          $(this).addClass("selected_day");
      }
    });

    // 요일 선택 비활성화
    function deactivateDayCell(){
      $(".novel_period_day_table").removeClass("day_activate");
      $(".novel_period_day").removeClass("selected_day");
      $(".novel_period_day_table").hide();
    }

    // 요일 선택 활성화
    function activateDayCell(){
      if(!$(".novel_period_day_table").hasClass("day_activate")){
        $(".novel_period_day_table").addClass("day_activate");
        $(".novel_period_day_table").show();
      }
    }

    // 표지 이미지 리스트 슬릭 설정
    $('.center-slick').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });


    // 기존의 표지 이미지 출력
    getCoverImage();
    function getCoverImage(){
      <?php for($i=0; $i < count($tasks); $i++){?>

        var addSlickEle = "";
        addSlickEle += "<div class='image_cell'>";
        addSlickEle += "  <div class='cover-img' data-href={{ $tasks[$i]->cover_img_src }} >";
        addSlickEle += "    <div class='quitBox'>";
        addSlickEle += "      <span id='x'>X</span>";
        addSlickEle += "    </div>";
        addSlickEle += "    <img draggable='false' src={{URL::asset('upload/images')}}/{{ $tasks[$i]->cover_img_src }}";
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
              url: "removeCover",
              data: {
                "userId" : '1',
                "removeFile" : coverImg.attr("data-href")
              },
              success: function (data) {
                console.log(data);
              },
              error: function (error) {
                alert("エラー");
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
            console.log(new FormData($("#imgFile")[0]));
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url: "addCover",
              type: "post",
              data: new FormData($("#upload_form")[0]),
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
                  $(".image_list").slick('slickAdd',addSlickEle,0);
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
                        url: "removeCover",
                        data: {
                          "userId" : '1',
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
    $(".novel-cancel").on("click",function(){
      history.go(-1);
    });

    // 저장 버튼
    $(".novel-save").on("click",function(){
      // 소설 정보 변수화
      var title = $("#novel-title").val();
      var genre = $("#genre").val();
      var publishPeriod = $(".selected_period").attr("data-case");
      var publishDay = $(".selected_day");
      var publishDays = "";
      var coverImg = $(".selected-image").find(".cover-img").attr("data-href");
      var detailIntro = $(".detail_intro_box").html();
      var summaryIntro = $(".summary_intro_box").html();

      // 요일 연재의 경우 요일 데이터를 가져옴
      if(publishPeriod == "day-publish")
        publishDay.each(function(index){
          publishDays += "/" + publishDay.eq(index).attr("data-day");
        });

      // ajax 소설 저장 요청
      createNovel(title, genre, publishPeriod, publishDays, coverImg, detailIntro, summaryIntro);
      // 마이페이지 - 소설 목록 페이지 이동


    });

    // DB 소설 생성
    function createNovel(title, genre, publishPeriod, publishDays, coverImg, detailIntro, summaryIntro){
      $.ajax({
          type: "get",
          url: "create_novel",
          data: {
            'title': title,
            'genre': genre,
            'publishPeriod': publishPeriod,
            'publishDays': publishDays,
            'coverImg': coverImg,
            'detailIntro': detailIntro,
            'summaryIntro': summaryIntro
          },
          success: function (data) {
            alert("小説登録完了");
              location.href= "my_novel";
          },
          error: function (error) {
            alert("エラー");
          }
      });
    }
    deactivateDayCell();
  })(jQuery);


</script>
@endsection
