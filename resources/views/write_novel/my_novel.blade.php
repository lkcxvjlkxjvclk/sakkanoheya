@extends('layouts.master')




@section('content')
	@include('partials.mySubNavi')
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

	.novel-container{
	}

	.novel-list{
		text-align: center;
		background-color: #EAEAEA;
		padding: 1px;
	}

	.btn-group{
		margin-right: 10px;
	}
	.form-control{
		width:30%;
		display: inline-block;
	}

	/* 소설 테이블 css*/
	.novel-table{
		background-color: white;
		width:80%;
		margin-top: 50px;
		margin-bottom: 30px;
	}

	.novel-table th{
		text-align: center;
	}

	.novel-table td{
		text-align: center;
	}

	.novel-table .novel-info{
		text-align: left;
		padding-left: 10px;
	}



	/* 페이지네이션 css */
	.pagination>li>a, .pagination>li>span {
		 border-radius: 50% !important;
		 margin: 0 5px;
	 }

	 .create-novel-btn{
	 		width: 200px;
	 }

	</style>
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="write_novel_set">
    <div class="container">
      <div class="row set_row">
        <div class="col-md-12 main_title" draggable="false">小説リスト</div>
      </div>

      <div class="row set_row novel-container">
        <div class="col-md-12">
					<div class="span2">
						<div class="btn-group pull-left" data-toggle="buttons-radio">
								<button class="btn active">全て</button>
								<button class="btn">ニックネーム</button>
								<button class="btn">作品名</button>
						</div>
					</div>
					<div class="span4">
						<form class="form-search">
								<div class="input-append">
										<input type="text" class="span2 form-control">
										<button type="submit" class="btn">検索</button>
										&nbsp;<button type="button" class="btn" onclick="location.href='set'">小説登録</button>
								</div>
						</form>
					</div>
        </div>

				<div class="col-md-12">
					<div class="novel-list">
					</div>
					<ul class="pagination">
              <li class="disabled"><a href="#">«</a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">»</a></li>

          </ul>

        </div>

      </div>


    </div>
  </div>

