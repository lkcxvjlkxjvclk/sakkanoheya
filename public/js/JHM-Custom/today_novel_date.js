function today_novel_date(data) {
    $(function () {
        // TODAY'S DATE
        $current = new Date();


        $("input[name='novel_period']").each(function () {
            // NOVEL'S PERIOD INPUT HIDDEN VALUE
            // /DAY1/DAY2 etc.
            $periodStr = $(this).val();
            // alert($periodStr);

            //if (!empty($periodStr)) {
            // , DAY1, DAY2 etc.
            $periodArr = $periodStr.split("/");
            // alert($periodArr); 

            // REMOVE $periodArr 1st item
            // OUTPUT IS WHITE SPACE
            $periodBlank = $periodArr.shift();

            // $periodArr TYPE Array
            // $period TYPE String
            $period = $periodArr.toString();

            $ttt = $period.match(/tue/g);
            $lll = jQuery.inArray("tue", $period.match(/tue/g));

            $ttt2 = $period.match(/wed/g);
            $lll2 = jQuery.inArray("wed", $period.match(/wed/g));

            $ttt3 = $period.match(/fri/g);
            $lll3 = jQuery.inArray("fri", $period.match(/fri/g));

            // match() OUTPUT TYPE Array
            

            if ($period.match(/mon/g)) {
                $date = "mon";
                $search = jQuery.inArray($date, $period.match(/mon/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/tue/g)) {
                $date = "tue";
                $search = jQuery.inArray($date, $period.match(/tue/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/wed/g)) {
                $date = "wed";
                $search = jQuery.inArray($date, $period.match(/wed/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/thu/g)) {
                $date = "thu";
                $search = jQuery.inArray($date, $period.match(/thu/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/fri/g)) {
                $date = "fri";
                $search = jQuery.inArray($date, $period.match(/fri/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/sat/g)) {
                $date = "sat";
                $search = jQuery.inArray($date, $period.match(/sat/g));
                $(this).closest("div").addClass($date);
            } else if ($period.match(/sun/g)) {
                $date = "sun";
                $search = jQuery.inArray($date, $period.match(/sun/g));
                $(this).closest("div").addClass($date);
            }
            
            
            //}
        });


        $("div").filter(".filimg").each(function () {
            $(this).click(function (event) {
                // <a></a> EVENT STOP
                event.preventDefault();

                $test = $(this).attr("class");
                alert($test);
            });
        });

        // DAY CIRCLE <li></li>
        $("li[name=dayCircle]").each(function () {
            // DAY CIRCLE CLICK ON/OFF
            $(this).click(function () {
                $(this).addClass("selectedDay");
                $(this).siblings().removeClass("selectedDay");
                // alert("CLICK");
                // if ($data[$i]['period']) {
                //     $data[$i]['string']  = explode('/', $data[$i]['period']);
                //     $data[$i]['periodStr'] = array_slice($data[$i]['string'], 1);
                // }
                alert($current.toDateString());
                // 요일 빼놓고 explode 팡팡!
            });
        });


    });
}