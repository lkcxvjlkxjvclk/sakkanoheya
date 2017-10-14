function item_info(data) {
    $(function () {
        $("div[name=item-info]").hide();

        $itemView = $("img").closest("div[name=item-view]").attr("name");

        if ($("img").closest("div[name=item-view]").attr("name") == $itemView) {
            $("img").filter(".item_list").each(function () {
                $(this).click(function () {
                    if (!$(this).hasClass("selectedImg")) {

                        $id = $(this).attr("id");
                        $arrayId = $id - 1;
                        // alert($id);
                        
                        $(this).addClass("selectedImg");
                        $(this).siblings().removeClass("selectedImg");


                        // $("div[name=item-view]").find("img").first().css("border", "1px solid red");

                        $("div[name=item-view]").find("img").first().before($(this));
                        $("div").animate({                
                            scrollTop :  0            
                        },  400);

                        $("td[name='item-name']").empty();
                        $("td[name='item-info']").empty();
                        $("td[name='item-category']").empty();
                        $("td[name='item-refer_info']").empty();

                        $("div[name=item-info]").show();

                        $("td[name='item-name']").append(data[$arrayId]['name']);
                        $("td[name='item-info']").append(data[$arrayId]['info']);
                        $("td[name='item-category']").append(data[$arrayId]['category']);
                        $("td[name='item-refer_info']").append(data[$arrayId]['refer_info']);

                    } else {
                        $(this).removeClass("selectedImg");
                        $("div[name=item-info]").hide();

                        $("td[name='item-name']").empty();
                        $("td[name='item-info']").empty();
                        $("td[name='item-category']").empty();
                        $("td[name='item-refer_info']").empty();
                    }

                });
            });
        }

    });
}