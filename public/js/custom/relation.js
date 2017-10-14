$( function() {

  var DragDropManager = {
   draggedObj: null,
   onDroppable: null,
   isObjOnDroppable: function() {
    //  if (this.onDroppable && draggedObj!=null)
    //   return true;
    //  else
    //   return false;
    return true;
   }
  };

  // svg위에 마우스 올렸는지 체크
  svg.on('mouseover',function(d,i){
  	DragDropManager = true;
  });

  // svg위에 마우스 없는지 체크
  svg.on('mouseOut',function(e){
  	DragDropManager = false;
  });

  $( ".draggable" ).draggable({
   revert: true,
   revertDuration: 500,
   cursorAt: { left: -2, top: -2 },

   // Register what we're dragging with the drop manager
   start: function (e) {
     // draggable의 데이터 입력
     DragDropManager.draggedObj = d3.select(e.target).attr("src");
   },
   // 이동속도 조절
   drag: function (e) {
     // stop까지의 속도
     $(e.target).draggable("option","revertDuration", DragDropManager.isObjOnDroppable() ? 0 : 500)
   },
   // drag가 끝난 후 판단
   stop: function (e,ui) {

     // Dropped on a non-matching target.
     if (!DragDropManager.draggedMatchesTarget()) return;
     $(e.target).draggable("disable");

   }
  });


  $( ".droppable" ).droppable({
     drop: function( event, ui ) {
       //Get the position before changing the DOM
       var p1 = ui.draggable.parent().offset();
       //Move to the new parent
       $(this).append(ui.draggable);
       //Get the postion after changing the DOM
       var p2 = ui.draggable.parent().offset();
       //Set the position relative to the change
       ui.draggable.css({
         top: parseInt(ui.draggable.css('top')) + (p1.top - p2.top),
         left: parseInt(ui.draggable.css('left')) + (p1.left - p2.left)
       });
     }
   });


} );

// d3.js
