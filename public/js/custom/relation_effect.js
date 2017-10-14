$(document).ready(function () {
    var relation_id = [];
    var img_name = [];
    $('.relation_list').click(function () {
        if ($(this).hasClass("img_click")) {
            // 토글
            $(this).removeClass("img_click");
            relation_id.splice(relation_id.indexOf($(this).attr("id"), 1));
            img_name.splice(img_name.indexOf($(this).attr("src"), 1));
        } else {
            // 적용
            $(this).addClass("img_click");
            relation_id.push($(this).attr("id"));
            img_name.push($(this).attr("src"));
        }
    });

    $('.relation_effect_submit').click(function () {
        $('.affect_relation').remove()
        if (relation_id[0]) {
            for (var i = 0; img_name.length > i; i++) {
                var img_path = img_name[i];
                // alert(img_path);
                $('.inner_relations').append('<img src=' + img_path + ' alt="map image" class="img-circle img-things-size effect_relation affect_relation" style="margin : 17px">');
                $('.inner_relations').append('<input type="hidden" class="affect_relation" name="relation_id[]" value="' + relation_id[i] + '">');
                $('.inner_relations').append('<input type="text" class="form-control effect_relation affect_relation" name="effect_relation[]" placeholder="内容" style="width:70%; float:right; margin-top:25px">');
                $('.inner_relations').append('<p></p>');
            }
        } else {}
    });
});