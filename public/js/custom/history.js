/*************************************************
 * Make By JeongJaeHun
 * 2017.07.27 주석 작업
 * <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 * 해당 구문 호출 이후
 * history.js 를 include 시킨 이후, ready(data) function 호출
 * data[] 는 event_name, start_day, end_day 를 연관 배열 형식으로 가지고 있어야한다.
 * 그래프를 호출하게 될 div의 id 는 timeline 으로 정의한다.
 * ready(data,num=null) num에 양의 정수를 준후
 * timetable2와 같은 형식으로 사용 시 여러개의 timetable호출 가능
 * <script> ready( <?=json_encode($data)?>,2 );</script>
 * 기타 변경 사항은 JeongJaeHun 에게 문의 바랍니다.
 ************************************************/

google.charts.load('current', {'packages':['timeline']});

function ready(data, num=null){
	var datas = data;

	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {

	// console.log(datas[0]['event_name']);
	var arrayLength = datas.length;


	var events = new Array();


	// 차트가 생성될 div 태그의 id값을 timeline으로 설정
	var container = document.getElementById(num==null ? 'timeline' : 'timeline' + num);
	var chart = new google.visualization.Timeline(container);
	var dataTable = new google.visualization.DataTable();

	dataTable.addColumn({ type: 'string', id: 'President', name : '123213' });
	dataTable.addColumn({ type: 'date', id: 'Start' });
	dataTable.addColumn({ type: 'date', id: 'End' });

	for ( var i = 0; i < arrayLength ; i++ ){
		dataTable.addRows([
			[datas[i]['event_name'], new Date(datas[i]['start_day']), new Date(datas[i]['end_day'])],
		]);
	}
	// dataTable.addRows([
	// [ 'Washington', new Date(1789,03, 30), new Date(1797, 2, 4) ],
	// [ 'Adams',      new Date(1797, 2, 4),  new Date(1801, 2, 4) ],
	// [ 'Jefferson',  new Date(1801, 2, 4),  new Date(1809, 2, 4) ]
	// ]);

	// chart.addOneTimeListner();
	chart.draw(dataTable);
	}
}
