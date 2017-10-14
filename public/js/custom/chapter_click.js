$(document).ready(function(){
    $(".chapter_click").each(function(i,e){
        $(this).click(function(){
            let chapter_id = $("#chapter_id"+i).attr('value');
            let chapter_name = $("#chapter_name"+i).attr('value');
            let novel_id = $("#novel_id").val();
            let ajax_url = "episode/"+chapter_id;
            let no_ajax_url = "noepisode/"+novel_id+"/"+chapter_id;
            // chapter에 등록되어 있는 timetable 을 가져오는 url
            // get_timetable method
            let ajax_analysis_url = "timetable/"+novel_id+"/"+chapter_id;
            // chapter에 등록되어 있지 않은 timetable 을 가져오는 url(modal)
            // bring_timetable
            let ajax_bring_timetable_url = "bringtimetable/"+novel_id+"/"+chapter_id;
            // alert(chapter_id);
            // alert(chapter_name);
            
            $('div').remove('.chapter_info');
            $('div').remove('.chapter_episode');

            var data;
            var result;
            // 챕터에 등록한 회차 정보 ajax
            $.ajax({
                type: "GET",
                url : ajax_url,
                // async :false,
                success:function(data){
                    // result = data;
                    // alert(data);
                    // chapter에 등록된 에피소드를 보여주는 append
                    var append_data = "<div class='chapter_info'>"
                    append_data += "    <h3 class='text-center'>"+chapter_name+"</h3>"
                    append_data += "    <div class='row chapter_side' id='chapter_data'>"
                    append_data += "        <table class='table table-condensed'>"
                    if( data[0]['id'] ) {
                        for(var i = 0; i < data.length ; i++){
                            append_data += "        <tr>"
                            append_data += "            <th> </th>"
                            append_data += "            <th>에피소드 제목</th>"
                            append_data += "        </tr>"
                            append_data += "        <tr>"
                            append_data += "            <td>"
                            append_data += "                <img src='/upload/images/"+data[i]['cover_img_src']+"' alt='episode img' class='img-circle' style='width : 50px; height:50px'>"
                            append_data += "            </td>"
                            append_data += "            <td>"+data[i]['episode_title']+"</td>"
                            append_data += "        </tr>"
                        }
                    }
                    append_data += ""
                    append_data += "    </div>"
                    append_data += "    <div class='text-center' data-toggle='modal' data-target='#episode'>"
                    append_data += "        <p class='remote'>"
                    append_data += "            <a class='setView' href='#'>"
                    append_data += "                <i class='fa fa-plus-square-o fa-3x'></i>"
                    append_data += "            </a>"
                    append_data += "        </p>"
                    append_data += "    </div>"
                    append_data += "</div>"
                    
                    $('.chapter_data').append(append_data);
                    
                    // 글자수 data 보여주는 append
                    
                    // svg 요소 크기
                    var svgWidth = 320;
                    var svgHeight = 240;
                    // dataSet
                    var dataSet = [50,30,12,5,3];
                    // d3 표준 20색
                    var color = d3.scale.category20();

                    // 원 그래프 좌표값 계산 메소드
                    var pie = d3.layout.pie()
                        .value(function(d,i){ return d; }); // dataset 의 데이터 반환
                    // 원 그래프의 안쪽 반지금, 바깥족 반지름 설정
                    var arc = d3.svg.arc().innerRadius(30).outerRadius(100);
                    // 원 그래프 그리기
                    var pieElements = d3.select("#myGraph")
                        // g요소 지정
                        .selectAll("g")
                        // data 요소 연결
                        .data(pie(dataSet))
                        .enter()
                        // 중심 계산을 위한 그룹화
                        .append("g")
                        // 원 그래프의 중심으로
                        .attr("transform","translate("+svgWidth/2+","+svgHeight/2+")");

                    // 데이터 추가
                    // 데이터 수만큼 반복
                    pieElements
                        // data수만큼 path 요소 추가
                        .append("path")
                        // css 클래스 설정
                        .attr("class","pie")
                        .style("fill",function(d,i){
                            // 표준 색 반환
                            return color(i);
                        })
                        .transition()
                        .duration(200)
                        // 그릴원 그래프의 시간을 어긋나게 표시
                        .delay(function(d,i){
                            return i*200;
                        })
                        // 직선 적인 움직임으로 변경
                        .ease("linear")
                        .attrTween("d", function(d,i){
                            var interpolate = d3.interpolate(
                                // 각부분의 시작 각도
                                { startAngle : d.startAngle, endAngle : d.startAngle},
                                // 각 부분의 종료 각도
                                { startAngle : d.startAngle, endAngle : d.endAngle }
                            );
                            return function(t){
                                // 시간에 따라 처리
                                return arc(interpolate(t));
                            }
                        });
                    
                    // 합계와 문자 표시
                    var textElements = d3.select("#myGraph")
                        // text 요소 추가
                        .append("text")
                        // css 클래스 설정
                        .attr("class","total")
                        // 중심에 표시
                        .attr("transform","translate("+svgWidth/2+","+(svgHeight/2+5)+")")
                        .text("합계 : " + d3.sum(dataSet));
                    
                    // 부채꼴에 숫자를 표시 
                    pieElements
                        .append("text")
                        .attr("class","pieNum")
                        .attr("transform", function(d,i){
                            // 부채꼴의 중심으로 함(무게 중심 계산)
                            return "translate("+arc.centroid(d)+")";
                        })
                        .text(function(d,i){
                            return d.value;
                        });
                    letter_count_data = ""
                    letter_count_data += ""

               

                    // 챕터에 등록되어 있는 timetable을 가져오는 ajax
                    // get_timetable method
                    $.ajax({
                        type: "GET",
                        url : ajax_analysis_url,
                        // async :false,
                        success:function(data){
                            // alert("성공");
                            // ready(data);
                            
                            // 소설에서 해당 chapter에 등록된 timetable 이외의 정보를 가져오는 ajax
                            // bring timetable method
                            // return modal
                            $.ajax({
                                type: "GET",
                                url : ajax_bring_timetable_url,
                                success:function(data){
                                    // timetable 등록 modal
                                    $('#timeline_name').append(data);
                                },
                                error:function(){
                                    alert("get all timetable fail");
                                }
                            });

                            // timetable 추가 icon append
                            timetable_event = "<div class='text-center chapter_episode' data-toggle='modal' data-target='#timetable_modal'>"
                            timetable_event += "    <p class='remote'>"
                            timetable_event += "        <a class='setView' href='#'>"
                            timetable_event += "            <i class='fa fa-plus-square-o fa-3x'></i>"
                            timetable_event += "        </a>"
                            timetable_event += "    </p>"
                            timetable_event += "</div>"
                            

                            $('#timeline_name').append(timetable_event);
                            
                            // chapter에 등록된 timetable을 호출 
                            ready(data);
                            
                            // chapter에 등록된 timetable_name button 호출
                            var register_timetables = "<div class='chapter_episode'>"
                            register_timetables += "    <nav aria-label='...'>"
                            register_timetables += "        <ul class='pager' id=''>"
                            if ( data[0]['id'] ) {
                                for ( let timetable_count =0; timetable_count < data.length ; timetable_count++ ){
                                    console.log(data.length);
                                    register_timetables += "    <label>"
                                    register_timetables += "        <li class='event_list' id=''>"
                                    register_timetables += "            <a href='#'>"
                                    register_timetables += "                "+data[timetable_count]['event_name']+""
                                    register_timetables += "            </a>"
                                    register_timetables += "        </li>"
                                    register_timetables += "    </label>"
                                }
                            }
                            register_timetables += "        </ul>"
                            register_timetables += "    </nav>"
                            register_timetables += "</div>"

                             $('#timeline_button').append(register_timetables);
                        },
                        error:function(){
                            alert("chapter_data 실패");
                        }
                    });
                },
                error:function(){
                    alert("chapter 실패");
                }
            });

            // 등록되어 있지 않은 episode를 호출하기 위한 ajax
            $.ajax({
                type: "GET",
                url : no_ajax_url,
                success:function(modal_data){
                    $('.chapter_data').append(modal_data);;
                },
                error:function(){
                    alert("novel 실패");
                }
            });

            // alert(data);
            // 스크립트로 종속된 에피소드만큼 출력하기
            

                    // alert(ajax_url);
            //  회차 추가 버튼 클릭 시 ajax
            // $.ajax({
            //     type: "GET",
            //     url : no_ajax_url,
            //     success:function(data){
            //         alert(data);
            //     },
            //     error:function(){
            //         alert("실패");
            //     }
            // });
        });
    });

    // $(".chapter_click").click(function(){
});