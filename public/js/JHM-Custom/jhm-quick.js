$(function () {
    // 기존 css에서 플로팅 배너 위치(top)값을 가져와 저장한다.
    var floatPosition = parseInt($("#quickMenu").css('top'));

    // 현재 ((윈도우넓이/2) +510) 을 left로 지정
    $("#quickMenu").css("left", ($(window).width() / 2) + 510);

    $(window).scroll(function () {
        // 현재 스크롤 위치를 가져온다.
        var scrollTop = $(window).scrollTop();
        var newPosition = scrollTop + floatPosition + "px";

        // quickMenu 이동 범위 한계 지정한다.
        var limit = parseInt($("#writer-word").position().top) - 500;

        // 애니메이션 없이 바로 따라감
        // $("#quickMenu").css('top', newPosition);

        // $("div").filter("#quickMenu").text("플로팅 메뉴 / " + scrollTop + " / " + newPosition + " / " + limit);

        if (scrollTop > limit) {
            $("#quickMenu").stop();
        } else {
            $("#quickMenu").stop().animate({
                "top": newPosition
            }, 200);
        }

    });
    // }).scroll();

    $("option").filter(".quickList").each(function () {
        $url = $(location).attr("href");
        $string = $url.split("&");

        $currentEpi = $string[1];

        if ($(this).attr("name") == $currentEpi) {
            $(this).prop("selected", true);
        }

    });

    $("#remoteMenu").click(function () {
        if (!$(this).hasClass("fa fa-plus-square-o")) {
            $(this).attr("class", "fa fa-plus-square-o");
        } else {
            $(this).attr("class", "fa fa-minus-square-o");
        }
    });

    $("#remoteUp").click(function () {
        // $("body").animate({ "bottom": "+=150px" }, 100);
        $("html, body").scrollTop(0);
    });
    $("#remoteDown").click(function () {
        // $("body").animate({ "bottom": "-=150px" }, 100);
        $("html, body").scrollTop(document.body.scrollHeight);
    });
});