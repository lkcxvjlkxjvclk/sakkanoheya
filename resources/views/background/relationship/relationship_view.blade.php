@extends('layouts.master')

@include('partials.mySubNavi')

@include('background.tag')

@section('content')
		<style>
			path.link {
			  fill: none;
			  stroke: #666;
			  stroke-width: 1.5px;
			}

			circle {
			  stroke: #fff;
			  stroke-width: 1.5px;
			}



			text {
			  fill: #000;
			  font: 10px sans-serif;
			}


			.droppable{
				background-color: blue;
			}

			.selectedNode > circle{
				stroke: green;
				stroke-width:3;
			}
			.selectedNode>text::before {
  			content: "Joe's Task:";
				stroke: red;
				stroke-width:3;
			}
			.sourceNode > circle{
				stroke: red;
				stroke-width:3;
			}
			.targetNode > circle{
				stroke: blue;
				stroke-width:3;
			}



			.selectedLink {
				stroke: red;
				stroke-width:3;
			}

			.selectedRelation{
				stroke: red;
				stroke-width:1;
			}

			.function-div{
				margin-top: 12px;
				background-color: #BDBDBD;
				text-align: center;
			}

			.form-control{
				width:auto;
			}

			.height-max-set{
				height:95%;
			}

			/* 맵 리스트 css */
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
			.selected-map-content{
				outline: 2px solid red;
				outline-offset: -2px;
			}
		</style>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<div class="function-div form-group">
			<form class="form-inline">
				<div class="form-group">
			    <label>選択</label>
			    <input type="text" id="selectedNameInput" class="form-control" id="exampleInputName2" placeholder="選択" readonly="readonly">
			  </div>
			  <div class="form-group">
			    <label>主体</label>
			    <input type="text" id="sourceNameInput" class="form-control" id="exampleInputName2" placeholder="主体" readonly="readonly">
			  </div>
			  <div class="form-group">
			    <label>対象</label>
			    <input type="email" id="targetNameInput" class="form-control" id="exampleInputEmail2" placeholder="対象" readonly="readonly">
			  </div>
			  <button type="button" class="btn btn-default" id="createRelationBtn">関係形成</button>
				<button type="button" class="btn btn-default" id="removeRelationBtn">関係除去</button>
				<button type="button" class="btn btn-default" id="removeChaNodeBtn">人物除去</button>
				<button type="button"  data-toggle="modal" data-target="#squarespaceModal" class="btn btn-default" id="relationListBtn">関係リスト</button>
			</form>
		</div>
		<!-- line modal -->
		<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title" id="lineModalLabel">関係リスト</h3>
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

		<div class="col-xs-7 col-sm-3 col-md-3 height-max-set character-list" style= "background-color : #e8d6b3" >
			<?php
				$imgRoot 		= $tasks["imgRoot"];
				$chaInfos 	= $tasks["chaInfos"];
				//$relInfos 	= $tasks["relInfos"];
				$relInfos 	= array();

				// 관계에 참여하는 모든 캐릭터 아이디 출력
				function getAllRelChaId($relInfos){
					$chaIds = array();
					foreach($relInfos as $relInfo){
						if(!in_array($relInfo->source, $chaIds))
							array_push($chaIds,$relInfo->source);
						if(!in_array($relInfo->target, $chaIds))
							array_push($chaIds,$relInfo->target);
					}
					return $chaIds;
				}

				// 해당 아이디에 해당하는 캐릭터 정보 출력
				function getChaInfoById($chaInfos, $id){
					foreach($chaInfos as $chaInfo){
						if($chaInfo->cha_id == $id)
							return $chaInfo;
					}
					return null;
				}

				// 데이터베이스에 있는 모든 캐릭터 이미지 호출
				for($i=0; $i < count($chaInfos); $i++){
					if(!in_array($chaInfos[$i]->cha_id,getAllRelChaId($relInfos))){
						$imgSrc = $imgRoot.$chaInfos[$i]->img_src;
			?>
			<img src={{URL::asset($imgSrc)}} id="chaNode<?=$chaInfos[$i]->cha_id?>" class="chanode img-circle img-things-size draggable">
			<?php
					}
				}
			?>

		</div>

		<div id="force-div" class="col-xs-9 col-sm-8 col-md-8 height-max-set force-box" >

		</div>


	{{-- 태그 div.row 닫는 태그 --}}d
	</div>

	<script src ="{{url(asset('js/jscolor.js?ver=1'))}}"></script>
	<script>
	$(function() {
			var nodes = {};
			var rel = {};
			var chaInfos = <?php echo json_encode($chaInfos) ?>;

			var links = new Array();

			// 가져온 데이터를 기반으로 데이터 재해석
			// link.id, link.source, link.target, link.relationship
			links.forEach(function(link) {
				link.id = "rel" + link.relnum;

				link.source = nodes[link.source] ||
						(nodes[link.source] = {chaId: link.source});
				link.target = nodes[link.target] ||
						(nodes[link.target] = {chaId: link.target});
				link.relationship = link.relationship;
			});

			// svg크기 정의 div크기에서 어느정도 여백
			var width = document.getElementById("force-div").offsetWidth-80;
			var height = document.getElementById("force-div").offsetHeight-80;


			//********************************************************************//
			// 											force 레이아웃 정의
			//********************************************************************//
			var force = d3.layout.force()
					.nodes(d3.values(nodes))
					.links(links)
			 		.size([width, height])
					.linkDistance(500)
					.charge(-800)
					.on("tick", tick);

			// 드래그를 시작할 때 함수 적용(노드 고정)
			var drag = force.drag()
									.on("dragstart", dragstart);

			// #for-div 내 svg 생성
			var svg = d3.select("#force-div").append("svg")
					.attr("width", width)
					.attr("height", height)
					.attr("class", "mind-area")
					.on("dragend", function(){alert("fu!!")});




			// 노드의 이미지 패턴 정의
			var defs = svg.append("defs").attr("id", "imgdefs");
			chaInfos.forEach(function(chainfo){
				var catpattern = defs.append("pattern")
															.attr("id", "pattern" + chainfo.cha_id)
															.attr("height", 1)
															.attr("width", 1)
															.attr("x", "0")
															.attr("y", "0");
				catpattern.append("image")
					 .attr("height", 70)
					 .attr("width", 70)
					 .attr("xlink:href", "{{URL::to('/')}}/img/background/characterImg/" + chainfo.img_src);
			});


			//********************************************************************//
			// 											노드, 링크 요소 추가
			//********************************************************************//
			// 화살표 생성
			var marker = svg.append("svg:defs").selectAll("marker");
			marker = marker.data(["end"])
			marker.exit().remove();
			marker.enter().append("svg:marker")
					.attr("id", String)
					.attr("viewBox", "0 -5 10 10")
					.attr("refX", 25)
					.attr("refY", -1)
					.attr("markerWidth", 8)
					.attr("markerHeight", 8)
					.attr("orient", "auto")
					.append("svg:path")
					.attr("d", "M0,-5L10,0L0,5");


			// 연결선 생성 및 svg 적용, + 연결선마다 화살표 적용
			var path = svg.append("svg:g").selectAll("path");


			// relationship 데이터를 text로 생성
			var relTextArea = svg.append("svg:g");
			var mytext = relTextArea.selectAll("text");

			// 노드 정의
			var node = svg.selectAll(".node");

			restart();

			// 관계 클릭 시 선택
      function selectRelation(){
				var reltext = relTextArea.selectAll("text");
				reltext.classed("selectedRelation", false);
				d3.select(this).classed("selectedRelation", true);
			};

			// 노드 선택 이벤트
		  var selectedCount = 0;							// 선택된 노드의 개수
			var selectedStorage = new Array();	// 2개의 노드 정보를 저장
			var selectedText;
			var sourceText;
			var targetText;

			function selectNode(d){
				var selectedNameInput 	= $('#selectedNameInput');
				var sourceNameInput 		= $('#sourceNameInput');
				var targetNameInput 		= $('#targetNameInput');

				var node = svg.selectAll(".node");
				var selectedInThisEvent = d3.select(this);	// 이번에 선택된 노드
				// 삭제 등으로 selected 노드가 없어졌을 경우
				if($(".selectedNode").length == 0 && $(".sourceNode").length==0)
					selectedCount = 0;
				// 선택된 노드를 다시 선택하였을 경우
				if(selectedInThisEvent.classed("selectedNode"))
					return;

				// 노드를 처음 선택할 경우
				if(selectedCount == 0){
					selectedStorage[0] = selectedInThisEvent;
					selectedInThisEvent.classed("selectedNode", true);
					// 설명 텍스트
					selectedText = selectedInThisEvent.append("text")
					.attr("dx", "-30")
					.attr("dy", "-48")
					.attr("style", "fill:green; font-weight:bold; font-size:30")
					.text(function(d) { return "選択"} );

					// Input 내용 입력
					var selectedChaId = selectedInThisEvent.attr("href");
					var selectedName = getChaInfoById(selectedChaId).name;
					resetInput();
					selectedNameInput.val(selectedName);

					selectedCount++;

				// 노드를 두번째로 선택할 경우
				} else if (selectedCount == 1) {
					selectedStorage[1] = selectedInThisEvent;
					selectedStorage[0].classed("selectedNode", false);
					selectedStorage[0].classed("sourceNode", true);
					// 설명 텍스트
					selectedText.remove();
					sourceText = selectedStorage[0].append("text")
					.attr("dx", "-30")
					.attr("dy", "-45")
					.attr("style", "fill:red; font-weight:bold; font-size:30")
					.text(function(d) { return "主体"} )

					targetText = selectedStorage[1].append("text")
					.attr("dx", "-30")
					.attr("dy", "-45")
					.attr("style", "fill:blue; font-weight:bold; font-size:30")
					.text(function(d) { return "対象"} )

					selectedInThisEvent.classed("targetNode", true);
					selectedCount++;

					// Input 내용 입력
					resetInput();
					var sourceChaId = selectedStorage[0].attr("href");
					var sourceName = getChaInfoById(sourceChaId).name;
					sourceNameInput.val(sourceName);
					var targetChaId = selectedStorage[1].attr("href");
					var targetName = getChaInfoById(targetChaId).name;
					targetNameInput.val(targetName);

				// 노드를 세번째로 선택한 경우
				} else {
					node.classed("sourceNode",false);
					node.classed("targetNode",false);
					selectedCount = 1;
					selectedStorage[0] = selectedInThisEvent;
					sourceText.remove();
					targetText.remove();
					selectedInThisEvent.classed("selectedNode", true);
					selectedText = selectedInThisEvent.append("text")
					.attr("dx", "-30")
					.attr("dy", "-45")
					.attr("style", "fill:green; font-weight:bold; font-size:30")
					.text(function(d) { return "選択"} );

					// Input 내용 입력
					var selectedChaId = selectedInThisEvent.attr("href");
					var selectedName = getChaInfoById(selectedChaId).name;
					resetInput();
					selectedNameInput.val(selectedName);
				}
			}



			// 관계 삭제
			$("#removeRelationBtn").on("click", function(){

				// links 내 관계 제거
				if($(".selectedRelation").length == 0) return;
				var selectedRelation = d3.select(".selectedRelation").selectAll("textPath").attr("href");

				links = links.filter(function(l){
					return l.id != selectedRelation.replace("#", "");
				});

				var relnum = selectedRelation.replace("#rel", "");

				// 데이터베이스 적용 제거된 관계 삭제
				//removeRelData(relnum);

				path.remove();
				restart();
				restart();
			});

			// 관계 생성창
			$("#createRelationBtn").on("click", function(){

				// 선택 노드
				var source = $(".sourceNode");
			  var target = $(".targetNode");

				// links , nodes 정보 수정
				if(source.length == 0 || target.length == 0)
				return;
				 console.log(source);
				var nextRelNum = getNextRelNum();
				var obj = new Object();
				obj.relnum = nextRelNum;
				obj.id ="rel" + nextRelNum;
				obj.source = source.attr("href");
				obj.source = nodes[obj.source] || (nodes[obj.source] = {chaId: obj.source});
				obj.target = target.attr("href");
				obj.target = nodes[obj.target] || (nodes[obj.target] = {chaId: obj.target});
				obj.relationship = prompt("関係内溶を入力してください。");
				console.log(obj);

				// 데이터베이스 적용
				var createdRel = new Object();
				createdRel.relnum 			= obj.relnum;
				createdRel.sourceId 		= obj.source.chaId;
				createdRel.targetId 		= obj.target.chaId;
				createdRel.relationship = obj.relationship;

				console.log(createdRel);


				restart();
				links.push(obj);
				console.log("here");
				console.log(links);

				// DB 관계 생성
				//createRelData(createdRel.relnum, createdRel.sourceId, createdRel.targetId, createdRel.relationship);


				restart();
			});

			// 캐릭터 노드 제거
			$("#removeChaNodeBtn").on("click", function(){

				var selectedNode = $(".selectedNode");
				if(selectedNode.length == 0) return;
				var selectedChaId = selectedNode.attr("href");
				console.log(links);
				links = links.filter(function(l){
					// if((l.source.chaId == selectedChaId) || (l.target.chaId == selectedChaId)){
					// 	removeRelData(l.relnum);
					// }
					return (l.source.chaId != selectedChaId) && (l.target.chaId != selectedChaId)
				});

				delete nodes[selectedChaId];

				path.remove();
				node.remove();

				// 캐릭터 리스트에 생성
				var newNode = document.createElement("img");

				var imgSrc = getChaInfoById(selectedChaId).img_src;

				newNode.setAttribute("src", "{{URL::asset($imgRoot)}}/" + imgSrc);
				newNode.setAttribute("id", "chaNode" + selectedChaId);
				newNode.setAttribute("class","img-circle img-things-size draggable");

				$(".character-list").append(newNode);

				$( ".draggable" ).draggable({
				 revert: true,
				 revertDuration: 500,


				 // 드래그 시작 시 draggedObj에 값 적용
				 start: function (e) {
					 // draggable의 데이터 입력
					 draggedObj = d3.select(e.target).attr("src");
				 },
				 // svg위에 드랍 시 오브젝트는 바로 돌아옴
				 drag: function (e) {
					 // stop까지의 속도
					 $(e.target).draggable("option","revertDuration", isObjOnDroppable() ? 0 : 500)
				 },
				 // drag가 끝난 후 판단
				 stop: function (e,ui) {
					 if(isObjOnDroppable()){
						 chaId = $(e.target).attr("id").replace("chaNode","");
						 //alert("id : " + chaId + " position : " + "(" + e.pageX +"," + e.pageY + ")");
						 $(this).remove();
						 addNewNode(chaId,e.pageX,e.pageY);
					 }
						draggedObj = null;

				 }
				});
				restart();
				restart();
			});

			// 연결선 커브 및 크기변경 + 노드 위치이동
			var tf = true;

			function tick() {
					path.attr("d", function(d) {
							var dx = d.target.x - d.source.x,
									dy = d.target.y - d.source.y,
									dr = Math.sqrt(dx * dx + dy * dy);

							var tickfunc = "M" +
									d.source.x + "," +
									d.source.y + "A" +
									dr + "," + dr + " 0 0,1 " +
									d.target.x + "," +
									d.target.y;

							// if(tf == true){
							// 	alert(tickfunc);
							// 	tf = false;
							// }

							return tickfunc;
					});


					node.attr("transform", function(d) {
									 return "translate(" + d.x + "," + d.y + ")"; });
			}

			// 드래그 시작 시, 노드를 고정
			function dragstart(d){
				 d3.select(this).classed("fixed", d.fixed = true);
				//  console.log("nodes↓");
				//  console.log(nodes);
				//  console.log("links↓");
				//  console.log(links);
				//  console.log("path↓");
				//  console.log(path);
				//  console.log("nodes↓");
				//  console.log(rel);
			}

			function restart(){

				force.nodes(d3.values(nodes));
				force.links(links);

				// 연결선 생성 및 svg 적용, + 연결선마다 화살표 적용
				path = path.data(links)
				path.remove();
				path = path.enter().append("svg:path")
						.attr("id", function(d) { return d.id; } )
						.attr("class", "link")
						.attr("marker-end", "url(#end)")
						.attr("style","fill:none; stroke:steelblue; stroke-width:3;");

				mytext = mytext.data(links)
				mytext.remove();
				mytext = mytext.enter().append("text")
				.attr("dx", "150")
				.attr("dy", "-8")
				.attr("id", function(d) { return  "text" + d.id; })
				.on("click", selectRelation)
				.append("textPath")
				.attr("xlink:href", function(d) { return "#" + d.id; })
				.attr("style", "fill:magenta; font-weight:bold; font-size:30")
				.text(function(d) { return d.relationship; } );

				var relText = relTextArea.selectAll("text");

				// 노드 정의
				node = node.data(d3.values(nodes));
				node.remove();
				node = node.enter().append("g")
				.attr("class", "node")
				.attr("xlink:href", function(d) { return d.chaId; })
				.on("click", selectNode)
				.call(force.drag);


				// 노드에 원형 추가
				node.append("circle")
						.attr("r", 35)
						.attr("fill", function(d) { return "url(#pattern" + d.chaId +")"; });

				// 노드에 텍스트 추가 (name 데이터)
				node.append("text")
					 .attr("text-anchor", "middle")
					 .attr("dy","60")
						.attr("style", "fill:#504c6a; font-weight:bold; font-size:30")
						.text(function(d) { return getChaInfoById(d.chaId).name; });


				// force 재시작
				force.start();
			}

			// 다음 관계번호를 반환
			function getNextRelNum(){
			  var maxRel = 0;
			  links.forEach(function(link){
					if(maxRel < link.relnum){
					 maxRel = link.relnum;
				  }
				});
				return maxRel + 1;
			}

			// 드래그 판단 변수
			var draggedObj = null;	// drag된 오브젝트의 값
			var onDroppable = null;	// svg위에 마우스가 위치하는가 true/false
			// 오브젝트가 드래그 되었고, svg위에 마우스가 위치하는가
			function isObjOnDroppable(){
				if (onDroppable && draggedObj!=null) return true;
				else return false;
			}

			// svg위에 마우스 올렸는지 체크
			svg.on('mouseover',function(d,i){
				onDroppable = true;
			});

			// svg위에 마우스 없는지 체크
			svg.on('mouseout',function(e){
				onDroppable = false;
			});

			// 드래그 객체의 드래그 행위 정의
			$( ".draggable" ).draggable({
			 revert: true,
			 revertDuration: 500,


			 // 드래그 시작 시 draggedObj에 값 적용
			 start: function (e) {
				 // draggable의 데이터 입력
				 draggedObj = d3.select(e.target).attr("src");
			 },
			 // svg위에 드랍 시 오브젝트는 바로 돌아옴
			 drag: function (e) {
				 // stop까지의 속도
				 $(e.target).draggable("option","revertDuration", isObjOnDroppable() ? 0 : 500)
			 },
			 // drag가 끝난 후 판단
			 stop: function (e,ui) {
				 if(isObjOnDroppable()){
					 chaId = $(e.target).attr("id").replace("chaNode","");
					 //alert("id : " + chaId + " position : " + "(" + e.pageX +"," + e.pageY + ")");
					 $(this).remove();
					 addNewNode(chaId,e.pageX,e.pageY);
				 }
					draggedObj = null;

			 }
			});

			function addNewNode(chaId,x,y){
				// 추가 위치 조정 (마우스 + svg상대위치)
				var parentOffset = $("svg").offset();
   			x -= parentOffset.left;
   			y -= parentOffset.top;
				// 캐릭터 정보 호출
				chaInfo = getChaInfoById(chaId);
				// 캐릭터의 데이터 셋 추가
				var nodeInfo = new Object();
				nodeInfo.chaId = chaInfo.cha_id;
				nodeInfo.x = x;
				nodeInfo.y = y;
				restart();
				nodes[nodeInfo.chaId] = nodeInfo;
				console.log(nodes);
				restart();
			}

			// ID값으로 캐릭터의 정보를 가져옴
			function getChaInfoById(id){
				var chaInfos = <?php echo json_encode($chaInfos) ?>;
				var chaInfo = null;
				chaInfos.some(function(info){
					if(info.cha_id == id){
						chaInfo = info;
						return;
					}
				});
				return chaInfo;
			}

			// Input의 내용 삭제
			function resetInput(){
				$('#selectedNameInput').val("");
				$('#sourceNameInput').val("");
				$('#targetNameInput').val("");
			}

			// DB 관계 삭제
			function removeRelData(relnum){
				$.ajax({
						type: "get",
						url: "relation/rmRel",
						data: {
							relnum: relnum
						},
						success: function (data) {
							//alert(data);
						},
						error: function (error) {
							alert("오류발생");
						}
				});
			}

			// DB 관계 생성
			function createRelData(relnum, sourceId, targetId, relationship){
				$.ajax({
            type: "get",
            url: "relation/mkRel",
            data: {
							'relnum': relnum,
							'sourceId': sourceId,
							'targetId': targetId,
							'relationship': relationship
						},
            success: function (data) {
							console.log(data);
            },
            error: function (error) {
              alert("오류발생");
            }
        });
			}



			// 맵 정보 저장 + 맵 리스트에 요소 형성
			// $("#saveMapBtn").on("click",function(){
			// 	var title = $("#saveMapTitle").val();
			// 	if(title.length <= 0){
			// 		$("#titleWarning").modal("show");
			// 	} else {
			//
			// 		// 이미지 blob 생성
			// 		d3.select('.mind-area').attr("style","background-color:white;");
			// 		var doctype = '<?xml version="1.0" standalone="no"?>'
			// 			+ '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';
			// 		var source = (new XMLSerializer()).serializeToString(d3.select('.mind-area').node());
			// 		var blob = new Blob([ doctype + source], { type: 'image/svg+xml;charset=utf-8' });
			// 		var url = window.URL.createObjectURL(blob);
			// 		console.log(source);
			// 		d3.select('.mind-area').attr("style","background-color:none;");
			//
			// 		// Put the svg into an image tag so that the Canvas element can read it in.
			// 		var img = d3.select('body').append('img')
			// 		 .attr('width', 0)
			// 		 .attr('height', 0)
			// 		 .node();
			//
			// 		img.onload = function(){
			// 			// Now that the image has loaded, put the image into a canvas element.
			// 			var canvas = d3.select('body').append('canvas').classed("cavs",true).node();
			// 			canvas.width = width;
			// 			canvas.height = height;
			// 			var ctx = canvas.getContext('2d');
			// 			ctx.drawImage(img, 0, 0);
			// 			var canvasUrl = canvas.toDataURL("image/png");
			// 			$(".cavs").hide();
			// 			// 맵 등록 요청
			//
			// 			// var gridInfos = getGridsInfo();
			// 			// var textInfos = getTextsInfo();
			// 			$.ajaxSetup({
			// 				headers: {
			// 					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// 				}
			// 			});
			//
			// 			$.ajax({
			// 				url: "addRelation",
			// 				type: "post",
			// 				async: false,
			// 				data: {
			// 					"canvasUrl" : canvasUrl,
			// 					"title"			: title,
			// 					"relInfos"  : links
			// 				},
			// 				success: function(data){
			// 					var mapId = data.split("/")[0];
			// 					var createdAt = data.split("/")[1]
			// 					var createEle = createMapEle(mapId, title, canvasUrl, createdAt);
			// 					$(".map-list").append(createEle);
			// 					//setJscolor();
			// 					setMapListEvent()
			// 					console.log(data);
			// 				}
			// 			});
			//
			// 		}
			// 		img.src = url;
			// 	}
			// });


			// 맵 정보 삭제 + 맵 리스트에 요소 삭제
			$("#deleteMapBtn").on("click",function(){
				var relId = $(".selected-map-content").attr("data-map-id");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: "removeList",
					type: "post",
					async: false,
					data: {
						"relId" : relId
					},
					success: function(data){
						console.log(data);
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
					url: "getRelationList",
					type: "post",
					async: false,
					data: {},
					success: function(data){
						data.forEach(function(d){
							var coverSrc = "{{URL::asset('/')}}" + "img/background/relationImg/" + d.cover_src;
							var createEle = createMapEle(d.background_id, d.title, coverSrc, d.created_at);
							$(".map-list").append(createEle);
						});
						//setJscolor();
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
						url: "getRelsContent",
						type: "post",
						data: {
							"id" : $(this).attr("data-map-id")
						},
						success: function(data){
							// console.log(data.gridInfo);
							// console.log(data.textInfo);

							// removeAllText();
							// removeAllGrid();
							console.log(data);
							var relInfos = data;
							var chaInfos = new Array();
							var relChaIds = new Array(); // 관계에 참여하는 모든 캐릭터 아이디
							links = new Array();
							nodes = new Array();
							path.remove();
							node.remove();

							restart();
							relInfos.forEach(function(ri){
								var obj = new Object();
								obj.relnum = ri.relnum;
								obj.id ="rel" + ri.relnum;
								obj.source = ri.source;
								obj.source = nodes[obj.source] || (nodes[obj.source] = {chaId: obj.source});
								obj.target = ri.target;
								obj.target = nodes[obj.target] || (nodes[obj.target] = {chaId: obj.target});
								obj.relationship = ri.relationship;

								if( !(ri.source in relChaIds) ) relChaIds.push(ri.source);
								if( !(ri.target in relChaIds) ) relChaIds.push(ri.target);

								links.push(obj);
							})

							var chaInfos = <?php echo json_encode($chaInfos) ?>;

							chaInfos = chaInfos.filter(function(ci){
								return (relChaIds.indexOf(ci.cha_id+"") == -1);
							});
							$(".character-list > img").remove();
							chaInfos.forEach(function(ci){
								var nodeEle = "<img src={{URL::asset($imgRoot)}}/" + ci.img_src + " id='chaNode" + ci.cha_id + "' class='chanode img-circle img-things-size draggable'>";
								$(".character-list").append(nodeEle);
							});
							$( ".draggable" ).draggable({
							 revert: true,
							 revertDuration: 500,


							 // 드래그 시작 시 draggedObj에 값 적용
							 start: function (e) {
								 // draggable의 데이터 입력
								 draggedObj = d3.select(e.target).attr("src");
							 },
							 // svg위에 드랍 시 오브젝트는 바로 돌아옴
							 drag: function (e) {
								 // stop까지의 속도
								 $(e.target).draggable("option","revertDuration", isObjOnDroppable() ? 0 : 500)
							 },
							 // drag가 끝난 후 판단
							 stop: function (e,ui) {
								 if(isObjOnDroppable()){
									 chaId = $(e.target).attr("id").replace("chaNode","");
									 //alert("id : " + chaId + " position : " + "(" + e.pageX +"," + e.pageY + ")");
									 $(this).remove();
									 addNewNode(chaId,e.pageX,e.pageY);
								 }
									draggedObj = null;

							 }
							});

							restart();


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


			// Title, ImgUrl, Date로 맵 리스트 리턴
			 function createMapEle(mapId, title, canvasUrl, data){
				 var createEle = "";
				 createEle += "<div class='col-md-12 map-list-content' data-map-id='" + mapId +"'>"
				 createEle += "	<div class='col-md-3 map-list-img-div'>"
				 createEle += "		<img src='" + canvasUrl + "'>"
				 createEle += "	</div>"
				 createEle += "	<div class='col-md-9 map-list-content-div'>"
				 createEle += "		タイトル : " 	 + title
				 createEle += "		<button data-map-id='"+mapId+"' class='tag-toggle-btn form-control'>タグ登録</button><br>"
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
							 createEle += "					<h3 class='panel-titl'>タグ</h3>"
						 createEle += "					</div>"
						 createEle += "					<div class='panel-body'>"
							 createEle += "						<input type='text' id='tag_name"+mapId+"' name='tag_name' class='form-control tag_name' placeholder='Text input' value=''>"
						 createEle += "					</div>"
					 createEle += "				</div>"
				 createEle += "				<div class='panel panel-warning col-md-6' style='height:20vh'>"
						 createEle += "					<div class='panel-heading'>"
							 createEle += "						<h3 class='panel-title'>タグカラー</h3>"
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
							 page : "relations",
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



			 // 맵 정보 저장 + 맵 리스트에 요소 형성
			 $("#saveMapBtn").on("click", parseImages);

			 var canvasSvg = document.querySelector('svg');
			 var doSomethingWith = function(canvas) {
				 var title = $("#saveMapTitle").val();
				 var canvasUrl = canvas.toDataURL("image/png");
 				if(title.length <= 0){
 					$("#titleWarning").modal("show");
 				} else {
 						$.ajaxSetup({
 							headers: {
 								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 							}
 						});

 						$.ajax({
 							url: "addRelation",
 							type: "post",
 							async: false,
 							data: {
 								"canvasUrl" : canvasUrl,
 								"title"			: title,
 								"relInfos"  : links
 							},
 							success: function(data){
 								var mapId = data.split("/")[0];
 								var createdAt = data.split("/")[1]
 								var createEle = createMapEle(mapId, title, canvasUrl, createdAt);
 								$(".map-list").append(createEle);
 								//setJscolor();
 								setMapListEvent()
								d3.select('.mind-area').attr("style","background-color:none;")
 								console.log(data);
 							}
 						});
 				}
			 };
			 function parseImages() {
				 d3.select('.mind-area').attr("style","background-color:white;");
			   var xlinkNS = "http://www.w3.org/1999/xlink";
			   var total, encoded;
			   // convert an external bitmap image to a dataURL
			   var toDataURL = function(image) {

			     var img = new Image();
			     img.crossOrigin = 'anonymous';

			     img.onload = function() {

			       // we should now be able to draw it without tainting the canvas
			       var canvas = document.createElement('canvas');
			       canvas.width = this.width;
			       canvas.height = this.height;
			       // draw the loaded image
			       canvas.getContext('2d').drawImage(this, 0, 0);
			       // set our <image>'s href attribute to the dataURL of our canvas
			       image.setAttributeNS(xlinkNS, 'href', canvas.toDataURL("image/png"));
			       // that was the last one
			       if (++encoded === total) exportDoc();
						 ;
			     };

			     // No CORS set in the response
			     img.onerror = function() {
			       // save the src
			       var oldSrc = this.src;
			       // there is an other problem
			       this.onerror = function() {
			         console.warn('failed to load an image at : ', this.src);
			         if (--total === encoded && encoded > 0) exportDoc();
			       };
			       // remove the crossorigin attribute
			       this.removeAttribute('crossorigin');
			       // retry
			       this.src = '';
			       this.src = oldSrc;
			     };
			     // load our external image into our img
			     var href = image.getAttributeNS(xlinkNS, 'href');
			     // really weird bug that appeared since this answer was first posted
			     // we need to force a no-cached request for the crossOrigin be applied
			     img.src = href + (href.indexOf('?') > -1 ? + '&1': '?1');
			   };

			   // get an external svg doc to data String
			   var parseFromUrl = function(url, element) {
			     var xhr = new XMLHttpRequest();
			     xhr.onload = function() {
			       if (this.status === 200) {
			         var response = this.responseText || this.response;
			         var dataUrl = 'data:image/svg+xml; charset=utf8, ' + encodeURIComponent(response);
			         element.setAttributeNS(xlinkNS, 'href', dataUrl);
			         if (++encoded === total) exportDoc();
			       }
			       // request failed with xhr, try as an <img>
			       else {
			         toDataURL(element);
			       }
			     };
			     xhr.onerror = function() {
			       toDataURL(element);
			     };
			     xhr.open('GET', url);
			     xhr.send();
			   };

			   var images = canvasSvg.querySelectorAll('image');
			   total = images.length;
			   encoded = 0;

			   // loop through all our <images> elements
			   for (var i = 0; i < images.length; i++) {
			     var href = images[i].getAttributeNS(xlinkNS, 'href');
			     // check if the image is external
			     if (href.indexOf('data:image') < 0) {
			       // if it points to another svg element
			       if (href.indexOf('.svg') > 0) {
			         parseFromUrl(href, images[i]);
			       } else // a pixel image
			         toDataURL(images[i]);
			     }
			     // else increment our counter
			     else if (++encoded === total) exportDoc();
			   }
			   // if there were no <image> element
			   if (total === 0) exportDoc();

			 }
			 var exportDoc = function() {
			   // check if our svgNode has width and height properties set to absolute values
			   // otherwise, canvas won't be able to draw it
			   var bbox = canvasSvg.getBoundingClientRect();

			   if (canvasSvg.width.baseVal.unitType !== 1) canvasSvg.setAttribute('width', bbox.width);
			   if (canvasSvg.height.baseVal.unitType !== 1) canvasSvg.setAttribute('height', bbox.height);

			   // serialize our node
			   var svgData = (new XMLSerializer()).serializeToString(canvasSvg);
			   // remember to encode special chars
			   var svgURL = 'data:image/svg+xml; charset=utf8, ' + encodeURIComponent(svgData);

			   var svgImg = new Image();

			   svgImg.onload = function() {
			     var canvas = document.createElement('canvas');
			     // IE11 doesn't set a width on svg images...
			     canvas.width = this.width || bbox.width;
			     canvas.height = this.height || bbox.height;

			     canvas.getContext('2d').drawImage(svgImg, 0, 0, canvas.width, canvas.height);
			     doSomethingWith(canvas)
			   };

			   svgImg.src = svgURL;
			 };

	});


	</script>
@endsection
