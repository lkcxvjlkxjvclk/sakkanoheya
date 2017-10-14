rant @extends('layouts.master')

@section('content')

	@include('partials.mySubNavi')
	@include('background.tag')
	<style type="text/css">

	.hexagon {
		cursor: pointer;
	}

	/* 타이틀 레이아웃 */

	.title {
		z-index:100;
		left: 200px;
		top:30%;
	  position: absolute;
	  -webkit-perspective: 400;
	          perspective: 400;
	  padding-left: 17px;
	  font-family: Arial;
	  font-weight: bold;
	  font-size: 52px;
	  text-transform: uppercase;
	  color: #fff;
	}

	.title:before {
	  content: '';
	  display: block;
	  position: absolute;
	  height: 100%;
	  width: 6px;
	  background: #ff1212;
	  top: 0;
	  left: 0;
	  opacity: 0;
	  -webkit-transform: translateX(-150px);
	          transform: translateX(-150px);
	  -webkit-animation: title-border-slide-in 0.35s ease-out forwards;
	          animation: title-border-slide-in 0.35s ease-out forwards;
	}
	.title .title-word {
	  opacity: 0;
	  -webkit-transform-origin: bottom center;
	          transform-origin: bottom center;
	  -webkit-transform: rotateX(-90deg);
	          transform: rotateX(-90deg);
	}
	.title .title-word:nth-child(1) {
	  -webkit-animation: roll-in 0.7s 0s ease-out forwards;
	          animation: roll-in 0.7s 0s ease-out forwards;
	}

	@-webkit-keyframes title-border-slide-in {
	  0% {
	    -webkit-transform: translateX(-150px);
	            transform: translateX(-150px);
	    opacity: 0;
	  }
	  100% {
	    -webkit-transform: translateX(0);
	            transform: translateX(0);
	    opacity: 1;
	  }
	}
	@keyframes title-border-slide-in {
	  0% {
	    -webkit-transform: translateX(-150px);
	            transform: translateX(-150px);
	    opacity: 0;
	  }
	  100% {
	    -webkit-transform: translateX(0);
	            transform: translateX(0);
	    opacity: 1;
	  }
	}
	@-webkit-keyframes roll-in {
	  0% {
	    -webkit-transform: rotateX(-90deg);
	            transform: rotateX(-90deg);
	    opacity: 1;
	  }
	  100% {
	    -webkit-transform: rotateX(0deg);
	            transform: rotateX(0deg);
	    opacity: 1;
	  }
	}
	@keyframes roll-in {
	  0% {
	    -webkit-transform: rotateX(-90deg);
	            transform: rotateX(-90deg);
	    opacity: 1;
	  }
	  100% {
	    -webkit-transform: rotateX(0deg);
	            transform: rotateX(0deg);
	    opacity: 1;
	  }
	}
	/* 맵 레이아웃 css */

	#allDiv {
		width:100%;
		background-color: #D4D4D4;
	}
	#mapDiv {
		height:80%;
	}
	#mapCover{
		z-index: 99;
		height: 100%;
		width: 100%;
		position: absolute;
		background-color: black;
		opacity: 0.7;
	}
	#paletteDiv {
		width:230px;
		position:absolute;
		padding:0;
		right:10%;
		background-color: #F0F4FF;
		box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
		border-radius:3px;
	}
	#colorPalette{
		/*background-color: blue;*/
	}
	#imagePalette{
		/*background-color: red;*/
	}
	#textPalette{
		margin:5px;
	}
	#funcPalette{
		/*background-color: green;*/
		padding-bottom: 5px;
	}


	/* 이미지 팔레트 */
	.portfolio {
	  padding: 0 !important;
		overflow-y: scroll;
		height:100px
	}
	.portfolio img {
	  height: auto;
	  width: 100%;
		height:
		margin:0;
		padding: 0;
	}

	@media (min-width: 481px)  { .portfolio img { height: 35%; } }
	@media (min-width: 768px)  { .portfolio img { height: 35%; } }
	@media (min-width: 992px)  { .portfolio img { height: 35%; } }
	@media (min-width: 1200px) { .portfolio img { height: 35%; } }

	@media (min-width: 481px)  { .portfolio img { width: 50%; } }
	@media (min-width: 768px)  { .portfolio img { width: 33.33%; } }
	@media (min-width: 992px)  { .portfolio img { width: 25%; } }
	@media (min-width: 1200px) { .portfolio img { width: 20%; } }

	/* 이미지 팔레트 버튼 */
	.img_upload_label{
		display: inline-block;
		cursor: pointer;

	}
	.img_upload_btn{
		position: absolute;
		width: 1px; height: 1px;
		padding: 0; margin: -1px;
		overflow: hidden;
		clip:rect(0,0,0,0);
		border: 0;
	}

	#deleteImgBtn{
		display: inline-block;
	}

	/* 선택 셀 (색상 or 이미지)*/
	.selected-cell{
		outline: 2px solid red;
  	outline-offset: -2px;
	}
	.selected-map-content{
		outline: 2px solid red;
		outline-offset: -2px;
	}

	/* 드랍다운 css*/
	.dropdown.dropdown-lg .dropdown-menu {
	    margin-top: -1px;
	    padding: 6px 20px;
	}
	.input-group-btn .btn-group {
	    display: flex !important;
	}
	.btn-group .btn {
	    border-radius: 0;
	    margin-left: -1px;
	}
	.btn-group .btn:last-child {
	    border-top-right-radius: 4px;
	    border-bottom-right-radius: 4px;
	}
	.btn-group .form-horizontal .btn[type="submit"] {
	  border-top-left-radius: 4px;
	  border-bottom-left-radius: 4px;
	}
	.form-horizontal .form-group {
	    margin-left: 0;
	    margin-right: 0;
	}
	.form-group .form-control:last-child {
	    border-top-left-radius: 4px;
	    border-bottom-left-radius: 4px;
	}

	.form-group {
		padding:7px;
	}

	select{
    -webkit-appearance: none;
    appearance: none;
	}

	.map-text{
		-webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	/* 멥 리스트 css */

	.map-list{
		height:300px;
		overflow-y: scroll;
	}

	.map-list-content {
		padding:0;
		width:100%;
		margin-bottom: 4px;
		border:3px solid #707070;
		border-radius: 3px;
	}

	.map-list-img-div{
		border-bottom: 3px solid #707070;
		height:120px;
		background-color: #878787;
		padding: 0;
	}
	.map-list-img-div img{

		width: 100%;
		height:100%;
	}
	.modal-body{
		background-color: #CFCFCF;
	}
	.map-list-content-div{
		border-bottom: 3px solid #707070;
		padding: 4px;
		background-color: #FAFAFA;
		padding-left: 10px;
		padding-top: 20px;
		height:120px;
		font-size:17px;
	}

	.map-tag-div{
		background-color:#FAFAFA;
		height:100px;
	}

	#titleWarning{
		top:210px;
	}

	#titleWarningHeader{
		background-color: #FFE6DE;
		text-align: center;
	}

	/* 팔레트 css */
	.paletteHeader {
		margin: 0px;
		margin-bottom: 5px;
		background-color:#8C8C8C;
		text-align: center;
		font-size:23px;
		font-weight: bold;
	}

	.palette{
		padding-left: 5px;
		padding-right: 5px;
	}
	#chosen-value{
		margin-bottom: 5px;
	}
	.color-palette {
		margin-bottom: 5px;
	}

	.portfolio {
		border:2px solid #9E9E9E;
		margin-bottom: 3px;
	}
	.material-icons{
		vertical-align: middle;
	}
	.tag-toggle-btn{
		display: inline-block;
		width:100px;
	}

	</style>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div id="allDiv" class="container">


		<div id="mapDiv" class="col-md-9">

		</div>

		<div id="paletteDiv" class="col-md-2">
			<div class="paletteHeader">
				カラーパレット
			</div>
			<div id="colorPalette" class="palette">
				&nbsp;HEX value: <button class="color-palette jscolor {valueElement:'chosen-value'}">Color Picker</button>
				<input class="form-control" id="chosen-value" value="000000" size = 6>
			</div>

			<div class="paletteHeader" class="palette">
				テキストパレット
			</div>
			<div id="textPalette">
				<!--  -->
				<div class="dropdown dropdown-lg">
          <button type="button" class="btn btn-default dropdown-toggle form-control font-set-btn" data-open="false"><i class="material-icons">create</i>テキスト入力</button>

          <div class="dropdown-menu dropdown-menu-right" role="menu">
              <form class="form-horizontal" role="form">
                <div class="form-group col-md-12">
                  <label for="filter">フォント</label>
                  <select id="font-style-set" class="form-control">
                      <option value="Noto Sans" selected>Noto Sans</option>
                      <option value="Kokoro">Kokoro</option>
                      <option value="Sawarabi Mincho">Sawarabi Mincho</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="contain">大きさ</label>
									<select id="font-size-set" class="form-control">
										@for($i = 20; $i < 61; $i++)
                      <option value="{{$i}}">{{$i}}</option>

										@endfor
                  </select>
									<label for="contain">カラー</label>
									<input class="jscolor {valueElement:'font-color-set'}" type="button" name="" value="TC">
									<input type="hidden" id="font-color-set" value="000000" size = 6>
                </div>
                <div class="form-group col-md-6">
									<label for="contain">スペース</label>
									<select id="letter-spacing-set" class="form-control">
										@for($i = 1; $i < 21; $i++)
											<option value="{{$i}}">{{$i}}</option>
										@endfor
                  </select>
                </div>
								<div class="form-group col-md-12">
									<label for="contain">内容</label>
									<input id="font-content-set" class="form-control" type="text" />
                </div>
              </form>
          </div>
					<button id="deleteTextBtn" type="button" class="form-control" name="button"><i class="material-icons">delete</i>テキスト削除</button>
        </div>
				<!--  -->

			</div>

			<div class="paletteHeader">
				イメージパレット
			</div>
			<div id="imagePalette" class="palette">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-6 col-md-12 portfolio">
						</div>
					</div>
				</div>
				<form enctype="multipart/form-data" id="upload_form" role="form" method="POST">
					<button type="button" class="form-control" onclick="document.getElementById('imgFile').click();"><i class="material-icons">picture_in_picture</i>イメージ登録</button>
					<input class="img_upload_btn" id="imgFile" name="imgFile" type='file'>
					<button type="button" id="deleteImgBtn" class="form-control" name="button"><i class="material-icons">delete</i>イメージ削除</button>
				</form>
			</div>

			<div class="paletteHeader">
				編集パレット
			</div>
			<div id="funcPalette" class="palette">
				<!-- Modal Div -->
				<div class="center"><button data-toggle="modal" data-target="#squarespaceModal" class="form-control"><i class="material-icons">list</i>地図リスト</button></div>
				<!-- line modal -->
				<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				  <div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<h3 class="modal-title" id="lineModalLabel">地図リスト</h3>
							</div>
							<div class="modal-body">
								<div class="map-list">

								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group btn-group-justified" role="group" aria-label="group button">
									<div class="btn-group" role="group">
										<input type="text" class="form-control" id="saveMapTitle" placeholder="タイトル">
									</div>
									<div class="btn-group" role="group">
										<button type="button" id="saveMapBtn" class="btn btn-default" role="button">Save</button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" id="deleteMapBtn" class="btn btn-default" role="button">Delete</button>
									</div>
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
									</div>
								</div>
							</div>
						</div>
				  </div>
				</div>
				<!-- warning Modal -->

				<div class="modal fade" id="titleWarning" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				  <div class="modal-dialog">
						<div class="modal-content">
							<div id="titleWarningHeader" class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<h3 class="modal-title">タイトルを入力してください。</h3>
							</div>
						</div>
				  </div>
				</div>
				<button id="removeAllBtn" type="button" class="form-control" name="button"><i class="material-icons">settings_backup_restore</i>初期化</button>
				<!-- Modal End -->
			</div>
		</div>
		<br>
	</div>


	<script src ="{{url(asset('js/d3.hexbin.v0.min.js?ver=1'))}}"></script>
	<script src ="{{url(asset('js/jscolor.js?ver=1'))}}"></script>



	<script>
	$(function() {

		/*
					데이터 구성 조건
					1. filled 어떤 요소던 색칠이 되어있는가.
					2. data-code 색칠된 타입

					DB저장시 반드시 filled 체크후 true 인 값만 code를 확인
		*/
		//svg sizes and margins
		var margin = {
		    top: 50,
		    right: 20,
		    bottom: 20,
		    left: 50
		},
		width = 800,
		height = 450;

		//The number of columns and rows of the heatmap
		var MapColumns = 45,
		    MapRows = 30;

		//The maximum radius the hexagons can have to still fit the screen
		var hexRadius = d3.min([width/((MapColumns + 0.5) * Math.sqrt(3)),
		   height/((MapRows + 1/3) * 1.5)]);

		// 기본색상
		var baseColor = "teal";

		var points = [];
		for (var i = 0; i < MapRows; i++) {
		    for (var j = 0; j < MapColumns; j++) {
		        points.push([hexRadius * j * 1.75, hexRadius * i * 1.5]);
		    }//for j
		}//for i


		var svg = d3.select("#mapDiv").append("svg")
				.attr("width", width + margin.left + margin.right)
				.attr("height", height + margin.top + margin.bottom)
				.attr("id","map-svg")
				.append("g")
				.attr("id","map-g")
				.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		var hexbin = d3.hexbin()
		            .radius(hexRadius);


		svg.append("g")
		    .selectAll(".hexagon")
		    .data(hexbin(points))
		    .enter().append("path")
		    .attr("class", "hexagon")
		    .attr("d", function (d) {
		  		return "M" + d.x + "," + d.y + hexbin.hexagon();
		 		})
				.attr("id", function(d){
					return "grid" + (d.j * MapColumns + d.i);
				})
				.classed("grids","true")	// jquery 선택자 $(".grids").find(그리드아이디)
		    .attr("stroke", "white")
		    .attr("stroke-width", "1px")
		    .style("fill", baseColor)
				.on("mousedown", mousedown)
				.on("mousemove", mousemove)
				.on("mouseup", mouseup);

		var mousing = 0
		var startWithFilled = 0;
		function mousedown(d) {
			mousing = 1;
			startWithFilled = d3.select(this).classed("filled") ? -1 : +1;

			// 글자 입력 시
			if($(".selected-cell").hasClass("font-set-btn") && $("#font-content-set").val().length > 0){
				var data = d3.select(this).data()[0];
				var id = d3.select(this).attr("id").replace("grid","text");
				svg.append("text")
					 .attr("x",data.x)
					 .attr("y",data.y)
					 .style("font-family",$("#font-style-set").val())
					 .style("font-size",$("#font-size-set").val() + "px")
					 .style("letter-spacing", $("#letter-spacing-set").val() + "px")
					 .style("fill", "#" + $("#font-color-set").val())
					 .style("font-weight","bold")
					 .attr("id", id)
					 .attr("data-code","#" + $("#font-color-set").val())
					 .attr("data-letter-spacing",$("#letter-spacing-set").val() + "px")
					 .classed("map-text","true")
					 .text($("#font-content-set").val());
				$(".map-text").off().on("click",function(){
					removeSelection();
					$(this).addClass("selected-cell");
				});
			}
			// console.log(getTextsInfo());
			mousemove.apply(this, arguments);
		}

		function mousemove(d) {
			var colorCode = "#"+$("#chosen-value").val();
			var value;
			// 이미지 일 경우
			if($(".selected-cell").hasClass("img-cell")){
				var imgId = $(".selected-cell").attr("id");
				imgId = imgId.replace("img","#pattern");
				value = "url(" + imgId + ")";
			// 텍스트 일 경우
			} else if($(".selected-cell").hasClass("font-set-btn")){
				//아무일도 일어나지 않음
				///alert("!!");
			// 색깔일 경우
			} else if($(".selected-cell").hasClass("color-palette")){
				value = "#"+$("#chosen-value").val();

			}

			if(mousing > 0 && ( $(".selected-cell").hasClass("img-cell") || $(".selected-cell").hasClass("color-palette"))) {
				d3.select(this).classed("filled", startWithFilled > 0);
				d3.select(this).style("fill",startWithFilled > 0 ? value : baseColor);
				d3.select(this).attr("data-code",startWithFilled > 0 ? value : "");
			}
			//console.log(getGridsInfo());

		}

		function mouseup() {
			mousemove.apply(this, arguments);
			mousing = 0;
		}

		/****************************************************************/
		/*											이미지 등록, 삭제 												*/
		/****************************************************************/

		// 이미지 등록 이벤트
    $("#imgFile").change(function () {
        // 파일이 있을경우
        if (this.files && this.files[0]) {
            // ajax로 DB추가
            var input = $("#imgFile");
            //console.log(new FormData($("#imgFile")[0]));
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url: "addMapImg",
              type: "post",
              data: new FormData($("#upload_form")[0]),
              processData: false,
              contentType: false,
              success: function(data){
								var imgEle = "";
								//alert(data.imgPath);
								var imgSrc = "{{URL::asset('/')}}" + data.imgPath;
								imgEle += "<img id='img" + data.imgId + "' class='img-cell' src='" + imgSrc + "'>";
								defImagePattern(data.imgId, imgSrc)
								$(".portfolio").append(imgEle);

								$(".img-cell").off().on("click",function(){
									removeSelection();
									$(this).addClass("selected-cell");
								});
              }
            });
        }
    });

		// 이미지 셀 정보 호출
		getImgCellList();
		function getImgCellList(){
			// DB처리
			$.ajax({
					type: "get",
					url: "getImgCellList",
					data: {
						"userId" : 1
					},
					success: function (data) {
						var imgEle = "";
						data.forEach(function(d){
							var imgSrc = "{{URL::asset('/img/background/mapImg/')}}/" + d.img_src;
							imgEle += "<img id='img" + d.id+"'class='img-cell' src='"+ imgSrc + "'>";
							defImagePattern(d.id, imgSrc);
						});

						$(".portfolio").append(imgEle);
						$(".img-cell").off().on("click",function(){
							removeSelection();
							$(this).addClass("selected-cell");
						});

					},
					error: function (error) {
						alert("오류발생");
					}
			});
		}

		/****************************************************************/
		/*									색깔, 이미지 셀 선택													*/
		/****************************************************************/

		$(".color-palette").on("click",function(){
			removeSelection();
			$(this).addClass("selected-cell");
		});

		$(".font-set-btn").on("click",function(){
			removeSelection();
			$(this).addClass("selected-cell");
		});

		function removeSelection(){
			$(".selected-cell").removeClass("selected-cell");
		}

		/****************************************************************/
		/*									이미지 패턴 정의 														*/
		/****************************************************************/
		var defs = svg.append("defs").attr("id", "imgdefs");
		function defImagePattern(id, imgSrc){
			var catpattern = defs.append("pattern")
														.attr("id", "pattern" + id)
														.attr("height", hexRadius*2)
														.attr("width", hexRadius*2)
														.attr("x", "0")
														.attr("y", "0");
			catpattern.append("image")
				 .attr("x", 0)
				 .attr("y", 0)
				 .attr("height", hexRadius*2)
				 .attr("width", hexRadius*2)
				 .attr("xlink:href", imgSrc);
			}

			// 이미지 삭제
			$("#deleteImgBtn").on("click",function(){
				var selection = $(".selected-cell");
				var imgId = selection.attr("id").replace("img","");
				if(selection.hasClass("img-cell")){
					selection.remove();
					$.ajax({
							type: "get",
							url: "removeImg",
							data: {
								"imgId" : imgId
							},
							success: function (data) {
								//console.log(data);
							},
							error: function (error) {
								alert("오류발생");
							}
					});
				}
			})

			/* 텍스트 생성 토글 */
			$(".dropdown-toggle").on("click",function(){
				if($(this).attr("data-open") == "false"){
					$(this).attr("data-open","open");
					$(".dropdown-menu").show();
				} else {
					$(this).attr("data-open","false");
					$(".dropdown-menu").hide();
				}
			});

			// 텍스트 삭제
			$("#deleteTextBtn").on("click",function(){
				if($(".selected-cell").hasClass("map-text"))
					$(".selected-cell").remove();
			});

			// 모든 셀, 텍스트 정보 초기화
			$("#removeAllBtn").on("click",function(){
				removeAllGrid();
				removeAllText();
			});
			// 모든 그리드 fill 삭제
			function removeAllGrid(){
				var grids = d3.selectAll("path")[0];
				//console.log(grids);
				grids.forEach(function(g){
					d3.select("#"+g.id).classed("filled",false);
					d3.select("#"+g.id).style("fill", baseColor);
					d3.select("#"+g.id).attr("data-code","");
				});
			}

			// 모든 텍스트 요소 삭제
			function removeAllText(){
				$(".map-text").remove()
			}

			// 맵 정보 저장 + 맵 리스트에 요소 형성
			$("#saveMapBtn").on("click",function(){
				var title = $("#saveMapTitle").val();
				if(title.length <= 0){
					$("#titleWarning").modal("show");
				} else {
					var createdAt = "asdasdasdasdas";
					var updatedAt = "asdasdsadadsads";

					// 이미지 blob 생성
					var doctype = '<?xml version="1.0" standalone="no"?>'
					  + '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';
					var source = (new XMLSerializer()).serializeToString(d3.select('#map-svg').node());
					var blob = new Blob([ doctype + source], { type: 'image/svg+xml;charset=utf-8' });
					var url = window.URL.createObjectURL(blob);

					// Put the svg into an image tag so that the Canvas element can read it in.
					var img = d3.select('body').append('img')
					 .attr('width', 0)
					 .attr('height', 0)
					 .node();

					img.onload = function(){
					  // Now that the image has loaded, put the image into a canvas element.
					  var canvas = d3.select('body').append('canvas').classed("cavs",true).node();
					  canvas.width = width+50;
					  canvas.height = height+50;
					  var ctx = canvas.getContext('2d');
					  ctx.drawImage(img, 0, 0);
					  var canvasUrl = canvas.toDataURL("image/png");
						$(".cavs").hide();
						// 맵 등록 요청

						var gridInfos = getGridsInfo();
						var textInfos = getTextsInfo();
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						$.ajax({
							url: "addMap",
							type: "post",
							async: false,
							data: {
								"canvasUrl" : canvasUrl,
								"title"			: title,
								"gridInfos" : JSON.stringify(gridInfos),
								"textInfos" : JSON.stringify(textInfos)
							},
							success: function(data){
								var mapId = data.split("/")[0];
								var createdAt = data.split("/")[1]
								var createEle = createMapEle(mapId, title, canvasUrl, createdAt);
								$(".map-list").append(createEle);
								setJscolor();
								setMapListEvent()
							}
						});
					}
					img.src = url;
				}
			});

			// 맵 정보 삭제 + 맵 리스트에 요소 삭제
			$("#deleteMapBtn").on("click",function(){
				var mapId = $(".selected-map-content").attr("data-map-id");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: "removeMap",
					type: "post",
					async: false,
					data: {
						"mapId" : mapId
					},
					success: function(data){
						//alert(data);
						$(".selected-map-content").remove();
					}
				});
			});

			// 맵 리스트 호출
			getMapList();
			function getMapList(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: "getMapList",
					type: "post",
					async: false,
					data: {},
					success: function(data){
						data.forEach(function(d){
							var coverSrc = "{{URL::asset('/')}}" + "img/background/mapImg/mapCover/" + d.cover_src;
							var createEle = createMapEle(d.background_id, d.title, coverSrc, d.created_at);
							$(".map-list").append(createEle);
						});
						setJscolor();
						setMapListEvent();
					}
				});
			}

			// 그리드 정보 반환
			function getGridsInfo(){
				var grids = d3.selectAll("path")[0];
				var gridObjs = new Array();
				grids.forEach(function(g){
					var gridObj = {
						"grid_id" 	: g.id,
						"fill_info" : $("#"+g.id).attr("data-code") ? $("#"+g.id).attr("data-code") : "none"
					};
					if(gridObj.fill_info != "none")
						gridObjs.push(gridObj);
				})
				return gridObjs;
			}

			// 맵 리스트 선택 시, 정보 호출 후 맵에 적용
			function setMapListEvent(){
				$(".map-tag-div").attr("data-toggle","hide");
				$(".map-tag-div").hide();


				$(".map-list-content").off().on("dblclick",function(){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						url: "getGridsContent",
						type: "post",
						data: {
							"id" : $(this).attr("data-map-id")
						},
						success: function(data){
							// console.log(data.gridInfo);
							// console.log(data.textInfo);

							removeAllText();
							removeAllGrid();

							var gridInfo = data.gridInfo;
							var textInfo = data.textInfo;

							gridInfo.forEach(function(gi){
								grid = d3.select("#"+gi.grid_id);
								grid.classed("filled", true);
								grid.style("fill", gi.fill_info);
								grid.attr("data-code",gi.fill_info);
							});

							textInfo.forEach(function(ti){
								var gridId = ti.text_id.replace("text","#grid");
								var textGrid = d3.select(gridId).data()[0];
								//console.log(ti["letter-spacing"]);
								svg.append("text")
									 .attr("x",textGrid.x)
									 .attr("y",textGrid.y)
									 .style("font-family",ti.font_family)
									 .style("font-size", ti.font_size)
									 .style("letter-spacing", ti["letter-spacing"])
									 .style("fill", ti.fill_color)
									 .style("font-weight","bold")
									 .attr("id", ti.text_id)
									 .attr("data-code", ti.fill_color)
									 .attr("data-letter-spacing",ti["letter-spacing"])
									 .classed("map-text","true")
									 .text(ti.content);
								$(".map-text").off().on("click",function(){
									removeSelection();
									$(this).addClass("selected-cell");
								});
							})
						}
					});
				});

				$(".map-list-content").on("click",function(){
					$(".selected-map-content").removeClass("selected-map-content");
					$(this).addClass("selected-map-content");
				});

				$(".tag-toggle-btn").off().on("click",function(){
					var tagDivId = "tagDiv" + $(this).attr("data-map-id");
					var tagDiv = $("#" + tagDivId);
					if(tagDiv.attr("data-toggle") == "hide"){
						tagDiv.attr("data-toggle", "show");
						tagDiv.show();
					} else {
						tagDiv.attr("data-toggle","hide");
						tagDiv.hide();
					}

				});

			}

			function setJscolor(){
				console.log($(".tag-palette"));
				var tagPalette = $(".tag-palette");
				{{-- tagPalette.forEach(function(tp){
					//var id = tp.attr("id").replace("color","");
					tp.addClass("jscolor {valueElement:'chosen-value'}");
				}); --}}
				for(var i=0; i<tagPalette.length; i++){
					console.log(tagPalette[i]);
					tagPalette.addClass("jscolor {valueElement:'chosen-value'}");
				}

			}

			// Title, ImgUrl, Date로 맵 리스트 리턴
			 function createMapEle(mapId, title, canvasUrl, data){
				 var createEle = "";
				 createEle += "<div class='col-md-12 map-list-content' data-map-id='" + mapId +"'>"
				 createEle += "	<div class='col-md-3 map-list-img-div'>"
				 createEle += "		<img src='" + canvasUrl + "'>"
				 createEle += "	</div>"
				 createEle += "	<div class='col-md-9 map-list-content-div'>"
				 createEle += "		タイトル : " 	 + title
				 createEle += "		<button data-map-id='"+mapId+"' class='tag-toggle-btn form-control'>タグ入力</button><br>"
				 createEle += "		登録日 : " + data +"<br>"
				 createEle += "		修正日 : 0000-00-00"
				 createEle += "	</div>"
				 // 정재훈 DIV
				 createEle += "	<div id='tagDiv"+mapId+"' data-toggle='hide' class='col-md-12 map-tag-div' style='height:20vh'>"
				 {{-- createEle += "		<form id='add_tag' name='add_tag' action='map/tag' method='POST'>" --}}
				 createEle += "			<input type='hidden' name='_token' value='{{ csrf_token() }}'>"
				 createEle += "			<input type='hidden' name='page' value='maps}'>"
    			 createEle += "			<input type='hidden' id='object_id' name='object_id' value=''>"
				 createEle += "			<div class='row'>"
    			 createEle += " 			<div class='panel panel-warning col-md-6' style='height:20vh'>"
        		 createEle += "					<div class=panel-heading'>"
            	 createEle += "					<h3 class='panel-titl'>タグ名</h3>"
        		 createEle += "					</div>"
        		 createEle += "					<div class='panel-body'>"
            	 createEle += "						<input type='text' id='tag_name"+mapId+"' name='tag_name' class='form-control tag_name' placeholder='Text input' value=''>"
        		 createEle += "					</div>"
    			 createEle += "				</div>"
				 createEle += "				<div class='panel panel-warning col-md-6' style='height:20vh'>"
        		 createEle += "					<div class='panel-heading'>"
            	 createEle += "						<h3 class='panel-title'>カラー</h3>"
        		 createEle += "					</div>"
				 createEle += "					<div id='colorPalette' class='palette'>"
				 createEle += "						<input class='tag_color' id='tag_color"+mapId+"' list='colors' name='tag_color' value=''>"
				 createEle += "						<datalist id='colors'>"
				 createEle += "							<option value='FFA7A7'>Red</option>"
				 createEle += "							<option value='B2CCFF'>Blue</option>"
				 createEle += "							<option value='B7F0B1'>Green</option>"
				 createEle += "							<option value='FFE08C'>Orange</option>"
				 createEle += "							<option value='FFB2F5'>Purple</option>"
				 createEle += "						</datalist>"
			 	 createEle += "					</div>"
				 createEle += " 			<p></p>"
				 createEle += "				<button type='button' name='tag_submit' id='tag_submit' class='btn btn-default tag_submit' value="+mapId+">submit</button>"
				 createEle += "				</div>"
				 createEle += "			</div>"
				 {{-- createEle += "		</form>" --}}
				 createEle += " </div>"
				 // 정재훈 DIV End
				 createEle += "</div>"

				 return createEle;
			 }

			// 태그 정보 등록
			$(document).ready(function(){
				$('.tag_submit').click(function(){
					$id = $(this).val();
					$tag_name = $('#tag_name'+$id+'').val();
					$tag_color = $('#tag_color'+$id+'').val();
					{{-- alert($(this).val()); --}}
					{{-- alert($('#tag_name'+$id+'').val()); --}}
					{{-- alert($('#tag_color'+$id+'').val()); --}}

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url : "map/tag",
						data : {
								tag_name : $tag_name,
								page : "maps",
								tag_color : $tag_color,
								object_id : $id
								  },
						success:function(data){
							alert("タグ入力完了");
						},
						error:function(request,status,error){
							alert("code:"+request.status+"\n"+"error:"+error);
						}
					});
				});
			});

			// 텍스트 정보 반환
			function getTextsInfo(){
				var texts = d3.selectAll(".map-text")[0];
				var textObjs = new Array();
				texts.forEach(function(t){
					var textObj = {
						"text_id" 				: t.id,
						"content"					: $("#"+t.id).text(),
						"font_family" 		: $("#"+t.id).css("font-family"),
						"font_size"				: $("#"+t.id).css("font-size"),
					 	"letter_spacing" 	: $("#"+t.id).attr("data-letter-spacing"),
						"fill_color" 			: $("#"+t.id).attr("data-code")
					}
					textObjs.push(textObj);
				});
				return textObjs;
			}

			$("#mapCover").on("click",function(){
				$(this).remove();
				$(".title").remove();
			})
				$("#paletteDiv").draggable();

	});
	</script>
@endsection
