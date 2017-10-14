$(function () {
    /**************************************
    /novel/read/novel_read_view.blade.php
    **************************************/
    // 기본 설정은 Web
    // $("ul[name=bookMode]").hide();
    // $("div[name=bookMode]").hide();
    // $("i[name=pageArrow]").hide();

    // span 태그에 걸려있는 속성값 모두 지우기
    $("div[name=webMode]").find("span").removeAttr("class");
    $("div[name=webMode]").find("span").removeAttr("style");
    $("div[name=webMode]").find("span").removeAttr("contenteditable");
    $("div[name=webMode]").find("span").removeAttr("data-color");
    $("div[name=webMode]").find("span").removeAttr("data-id");
    $("div[name=webMode]").find("span").removeAttr("data-case");

    $("div[name=webMode]").css("font-size", 14);
    // $("div[name=webMode]").css("font-family", "Nanum Gothic");
    $("div[name=webMode]").css("font-family", "Noto Sans Japanese");
    $("div[name=webMode]").css("line-height", "170%");
    
    $("div").filter(".example-text").css("line-height", "170%");



    $("button[name=reset]").click(function () {
        $("div[name=webMode]").css("line-height", "170%");
        // $("div[name=webMode]").css("font-family", "Nanum Gothic");
        $("div[name=webMode]").css("font-family", "Noto Sans Japanese");
        $("div[name=webMode]").css("font-size", 14);
        $("div[name=webMode]").css("background", "white");
        $("div[name=webMode]").css("color", "black");

        $("div").filter(".example-text").css("line-height", "170%");
        // $("div").filter(".example-text").css("font-family", "Nanum Gothic");
        $("div[name=webMode]").css("font-family", "Noto Sans Japanese");
        $("div").filter(".example-text").css("font-size", 14);
        $("div").filter(".example-text").css("background", "white");
        $("div").filter(".example-text").css("color", "black");
    });

    $("li").filter(".viewScreen").each(function () {
        $(this).click(function () {
            if ($(this).hasClass("viewOff")) {
                $(this).removeClass("viewOff").addClass("viewOn");
                $(this).siblings().removeClass("viewOn").addClass("viewOff");

                if ($(this).hasClass("webMode")) {
                    // alert("WEB");
                    $("ul[name=bookMode]").hide();

                    $("div[name=bookMode]").hide();
                    $("div[name=webMode]").show();
                } else if ($(this).hasClass("bookMode")) {
                    // alert("BOOK");
                    $("ul[name=bookMode]").show();

                    $("div[name=webMode]").hide();
                    $("div[name=bookMode]").show();
                }
            }
        });
    });

    $("div[name=bookPage]").each(function () {
        if ($(this).hasClass("leftPage")) {
            $(this).mouseenter(function () {
                // alert("LEFT");
                $("i[name=pageArrow]").filter(".arrowLeft").show();
            });
            $(this).mouseleave(function () {
                $("i[name=pageArrow]").filter(".arrowLeft").hide();
            });
        } else if ($(this).hasClass("rightPage")) {
            $(this).mouseenter(function () {
                // alert("RIGHT");
                $("i[name=pageArrow]").filter(".arrowRight").show();
            });
            $(this).mouseleave(function () {
                // alert("RIGHT");
                $("i[name=pageArrow]").filter(".arrowRight").hide();
            });
        }

    });

    $("li").filter(".fontList").each(function () {
        var font = $(this).attr("value");
        $(this).css("font-family", font);
        $(this).click(function () {
            if (!$(this).hasClass("on-font")) {
                $(this).removeClass("off-font").addClass("on-font");
                $(this).siblings().removeClass("on-font").addClass("off-font");
            }

            // var font = $(this).attr("value");
            // alert(font);
            $("div").filter(".example-text").css("font-family", font);
            $("div").filter(".novel-viewer-web").css("font-family", font);
            $("div").filter(".novel-viewer-book").css("font-family", font);
        });
    });

    $("li").filter(".sizeList").each(function () {
        $(this).click(function () {
            if (!$(this).hasClass("on-font")) {
                $(this).removeClass("off-font").addClass("on-font");
                $(this).siblings().removeClass("on-font").addClass("off-font");
            }

            var size = $(this).text();
            // alert(size);
            $("div").filter(".example-text").css("font-size", size);
            $("div").filter(".novel-viewer-web").css("font-size", size);
            $("div").filter(".novel-viewer-book").css("font-size", size);
        });
    });

    $("li").filter(".lineList").each(function () {
        $(this).click(function () {
            if (!$(this).hasClass("on-font")) {
                $(this).removeClass("off-font").addClass("on-font");
                $(this).siblings().removeClass("on-font").addClass("off-font");
            }

            var line = $(this).text();
            // alert(line);
            $("div").filter(".example-text").css("line-height", line);
            $("div").filter(".novel-viewer-web").css("line-height", line);
            $("div").filter(".novel-viewer-book").css("line-height", line);
        });
    });

    $("li").filter(".colorBox").each(function () {
        var color = $(this).attr("value");
        $(this).css("background", color);

        $(this).click(function () {
            if (!$(this).hasClass("on-colorBox")) {
                $(this).removeClass("off-colorBox").addClass("on-colorBox");
                $(this).siblings().removeClass("on-colorBox").addClass("off-colorBox");
            }

            if ($(this).hasClass("font-color")) {
                // var fontColor = $(this).attr("value");
                // alert(fontColor);
                $("div").filter(".example-text").css("color", color);
                $("div").filter(".novel-viewer-web").css("color", color);
                $("div").filter(".novel-viewer-book").css("color", color);
            } else if ($(this).hasClass("back-color")) {
                // var backColor = $(this).attr("value");
                // alert(backColor);
                $("div").filter(".example-text").css("background", color);
                $("div").filter(".novel-viewer-web").css("background", color);
                $("div").filter(".novel-viewer-book").css("background", color);
            }
        });
    });


});