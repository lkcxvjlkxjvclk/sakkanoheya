<div class="default-padding"></div>

<ul class="nav nav-pills my-sub-navigation">
        <li role="presentation"><a href="#" class="sub">最近見た小説</a></li>
        <li role="presentation"><a href="#" class="sub">関心小説</a></li>
        <li role="presentation"><a href="#" class="sub">ブックマーク</a></li>
        <li role="presentation" id="write_novel"><a href="/write_novel/my_novel" class="sub">私の小説</a></li>
        <li role="presentation"><a href="/yerriel/blog" class="sub">ブログ</a></li>
        <li role="presentation"><a href="/mypage" class="sub">個人情報</a></li>
        {{--  <li class="background" role="button" id="background"><a href="/background" class="sub">소설설정</a></li>  --}}
</ul>
    
<script>
    $pathname = $(location).attr('pathname'); 
    $pathname = $pathname.split('/');
    console.log($pathname[1]);
    $("#"+$pathname[1]).css("background-color","#FABD4A");
    $("#"+$pathname[1]).css("border-radius","70px");
</script>
