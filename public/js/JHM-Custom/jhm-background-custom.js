$(function () {
    $background = "#" + $("i").filter(".selectedIcon").closest("div").attr("data-name");

    $("div").filter($background).show();
    $("div").filter($background).siblings("div .col-md-11").hide();

    $("i[name=backgroundIcon]").each(function () {
        $(this).click(function () {
            $viewName = "#" + $(this).closest("div").attr("data-name");
            $view = $("div").filter($viewName);
            // alert($stt);

            $view.slideToggle("slow");

            if (!$(this).hasClass("selectedIcon")) {
                $(this).addClass("selectedIcon");
                $(this).closest("div").siblings().find("i").removeClass("selectedIcon");

                $newData = "#" + $("i").filter(".selectedIcon").closest("div").attr("data-name");
                $("div").filter($newData).show();
                $("div").filter($newData).siblings("div .col-md-11").hide();
            } else {
                $(this).removeClass("selectedIcon");
            }

        });
    });



});