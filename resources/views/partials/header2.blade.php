<article>
	<header>
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
							<li><a href="#today-novel">오늘의 웹소설</a></li>
							<li><a href="#best-novel">베스트 웹소설</a></li>
							<li><a href="#event">이벤트</a></li>
							<li><a href="#about">고객센터</a></li>
							<li><a href="/">로그인</a></li>

						@if (Auth::guest())
							<li><a href="/write_novel/my_novel">마이페이지</a></li>
              {{-- <li><a href="{{ route('login') }}">로그아웃</a></li> --}}
                    @else
                        {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        로그아웃
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li> --}}
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
                        @endif
							{{-- <li><a href="/login">로그인</a></li>--}}
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
</article>
