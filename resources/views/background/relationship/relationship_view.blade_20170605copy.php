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





		</style>

		<div class="col-xs-7 col-sm-3 col-md-3 height-max-set" style= "background-color : #e8d6b3" >
			<?php
				// 데이터베이스에 있는 모든 캐릭터 이미지 호출
				for($i=0; $i < count($tasks['chaInfos']); $i++){
					$imgSrc = $tasks["imgRoot"].$tasks['chaInfos'][$i]->img_src;
			?>
			<img src={{URL::asset($imgSrc)}} id="chaNode<?=$tasks['chaInfos'][$i]->cha_id?>" class="img-circle img-things-size draggable">
			<?php
				}
			?>

		</div>
		<div id="force-div" class="col-xs-9 col-sm-8 col-md-8 height-max-set" >
			<button type="button" name="button" id="createRelationBtn">관계형성</button>
			<button type="button" name="button" id="removeRelationBtn">관계삭제</button>
			<button type="button" name="button" id="removeChaNodeBtn">캐릭터삭제</button>
		</div>
	{{-- 태그 div.row 닫는 태그 --}}
	</div>


	<script>
	$(function() {
		d3.csv("<?php echo url("data/lsrel.csv")?>", function(error, links) {

			var nodes = {};
			var rel = {};

			// 가져온 데이터를 기반으로 데이터 재해석
			// link.id, link.source, link.target, link.relationship
			links.forEach(function(link) {
				link.id = "rel" + link.relnum;

				link.source = nodes[link.source] ||
						(nodes[link.source] = {chaId: link.source,x:1000,y:10});
				link.target = nodes[link.target] ||
						(nodes[link.target] = {chaId: link.target,x:1000,y:10});
				link.relationship = link.relationship;
			});

			// svg크기 정의 div크기에서 어느정도 여백
			var width = document.getElementById("force-div").offsetWidth-80;
			var height = document.getElementById("force-div").offsetHeight-80;

			console.log(links);

			// //********************************************************************//
			// //                            자료 추가 예시                           //
			// var obj = new Object();
			// obj.relnum=7;
			// obj.id ="rel100";
			// obj.source = "c";
			// obj.source = nodes[obj.source] || (nodes[obj.source] = {name: obj.source});
			// obj.target = "b";
			// obj.target = nodes[obj.target] || (nodes[obj.target] = {name: obj.target});
			// obj.relationship = "ffffffffffffffff";
			// links.push(obj);
			// //********************************************************************//


			//********************************************************************//
			// 											force 레이아웃 정의
			//********************************************************************//
			var force = d3.layout.force()
					.nodes(d3.values(nodes))
					.links(links)
			 		.size([width, height])
					.linkDistance(350)
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
					.attr("refX", 38)
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
				var node = svg.selectAll(".node");
				var selectedInThisEvent = d3.select(this);	// 이번에 선택된 노드
				// 삭제 등으로 selected 노드가 없어졌을 경우
				if($(".selectedNode").length == 0 && $(".sourceNode").length==0)
					selectedCount = 0;
				// 선택된 노드를 다시 선택하였을 경우
				if(selectedInThisEvent.classed("selectedNode"))
					return;

				if(selectedCount == 0){
					selectedStorage[0] = selectedInThisEvent;
					selectedInThisEvent.classed("selectedNode", true);
					// 설명 텍스트
					selectedText = selectedInThisEvent.append("text")
					.attr("dx", "-18")
					.attr("dy", "-45")
					.attr("style", "fill:green; font-weight:bold; font-size:16")
					.text(function(d) { return "선택"} );

					selectedCount++;
				} else if (selectedCount == 1) {
					selectedStorage[1] = selectedInThisEvent;
					selectedStorage[0].classed("selectedNode", false);
					selectedStorage[0].classed("sourceNode", true);
					// 설명 텍스트
					selectedText.remove();
					sourceText = selectedStorage[0].append("text")
					.attr("dx", "-18")
					.attr("dy", "-45")
					.attr("style", "fill:red; font-weight:bold; font-size:16")
					.text(function(d) { return "주체"} )

					targetText = selectedStorage[1].append("text")
					.attr("dx", "-18")
					.attr("dy", "-45")
					.attr("style", "fill:blue; font-weight:bold; font-size:16")
					.text(function(d) { return "대상"} )

					selectedInThisEvent.classed("targetNode", true);
					selectedCount++;
				} else {
					node.classed("sourceNode",false);
					node.classed("targetNode",false);
					selectedCount = 1;
					selectedStorage[0] = selectedInThisEvent;
					sourceText.remove();
					targetText.remove();
					selectedInThisEvent.classed("selectedNode", true);
					selectedText = selectedInThisEvent.append("text")
					.attr("dx", "-18")
					.attr("dy", "-45")
					.attr("style", "fill:green; font-weight:bold; font-size:16")
					.text(function(d) { return "선택"} );
				}

			}
			// 관계 삭제
			$("#removeRelationBtn").on("click", function(){

				var selectedRelation = d3.select(".selectedRelation").selectAll("textPath").attr("href");
				links = links.filter(function(l){
					return l.id != selectedRelation.replace("#", "");
				});
				path.remove();
				restart();
				restart();
			});

			// 관계 생성창
			$("#createRelationBtn").on("click", function(){

				var source = $(".sourceNode");
			  var target = $(".targetNode");
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
				obj.relationship = prompt();

				restart();
				links.push(obj);

				restart();
			});

			// 캐릭터 노드 제거
			$("#removeChaNodeBtn").on("click", function(){

				var selectedNode = $(".selectedNode");
				var selectedChaId = selectedNode.attr("href");
				console.log(links);
				links = links.filter(function(l){
					return (l.source.chaId != selectedChaId) && (l.target.chaId != selectedChaId)
				});

				delete nodes[selectedChaId];

				path.remove();
				node.remove();

				// 캐릭터 리스트에 생성 ****

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
			} if (error){
				 console.log(error);
			}
			else{
				 console.log("nodes↓");
				 console.log(nodes);
				 console.log("links↓");
				 console.log(links);
				 console.log("path↓");
				 console.log(path);
				 console.log("nodes↓");
				 console.log(rel);
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
						.attr("marker-end", "url(#end)");

				mytext = mytext.data(links)
				mytext.remove();
				mytext = mytext.enter().append("text")
				.attr("dx", "150")
				.attr("dy", "-8")
				.attr("id", function(d) { return  "text" + d.id; })
				.on("click", selectRelation)
				.append("textPath")
				.attr("xlink:href", function(d) { return "#" + d.id; })
				.attr("style", "fill:magenta; font-weight:bold; font-size:12")
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

				// 노드의 이미지 패턴 정의
				var defs = svg.append("defs").attr("id", "imgdefs");
				var catpattern = defs.append("pattern")
															.attr("id", "catpattern")
															.attr("height", 1)
															.attr("width", 1)
															.attr("x", "0")
															.attr("y", "0");
				catpattern.append("image")
					 .attr("height", 70)
					 .attr("width", 70)
					 .attr("xlink:href", "{{URL::to('/')}}/img/background/characterImg/Bak.png")

				// 노드에 원형 추가
				node.append("circle")
						.attr("r", 35)
						.attr("fill", "url(#catpattern)");

				// 노드에 텍스트 추가 (name 데이터)
				node.append("text")
					 .attr("text-anchor", "middle")
						.attr("style", "fill:blue; font-weight:bold; font-size:16")
						.text(function(d) { return d.chaId; });


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
					 addNewNode(e.pageX,e.pageY);
				 }
					draggedObj = null;

			 }
			});

			function addNewNode(x,y){
				var parentOffset = $("svg").offset();
   			x -= parentOffset.left;
   			y -= parentOffset.top;

				// 캐릭터의 데이터 셋 추가
				var nodeInfo = new Object();
				nodeInfo.chaId = "k";
				nodeInfo.x = x;
				nodeInfo.y = y;
				restart();
				nodes[nodeInfo.chaId] = nodeInfo;
				console.log(nodes);
				restart();
			}


		});
	});

	</script>
@endsection