{{-- @php
require_once App\Http\Controllers\NovelEpisodeController;
echo NovelEpisodeController::show($novelId, $d.id);
@endphp --}}


	<script>
	$(function() {
		getNovelInfo(1);
		// ajax 소설값 가져옴, 입력값 없을 시 1페이지
		function getNovelInfo(curPage = 1){
			// DB처리
			$.ajax({
					type: "get",
					url: "get_novel_info",
					data: {
						"page": curPage
					},
					success: function (data) {
						console.log(data);
						// 소설 정보 띄우기
						setNovelInfo(data.data)
						// 페이지 네이션
						setPagination(curPage,data.last_page);
					},
					error: function (error) {
						alert("오류발생");

					}
			});

		}

		// 소설값을 테이블에 적용
		function setNovelInfo(data){

			$(".novel-table").remove();
			$(".episode-collapse").remove();
			data.forEach(function(d){
				// 소설 테이블
				var genre;
				switch(d.genre){
					case "romance" : genre = "ロマンス"; break;
					case "fantasy" : genre = "ファンタジー"; break;
					case "scifi" : genre = "SF"; break;
					case "martial" : genre = "武侠"; break;
					case "detective" : genre = "推理"; break;
					case "horror" : genre = "ホラー"; break;
					case "agenovel" : genre = "歴史"; break;
					default: genre = "ロマンス"; break;
				}
				var tableEle ="";
				tableEle += "<table class='table novel-table' align='center'>";
				tableEle += "	<tr>";
				tableEle += "		<th>カバー</th>";
				tableEle += "		<th>タイトル</th>";
				tableEle += "		<th>ニックネーム</th>";
				tableEle += "		<th>ジャンル</th>";
				tableEle += "		<th>管理</th>";
				tableEle += "	</tr>";
				tableEle += "	<tr>";
				tableEle += "		<td rowspan='2'><img class='cover-img' src='{{URL::asset('upload/images')}}/"+ d.cover_img_src+ "' width='100px' height='144px'></td>";
				tableEle += "		<td>"+ d.title +"</td>";
				tableEle += "		<td>"+ "落葉 "+"</td>";
				tableEle += "		<td>"+ genre +"</td>";
				tableEle += "		<td>"
				tableEle += "			<button  data-toggle='collapse' href='#collapse" + d.id + "' type='button' class='btn btn-default episode-mng-btn' data-novel-id='"+d.id+"'>作品管理</button>";
				tableEle += "			<button type='button' class='btn btn-default write-episode-btn' data-novel-id='"+d.id+"'>小説作成</button>";
				tableEle += "			<button type='button' class='btn btn-default background-set-btn' data-novel-id='"+d.id+"'>背景設定</button>";
				tableEle += "			<button type='button' class='btn btn-default chapter-set-btn' data-novel-id='"+d.id+"'>チャプター設定</button>";
				tableEle += " 		<button type='button' class='btn btn-default novel-modify-btn' data-novel-id='"+d.id+"'>作品修正</button>";
				tableEle += " 	</td>";
				tableEle += "	</tr>";
				tableEle += "	<tr>";
				tableEle += "		<td colspan='4' class='novel-info'>";
				tableEle += "<b>登録日</b> " + d.created_at + "<br>";
				tableEle += "		</td>";
				tableEle += "	</tr>";
				tableEle += "</table>";
				tableEle += "<div class='episode-collapse collapseDiv"+ d.id +"'></div>";

				$(".novel-list").append(tableEle);

				// 회차 리스트 출력
				setEpisodeInfo(d.id);

				$(".write-episode-btn").off().on("click",function(){
					var novelId = $(this).attr("data-novel-id");
					document.location.href="/write_novel/write_episode/" + novelId;
				})
				// JJH 2017.08.01
				// onclick background
				$(".background-set-btn").off().on("click",function(){
					let novelId = $(this).attr("data-novel-id");

					location.href="/background/historyTable/"+novelId+"";
				})
				// JJH 2017.08.01
				// onclick chapter
				$(".chapter-set-btn").off().on("click",function(){
					let novelId = $(this).attr("data-novel-id");

					location.href="/chapter/"+novelId+"";
				});
			})
		}

		// 소설 아이디에 따른 회차 목록
		function setEpisodeInfo(novelId){

			$.ajax({
					type: "get",
					url: "get_episode_info",
					data: {
						"novelId": novelId
					},
					success: function (data) {
						console.log(data);// 회차 테이블

						var episodeCollapse = "";
						episodeCollapse += "<div class='panel panel-default'>";
						episodeCollapse += "	<div id='collapse" + novelId + "' class='panel-collapse collapse'>";
						episodeCollapse += "		<ul class='list-group'>";
						episodeCollapse += "			<div class='col-md-12 list-group-item'>";
						episodeCollapse += "				<div class='col-md-1'>種類</div>";
						episodeCollapse += "				<div class='col-md-1'>有・無料</div>";
						episodeCollapse += "				<div class='col-md-6'>タイトル</div>";
						episodeCollapse += "				<div class='col-md-2'>最初登録日</div>";
						episodeCollapse += "				<div class='col-md-2'>最初修正日</div>";
						episodeCollapse += "			</div>";
						episodeCollapse += "		</ul>"
						data.forEach(function(d){
							episodeCollapse += "		<ul class='list-group'>";
							episodeCollapse += "			<div class='col-md-12 list-group-item'>";
							episodeCollapse += "				<div class='col-md-1'>" + (d.is_notice ? "공지" : "회차") + "</div>";
							episodeCollapse += "				<div class='col-md-1'>" + (d.is_charge ? "유료" : "무료") + "</div>";
							episodeCollapse += "				<a href='/novel/read/novel_read_view/" + novelId+"&"+d.id + "'><div class='col-md-6'>" + (data.indexOf(d)+1) + "話. " +d.episode_title + "</div></a>";
							episodeCollapse += "				<div class='col-md-2'>" + d.created_at + "</div>";
							episodeCollapse += "				<div class='col-md-2'>" + (d.updated_at != null ? d.update_at : "0000-00-00") + "</div>";
							episodeCollapse += "			</div>";
							episodeCollapse += "		</ul>"
						});

						episodeCollapse += "		<div class='panel-footer'>総計 : " + data.length + "</div>";
						episodeCollapse += "	</div>";
						episodeCollapse += "</div>";

						$(".collapseDiv" + novelId).append(episodeCollapse);

					},
					error: function (error) {
						alert("ERROR");
					}
			});

		}
		// 소설 목록 페이지네이션
		function setPagination(curPage, lastPage){
			// 현재 페이지 기준 앞뒤 2개씩 출력
			var unit = 2;

			// 처음 2 페이지일 경우
			if(curPage <= unit){
				start = 1;
				end = 1 + unit*2;
			// 마지막 2 페이지일 경우
			}else if(lastPage-curPage < unit){
				start = lastPage -unit*2;
				end = lastPage;
			} else {
				start = curPage - unit;
				end = curPage + unit
			}
			if(start < 1) start =1;
			if(end > lastPage) end = lastPage;
			showPagination(start, end, curPage, lastPage);
			function showPagination(start,end, curPage, lastPage){
				//alert(start + "부터" + end);
				$(".pagination li").remove();

				var pageEle ="";
				pageEle += "<li " + (curPage == 1 ? "class='disabled'" : "") + "><a onclick='jsGetNovelInfo(" + (curPage-1) + ")'>«</a></li>"

				for(var index = start; index <= end ; index++)
					pageEle += "<li " + (index==curPage ? "class='active'" : "") +"><a onclick='jsGetNovelInfo(" + index + ")'> " + index + "</a></li>";

				pageEle += "<li " + (curPage == lastPage ? "class='disabled'" : "") + "><a onclick='jsGetNovelInfo(" + (curPage+1) + ")'>»</a></li>";

				//alert(pageEle);
				 $(".pagination").append(pageEle);

			}


		}

		goJsGetNovelInfo = getNovelInfo;
	});



	function jsGetNovelInfo(num = 1){
		goJsGetNovelInfo(num);
	}
	</script>
@endsection
