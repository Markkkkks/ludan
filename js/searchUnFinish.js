$(function() 
    { 
      $("input:button").click(function() {
        var but = $(this);

        
        if($(this).val() == "删除")
        {

            if (confirm("确认删除?")==true)
            {
              var room = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
              var time = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
              deleteRecord(room, time);
            }
            else
            {
              location.reload();
            } 
        }

      }); 

      function deleteRecord(room, time){
        var dataString = 'room='+ room + '&time=' + time + '&method=1'; 
          $.ajax({ 
          type: "POST", 
          url: "changeRecord.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if( del == 1)
            {
              confirm("删除成功");
              location.reload();
            }
            else
            {
              confirm("删除失败");
              location.reload();
            }
          } 
          }); 

      }
});