var event_id = 0;

function timetableEvent(data){
    $(document).ready(function(){
        $('#submit_delete').hide();
        $('.event_list').click(function() {
                event_id = $(this).attr("id");
                $('.refer_info').remove();
                
                $('#name').text("事件情報");
                $('#event_name').val(data[event_id]['event_name']);
                $('#event_content').val(data[event_id]['event_content']);
                if(data[event_id]['refer_info'].length>1){
                    // alert(data[event_id]['refer_info'][1]);
                    for( var i = 0; data[event_id]['refer_info'].length > i ; i++){
                        // alert(data[event_id]['refer_info'][i]);
                        $('.refer_info_div').append('<input type="text" class="form-control refer_info" name="refer_info[]" id='+i+' value="'+data[event_id]['refer_info'][i]+'">');
                    }
                }
                else {
                    $('.refer_info_div').append('<input type="text" class="form-control refer_info" name="refer_info[]" id='+i+' value="'+data[event_id]['refer_info']+'">');
                }
                // id 값의 버그, join 시 +1된 id값이 나옴.
                $('#timetable_id').val(data[event_id]['id']);
                // alert(data[event_id]['id']);
                $('#start_day').val(data[event_id]['start_day']);
                $('#end_day').val(data[event_id]['end_day']);
                // $('#character').val(data[event_id]['character']);
                // $('#item').val(data[event_id]['items']);
                // $('#place').val(data[event_id]['places']);
                $('#other').val(data[event_id]['other']);
                $('#submit_history').text("submit");
                $('#submit_delete').show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url : "historyTable/getEffect",
                    data : {
                            timetable_id : data[event_id]['id']
                        },
                    success:function(data){
                        // alert(data);
                        $('.affect').remove();
                        for(var i = 0; i < data.length; i++){
                            // console.log(data[i]['img_src']);
                            if(data[i]['affect_table']=="characters"){
                                var img_path = "/img/background/characterImg/"+data[i]['img_src'];
                                $('.inner_character').append('<img src='+img_path+' alt="character image" class="img-circle img-things-size affect" style="margin : 17px">');
                                $('.inner_character').append('<input type="text" class="form-control affect" id="cha'+data[i]['affect_id']+'" name="effect_character[]" placeholder="내용" style="width:70%; float:right; margin-top:25px">');
                                $('#cha'+data[i]['affect_id']+'').val(data[i]['affect_content']);
                            }
                            if(data[i]['affect_table']=="items"){
                                var img_path = "/img/background/itemImg/"+data[i]['img_src'];
                                $('.inner_items').append('<img src='+img_path+' alt="item image" class="img-circle img-things-size affect" style="margin : 17px">');
                                $('.inner_items').append('<input type="text" class="form-control affect" id="item'+data[i]['affect_id']+'" name="effect_item[]" placeholder="내용" style="width:70%; float:right; margin-top:25px">');
                                $('#item'+data[i]['affect_id']+'').val(data[i]['affect_content']);
                            }

                            if(data[i]['affect_table']=="maps"){
                                var img_path = "/img/background/mapImg/mapCover/"+data[i]['img_src'];
                                $('.inner_maps').append('<img src='+img_path+' alt="map image" class="img-circle img-things-size affect" style="margin : 17px">');
                                $('.inner_maps').append('<input type="text" class="form-control affect" id="map'+data[i]['affect_id']+'" name="effect_map[]" placeholder="내용" style="width:70%; float:right; margin-top:25px">');
                                $('#map'+data[i]['affect_id']+'').val(data[i]['affect_content']);
                            }

                            if (data[i]['affect_table'] == "relations") {
                                var img_path = "/img/background/relationImg/" + data[i]['img_src'];
                                $('.inner_relations').append('<img src=' + img_path + ' alt="relation image" class="img-circle img-things-size affect" style="margin : 17px">');
                                $('.inner_relations').append('<input type="text" class="form-control affect" id="relation' + data[i]['affect_id'] + '" name="effect_relation[]" placeholder="내용" style="width:70%; float:right; margin-top:25px">');
                                $('#relation'+data[i]['affect_id']+'').val(data[i]['affect_content']);
                            }
                        }
                    },
                    error: function (request, status, error){
                        alert("code:" + request.status + "\n" +  "\n" + "error:" + error);
                    }
                });
        });
    });
}
