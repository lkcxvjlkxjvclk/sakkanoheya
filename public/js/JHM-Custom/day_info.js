function day_info(data) {
    $(function () {
        $aDay = $.trim(data[0]["period"]);

        $dayStr = $aDay.split("/");

        if ($dayStr.indexOf("mon") != -1) {
            $i = jQuery.inArray("mon", $dayStr);
            $dayStr.splice($i, 1, "月");

            $("b[name='upload_day']").append("&nbsp;月&nbsp;");
        }

        if ($dayStr.indexOf("tue") != -1) {
            $i = jQuery.inArray("tue", $dayStr);
            $dayStr.splice($i, 1, "火");

            $("b[name='upload_day']").append("&nbsp;火&nbsp;");
        }

        if ($dayStr.indexOf("wed") != -1) {
            $i = jQuery.inArray("wed", $dayStr);
            $dayStr.splice($i, 1, "水");

            $("b[name='upload_day']").append("&nbsp;水&nbsp;");
        }

        if ($dayStr.indexOf("thu") != -1) {
            $i = jQuery.inArray("thu", $dayStr);
            $dayStr.splice($i, 1, "木");

            $("b[name='upload_day']").append("&nbsp;木&nbsp;");
        }

        if ($dayStr.indexOf("fri") != -1) {
            $i = jQuery.inArray("fri", $dayStr);
            $dayStr.splice($i, 1, "金");

            $("b[name='upload_day']").append("&nbsp;金&nbsp;");
        }

        if ($dayStr.indexOf("sat") != -1) {
            $i = jQuery.inArray("sat", $dayStr);
            $dayStr.splice($i, 1, "土");

            $("b[name='upload_day']").append("&nbsp;土&nbsp;");
        }

        if ($dayStr.indexOf("sun") != -1) {
            $i = jQuery.inArray("sun", $dayStr);
            $dayStr.splice($i, 1, "日");

            $("b[name='upload_day']").append("&nbsp;日&nbsp;");
        }
    });
}