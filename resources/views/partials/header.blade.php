
</script>
<article>
	<header>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
	$(".logout").click(function(){
		alert("ログアウト成功");
	});
});

// $(document).ready(function(){
// 	$(".logout").click(function(){
// 		$.ajax({
// 			url:'/logout',
// 			success:function(data){
// 				location.href="/"
//                 alert("로그아웃 성공");
//             },
//             error:function(){
//                 alert("실패");
//             }
// 		})
// 	});
// });
</script>
		<style type="text/css">
			@font-face {
				font-family:nav-font; src: url('{{ asset('../public/fonts/APJapanesefontH.ttf') }}');
			}
		</style>
			<div class="main-navigation navbar-fixed-top">
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<a class="" href="/">
							<img alt="" src="/img/logo.png" style="width:10%">
						</a>
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="/">Home</a></li>
							{{-- SESSION의 user_id string 으로 변경하기 --}}
								<li><a href="/yerriel/blog">ブログ</a></li>
							<li><a href="#event">イベント</a></li>
							<li><a href="#about">ヘルプ</a></li>

							@if(Session::has('user_id'))
								<li><a class="logout" href="/logout">ログアウト</a></li>
								<li><a href="/write_novel/my_novel">マイページ</a></li>
							@else
								<li><a class="login" href="/login">ログイン</a></li>
								<li><a href="/register">会員登録</a></li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
</article>
