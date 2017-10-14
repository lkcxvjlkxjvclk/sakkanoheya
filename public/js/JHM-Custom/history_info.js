function history_info(data) {
    $(function () {
        $("div[name=history-info]").hide();

        $test = $("div").filter("#timeline").attr("id");

        if ($test == $("div").filter("#timeline").attr("id")) {
            $("li[name='event_list']").each(function () {
                $(this).on("click", function () {
                    if (!$(this).hasClass("selectedEvent")) {
                        $arrayId = $(this).attr("id");
                        // alert(data[$arrayId]['id']);
                        // $timetable_id = data[$arrayId]['id'];
                        // alert($timetable_id);

                        $("td[name='event-name']").empty();
                        $("td[name='event-content']").empty();
                        $("ul[name='event-refer_info']").empty();
                        $("td[name='event-other']").empty();
                        $("td[name='event-day']").empty();

                        $("div[name=history-info]").show();

                        $refer_str = data[$arrayId]['refer_info'];
                        // $refer = $refer_str.split("^");

                        $start_day = data[$arrayId]['start_day'];
                        $end_day = data[$arrayId]['end_day']
                        $event_day = $start_day + " ~ " + $end_day;

                        $("td[name='event-name']").append(data[$arrayId]['event_name']);
                        $("td[name='event-content']").append(data[$arrayId]['event_content']);

                        for ($i = 0; $i < $refer.length; $i++) {
                            // $("ul[name='event-refer_info']").append("<li>" + $refer[$i] + "</li>");
                        }

                        $("td[name='event-other']").append(data[$arrayId]['other']);
                        $("td[name='event-day']").append($event_day);
                    } else {
                        $(this).removeClass("selectedEvent");
                        $("div[name=history-info]").hide();
                    }
                });

            });
        }


    });
}