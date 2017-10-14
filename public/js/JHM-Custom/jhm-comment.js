// 대댓글 [댓글 : comment, 대댓글 : reply]
$(function () {
    $("i[name=arrow]").click(function () {
        if($(this).text()=="keyboard_arrow_down") {
            $(this).text("keyboard_arrow_up");
        } else {
            $(this).text("keyboard_arrow_down");
        }
    });
});