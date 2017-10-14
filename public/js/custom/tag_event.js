var event_id = 0;

function tag_click(tag_data, kind){
    $(document).ready(function(){
        $('#tag_submit').hide();
        $('.event_list').click(function() {
            // alert(kind);
            event_id = $(this).attr("id");
            $('#object_id').val(event_id);
            $('#tag_submit').show();
            // alert(tag_data[0]['tag_name']); 

            for ( var i = 0; i < tag_data.length ; i++ ){
                // alert(tag_data[i]['tag_name']);
                if(tag_data[i]['kind'] == kind && tag_data[i]['object_id'] == event_id){
                    $('#tag_name').val(tag_data[i]['tag_name']);
                    $('#chosen-value').val(tag_data[i]['color']);
                }
            }
        });
    });
}
