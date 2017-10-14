<style>
.row{
    margin: 200px;
    padding: 100px auto;
}
</style>

@extends('layouts.master')
@section('content')

<script>
$(document).ready(function(){
    $("#login").click(function(){
        $.ajax({
            url:'/login',
            success:function(data){
                location.href="/";
                alert("ログイン成功");
            },
            error:function(){
                alert("ログイン失敗");
            }
        });
    });
});

</script>

<div id="login_pannel" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ログイン</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/login" method="post"  role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">ユーザID</label>
                        <div class="col-md-5">
                            <input id="id" type="text" class="form-control" name="user_id" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">パスワード</label>
                        <div class="col-md-5">
                            <input id="password" type="password" class="form-control" name="password" required>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <!-- <button id="login" type="submit" class="btn btn-primary" name="login"> -->
                            <button id="login" class="btn btn-primary" name="login">
                                ログイン
                            </button>

                            <a href="/register" class="btn btn-primary col-md-offset-1">
                                会員登録
                            </a>

                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection