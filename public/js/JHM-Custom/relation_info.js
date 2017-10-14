function relation_info(data) {
    $(function () {
        $("div[name='relation-info']").hide();

        $test = $("div[name='relation-view']").attr("name");

        if ($test == $("div[name='relation-view']").attr("name")) {
            $("img").filter(".relation_list").each(function () {
                $(this).on("click", function () {
                    if (!$(this).hasClass("selectedRelation")) {
                        $("div[name=relation-info]").show();

                        $src = $(this).attr("src");
                        $imgId = $(this).attr("id");

                        // alert($src);
                        // alert($imgId);

                        $img = "<img src='" + $src + "' alt='relation image' class='text-right' id='" + $imgId + "'>";

                        // alert($img);

                        $("div[name=relation-info]").empty();

                        $("div[name=relation-info]").append($img);
                    } else {
                        $("div[name=relation-info]").hide();
                    }
                });
            });
        }
    });
}