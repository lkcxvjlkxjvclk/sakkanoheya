$(document).ready(function(){
    var map_id = [];
    var img_name = [];
    $('.map_list').click(function(){
        if($(this).hasClass("img_click")){
            // 토글
            $(this).removeClass("img_click");
            map_id.splice(map_id.indexOf($(this).attr("id"),1));
            img_name.splice(img_name.indexOf($(this).attr("src"),1));
        } else {
            // 적용
            $(this).addClass("img_click");
            map_id.push($(this).attr("id"));
            img_name.push($(this).attr("src"));
        }
    });

    $('.map_effect_submit').click(function(){
        $('.affect_map').remove()
        if ( map_id[0]){
            for(var i =0; img_name.length > i ; i++ ){
                var img_path = img_name[i];
                // alert(img_path);
                $('.inner_maps').append('<img src='+img_path+' alt="map image" class="img-circle img-things-size effect_map affect_map" style="margin : 17px">');
                $('.inner_maps').append('<input type="hidden" class="affect_map" name="map_id[]" value="'+map_id[i]+'">');
                $('.inner_maps').append('<input type="text" class="form-control effect_map affect_map" name="effect_map[]" placeholder="内容" style="width:70%; float:right; margin-top:25px">');
                $('.inner_maps').append('<p></p>');
            }  
        }
        else {
        }
    });
});