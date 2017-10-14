$(document).ready(function(){
    var character_id = [];
    var img_name = [];
    $(".character_list").on("click",function(){
        if($(this).hasClass("img_click")){
            // 토글
            $(this).removeClass("img_click");
            character_id.splice(character_id.indexOf($(this).attr("id"),1));
            img_name.splice(img_name.indexOf($(this).attr("src"),1));
        } else {
            // 적용
            $(this).addClass("img_click");
            character_id.push($(this).attr("id"));
            img_name.push($(this).attr("src"));
        }
    });

    $('.character_effect_submit').click(function(){
        $('.affect_character').remove()
        if ( character_id[0]){
            for(var i =0; img_name.length > i ; i++ ){
                var img_path = img_name[i];
                $('.inner_character').append('<img src='+img_path+' alt="item image" class="img-circle img-things-size effect_character affect_character" style="margin : 17px">');
                $('.inner_character').append('<input type="hidden" class="affect_character" name="character_id[]" value="'+character_id[i]+'">');
                $('.inner_character').append('<input type="text" class="form-control effect_character affect_character" name="effect_character[]" placeholder="内容" style="width:70%; float:right; margin-top:25px">');
                $('.inner_character').append('<p></p>');
            }  
        }
        else {
        }
    });
});