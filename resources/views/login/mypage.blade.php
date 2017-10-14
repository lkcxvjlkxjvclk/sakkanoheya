<style>
.row{
    margin: 150px;
    padding: 100px auto;
}
button.btn-primary {
    background-color: #000;
}
.radio {
    margin: 10px;
    padding: 5px;
}
</style>

@extends('layouts.master')
@section('content')
@include('partials.mySubNavi')

<script>
//포인트 충전 시
$(document).ready(function(){
	$("#point_add").click(function(){
		$.ajax({
			url:'/point',
			success:function(data){
                location.href="/mypage";
                alert("充電成功");
            },
            error:function(){
                alert("充電失敗");
            }
		})
	});
});

// 정보 수정
// $(document).ready(function(){
// 	$("#modify_button").click(function(){
// 		$.ajax({
// 			url:'/modify',
//             // data:{

//             // },
// 			success:function(data){
//                 location.href="/";
//                 alert("변경 성공");
//             },
//             error:function(){
//                 location.href="/mypage";
//                 alert("변경 실패");
//             }
// 		})
// 	});
// });

// 포인트 value값 가져오기
$(document).ready(function(){
    $(".input_radio").on("click",function(){
        $(".input_radio").prop("checked",false);
        $(this).prop("checked",true);

        $(".input_radio").attr("name", null);
        $(this).attr("name","selceted");

    });
});
</script>

<div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">マイページ</div>
            <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="/modify">  
                 <!-- <form class="form-horizontal" role="form" method="POST">  -->
                    {{ csrf_field() }}  
                    @foreach($user_id as $value)
                    <div class="form-group">
                        <label class="col-md-4 control-label">ユーザID</label>
                        <div class="col-md-5">
                            <input id="user_id" value="{{$value->user_id}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">パスワード</label>
                        <div class="col-md-5">
                            <input id="password" name="password" value="{{$value->password}}" type="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">パスワード確認</label>
                        <div class="col-md-5">
                            <input id="password2" value="{{$value->password}}" type="password" class="form-control" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-md-4 control-label">ニックネーム</label>
                        <div class="col-md-5">
                            <input name="name" value="{{$value->name}}" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">メールアドレス</label>
                        <div class="col-md-5">
                            <input id="readonly" value="{{$value->email}}" type="email" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">保有ポイント</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                ポイント充電</button>
                        <div class="col-md-3">
                            <input id="readonly" value="{{$value->point}}" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    @endforeach
                        <div class="form-group"> 
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" id="modify_button" class="btn btn-primary">
                                情報更新
                            </button>

                            <button type="reset" class="btn btn-primary col-md-offset-1">
                                キャンセル
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- 포인트 충천 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <form role="form" method="get" action="/point"> 
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">ポイント充電</h4>
            </div>
                    <!-- 충전창 바디  -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-4">保有ポイント</label><br><br>
                            <div class="col-md-4"><input value="{{$value->point}} Point" class="form-control" readonly></div>
                        </div>
                    </div>
                        <div class="radio">
                            <div class="radio">
                                 <div style="float:left;">
                                    <label>
                                        <input type="radio" class="input_radio" value="1000">
                                        1000ポイント
                                    </label>
                                </div>
                                <div style="float:right;">
                                    <label>
                                        1000円
                                    </label>
                                </div><br><br><br>

                                <div style="float:left;">
                                    <label>
                                        <input type="radio" class="input_radio" value="2000">
                                        2000ポイント
                                    </label>
                                </div>
                                <div style="float:right;">
                                    <label>
                                        2000円
                                    </label>
                                </div><br><br><br> 
                                
                                 <div style="float:left;">
                                    <label>
                                        <input type="radio" class="input_radio" value="3000">
                                        3000ポイント
                                    </label>
                                </div>

                                <div style="float:right;">
                                    <label>
                                        3000円
                                    </label>
                                </div><br><br><br>

                                <div style="float:left;">
                                    <label>
                                        <input type="radio" class="input_radio" value="4000">
                                        4000ポイント
                                    </label>
                                </div>
                                <div style="float:right;">
                                    <label>
                                        4000円
                                    </label>
                                </div><br><br><br>
                                
                                <div style="float:left;">
                                    <label>
                                        <input type="radio" class="input_radio" value="5000">
                                        5000ポイント
                                    </label>
                                </div>
                                <div style="float:right;">
                                    <label>
                                        5000円
                                    </label>
                                </div><br><br><br> 

                            </div>
                        </div>
                <div class="modal-footer">
                    <button type="submit" id="point_add" class="btn btn-primary">充電</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">キャンセル</button> 
                    
                </div>
            </form>
        </div>
    </div>
</div>
<!-- 포인트 충전 끝  -->
@endsection