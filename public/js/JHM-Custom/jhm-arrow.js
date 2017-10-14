$(function () {
    $lastNum = $("h4").length - 3;

    $dataB = parseInt($("a[name=arrow-back]").data("id"));
    $dataF = parseInt($("a[name=arrow-forward]").data("id"));

    if ($dataB-1 < 0) {
        $("a[name=arrow-back]").hide();
        $("a[name=arrow-forward]").show();
    } else if ($dataF+1 >= $lastNum) {
        $("a[name=arrow-back]").show();
        $("a[name=arrow-forward]").hide();
    }
});