$(document).ready(function(){
    var item_id = [];
    $('.ownership_list').click(function(){
        item_id.push($(this).attr("id"));
        $(this).css("border","2px solid red");
    });

    $('.ownership_submit').click(function(){
        // alert(item_id);
        // alert($("#character_id").val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url : "character/ownership",
            data : { item_id : item_id,
                    character_id : $("#character_id").val() },
            success:function(data){
                window.location.reload(true);
            },
            error:function(){
                alert("실패");
            }
        });
    });
});