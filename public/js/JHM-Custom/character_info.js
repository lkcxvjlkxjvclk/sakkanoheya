function character_info(data) {
    $(function () {
        $("div[name=character-info]").hide();

        $characterView = $("img").closest("div[name=character-view]").attr("name");

        if ($("img").closest("div[name=character-view]").attr("name") == $characterView) {
            $("img").filter(".character_list").each(function () {
                $(this).click(function () {
                    if (!$(this).hasClass("selectedImg")) {
                        $id = $(this).attr("id");
                        $arrayId = $id - 1;
                        // alert($arrayId);
                        $(this).addClass("selectedImg");
                        $(this).siblings().removeClass("selectedImg");

                        $("div[name=character-view]").find("img").first().before($(this));
                        $("div").animate({                
                            scrollTop :  0            
                        },  400);

                        $("td[name='character-name']").empty();
                        $("td[name='character-age']").empty();
                        $("td[name='character-gender']").empty();
                        $("td[name='character-info']").empty();
                        $("td[name='character-refer_info']").empty();

                        $("div[name=character-info]").show();

                        $("td[name='character-name']").append(data[$arrayId]['name']);
                        $("td[name='character-age']").append(data[$arrayId]['age']);
                        $("td[name='character-gender']").append(data[$arrayId]['gender']);
                        $("td[name='character-info']").append(data[$arrayId]['info']);
                        $("td[name='character-refer_info']").append(data[$arrayId]['refer_info']);


                    } else {
                        $(this).removeClass("selectedImg");
                        $("div[name='character-info']").hide();
                        $("td[name='character-name']").empty();
                        $("td[name='character-age']").empty();
                        $("td[name='character-gender']").empty();
                        $("td[name='character-info']").empty();
                        $("td[name='character-refer_info']").empty();
                    }

                });
            });
        }

    });
}