$(function () {
    // GOOGLE MATERIAL-ICONS <i>
    $("i[name=bookmark]").click(function () {
        // text() & color Change
        if ($(this).text() == "bookmark_border") {
            $(this).text("bookmark");
            $(this).addClass("selectedBookmark");
        } else {
            $(this).removeClass("selectedBookmark");
            $(this).text("bookmark_border");
        }
    });

    $("i[name=star]").click(function () {
        // text() & color Change
        if ($(this).text() == "star_border") {
            $(this).text("star");
            $(this).addClass("selectedIcon");
        } else {
            $(this).removeClass("selectedIcon");
            $(this).text("star_border");
        }
    });

    $("i[name=favorite]").click(function () {
        // text() & color Change
        if ($(this).text() == "favorite_border") {
            $(this).text("favorite");
            $(this).addClass("selectedFavorite");
        } else {
            $(this).removeClass("selectedFavorite");
            $(this).text("favorite_border");
        }
    });

    $("i[name=thumb]").click(function () {
        // color Change
        if (!$(this).hasClass("selectedIcon")) {
            $(this).addClass("selectedIcon");
            $("span").filter(".thumb-text").addClass("selectedIcon");
        } else {
            $(this).removeClass("selectedIcon");
            $("span").filter(".thumb-text").removeClass("selectedIcon");
        }
    });

    $("i[name=check]").each(function () {
        $(this).click(function () {
            // Color Change
            if (!$(this).hasClass("selectedIcon")) {
                $(this).addClass("selectedIcon");
                $(this).parent().siblings().children("i").removeClass("selectedIcon");
            }
        });
    });
});