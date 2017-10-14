$(function () {
    $("a[name='blog_click']").each(function () {
        $(this).click(function (event) {
            event.preventDefault();

            $ownerStr = $(this).children("input[name='blog_owner_id']").val();
            $hrefStr = $(this).children("input[name='blog_href']").val();

            let ajax_url = "/blog/" + $hrefStr;

            // alert(ajax_url);


            // IF $hrefStr in &
            // blog_menu_id&post_id
            if ($hrefStr.match("&")) {
                // alert("IT IS BOARD'S HREF!");
                $hrefArr = $hrefStr.split("&");

                $blog_menu_id = $hrefArr[0];
                $post_id = $hrefArr[1];

                // alert(ajax_url);

                $("div[name='blog_post']").empty();

                // var data;

                $.ajax({
                    url: ajax_url,
                    dataType: "json",
                    success: function(data){
                        // alert(JSON.stringify(data));

                        // alert(data[0]['id']);

                        var append_data = "<div>";

                        append_data += "    <div class='board_title'>";

                        append_data += "        <ul class='list-inline'>";

                        if (data[0]['is_notice'] == "on") {
                            append_data += "        <li><strong>[ノーティス]</strong></li>";
                        }

                        append_data += "            <li>";
                        append_data += "                <h4>";
                        append_data += "                    <strong>" + data[0]['board_title'] + "</strong>";
                        append_data += "                </h4>";
                        append_data += "            </li>";

                        append_data += "            <li>";
                        append_data += "                <small>| " + data[0]['menu_title'] + "</small>";
                        append_data += "            </li>";

                        append_data += "            <li class='board_timestamp'>";
                        append_data += "                <small>" + data[0]['created_at'] + "</small>";
                        append_data += "            </li>";

                        append_data += "        </ul>";

                        append_data += "    </div>";

                        append_data += "    <div name='title-line' style='border-top: 1px solid rgba(149, 152, 154, .5);'></div>";

                        append_data += "    <div class='board_content'>";
                        append_data += "        <div id='default-padding-big'></div>";
                        append_data +=          data[0]['board_content'];
                        append_data += "    </div>";

                        append_data += "    <div class='text-center'>";
                        // append_data += data;
                        append_data += "    </div>";

                        append_data += "<div class='text-center'>";
                        append_data += "";
                        append_data += "</div>";

                        append_data += "    </div>";

                        $("div[name='blog_post']").append(append_data);
                    }
                });
            } else {
                //
            }
            // alert($hrefStr);
        });
    });
});
