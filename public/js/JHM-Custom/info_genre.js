function info_genre(data) {
    $(function () {
        $infoGenre = $.trim(data[0]['genre']);

        if ($infoGenre == "martial") {
            $infoGenre = "武侠";
        } else if ($infoGenre == "fantasy") {
            $infoGenre = "ファンタジー";
        } else if ($infoGenre == "romance") {
            $infoGenre = "ロマンス";
        } else if ($infoGenre == "scifi") {
            $infoGenre = "SF";
        } else if ($infoGenre == "horror") {
            $infoGenre = "ホラー";
        } else if ($infoGenre == "detective") {
            $infoGenre = "推理";
        } else if ($infoGenre == "agenovel") {
            $infoGenre = "歴史";
        } 

        $("b[name='genre']").append($infoGenre);

    });
}