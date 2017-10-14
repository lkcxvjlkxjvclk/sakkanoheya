$(document).ready(function(){
    var item_id = [];
    var img_name = [];
    $('.item_list').click(function(){
        if($(this).hasClass("img_click")){
            // 토글
            $(this).removeClass("img_click");
            item_id.splice(item_id.indexOf($(this).attr("id"),1));
            img_name.splice(img_name.indexOf($(this).attr("src"),1));
        } else {
            // 적용
            $(this).addClass("img_click");
            item_id.push($(this).attr("id"));
            img_name.push($(this).attr("src"));
        }
    });

    $('.item_effect_submit').click(function(){
        $('.affect_item').remove()
        if (item_id[0]){
            for(var i =0; img_name.length > i ; i++ ){
                var img_path = img_name[i];
                $('.inner_items').append('<img src='+img_path+' alt="item image" class="img-circle img-things-size effect_item affect_item" style="margin : 17px">');
                $('.inner_items').append('<input type="hidden" class="affect_item" name="item_id[]" value="'+item_id[i]+'">');
                $('.inner_items').append('<input type="text" class="form-control effect_item affect_item" name="effect_item[]" placeholder="内容" style="width:70%; float:right; margin-top:25px">');
                $('.inner_items').append('<p></p>');
            }  
        }
        else {
        }
    });
});