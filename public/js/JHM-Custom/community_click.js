$(function () {
    $('tr[data-href]').each(function () {
        $(this).on("click", function() {
            // alert($(this).data('href'));
            $hrefStr = $(this).data('href');

            $hrefArr = $hrefStr.split('/');

            // alert($hrefArr[2]);

            $href = $hrefArr[2];

            // if (jQuery.type($href) === "string") {
            //     alert("STRING");
            // }

            document.location = "/community/" + $href;
        });
    });
});