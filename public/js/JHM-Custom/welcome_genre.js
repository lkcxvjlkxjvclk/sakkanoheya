$(function () {
    $("input[name='genre']").each(function () {
        $welcomeStr = $(this).val();
        $welcomeGenre = $.trim($welcomeStr);

        if ($welcomeGenre == "martial") {
            $welcomeGenre = "武侠";
        } else if ($welcomeGenre == "fantasy") {
            $welcomeGenre = "ファンタジー";
        } else if ($welcomeGenre == "romance") {
            $welcomeGenre = "ロマンス";
        } else if ($welcomeGenre == "scifi") {
            $welcomeGenre = "SF";
        } else if ($welcomeGenre == "horror") {
            $welcomeGenre = "ホラー";
        } else if ($welcomeGenre == "detective") {
            $welcomeGenre = "推理";
        } else if ($welcomeGenre == "agenovel") {
            $welcomeGenre = "歴史";
        } 

        $(this).siblings("h3[name='genre']").append($welcomeGenre);
        $(this).siblings("h5").append($welcomeGenre);
    });
});