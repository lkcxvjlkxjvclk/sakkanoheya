$(document).ready(function(){
    $('#additional_items').click(function() {
        $('.refer_info_div').append('<input type="text" class="form-control" name="refer_info[]" placeholder="additional">');    
    });
});
