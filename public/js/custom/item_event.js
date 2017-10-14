var event_id = 0;

function item_event(data){
    $(document).ready(function(){
        $("img[name=item_icon]").each(function(e,i){
            $(this).click(function(){
                if(!$(this).hasClass("selected")){
                    $(this).addClass("selected");
                   
                    $(this).siblings().removeClass("selected");
                }
                // console.log(e);
                event_id = $(this).attr("id")-1;
                $('.refer_info').remove();
                $('#name').text("事物情報");
                $('#item_name').val(data[e]['name']);
                $('#item_cate').val(data[e]['category']);
                $('#item_content').val(data[e]['info']);
                if(data[e]['refer_info'].length>1){
                    for( var i = 0; data[e]['refer_info'].length > i ; i++){
                        // alert(data[event_id]['refer_info'][i]);
                        $('.refer_info_div').append('<input type="text" class="form-control refer_info" name="refer_info[]" id='+i+' value="'+data[event_id]['refer_info'][i]+'">');
                    }
                }
                else {
                    $('.refer_info_div').append('<input type="text" class="form-control refer_info" name="refer_info[]" id='+i+' value="'+data[event_id]['refer_info']+'">');
                }
            });
        });
    });
}