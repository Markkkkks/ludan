$(function() 
    { 
    $("input:button").click(function() {
      var but = $(this);

      if($(this).val() == "确定")
      {
 
          if (confirm("确认修改")==true)
          {
                    //获取表格信息，并 输入数据库中 
            var authority = but.parent().prev().children('select').val();
            var identity = but.parent().prev().prev().children('select').val();
            var password = but.parent().prev().prev().prev().children('input:text').val();
            var username = but.parent().prev().prev().prev().prev().children('input:text').val();
            var id = but.parent().prev().prev().prev().prev().prev().text();
           
            changeUser(id,username,password,identity,authority);           //chanmeMessage()
          }
          else
          {
            location.reload();
          } 
      }
        // changeMessage();
      if(!($(this).val() == "删除") && !($(this).val() == "添加新用户"))
      {
        str = (($(this).val()=="编辑")?("确定"):("编辑"));  
        $(this).val(str);   // 按钮被点击后，在“编辑”和“确定”之间切换
        $(this).parent().siblings("td").each(function() {  // 获取当前行的其他单元格
            obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
            obj_button = $(this).find("input:button");
            if(!obj_button.length){
            if(!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                $(this).html("<input type='text' style=\"width:100%;\"value='"+ $(this).text()+"'>");  //width='"+$(this).width()+"'
            else   // 如果已经存在文本框，则将其显示为文本框修改的值
                $(this).html(obj_text.val()); 
        }
        });
        var num = but.parent().prev().prev().prev().prev().prev().children('input:text').val();
        var an = but.parent().prev().children('input:text').val();
        if(an == "管理员")
        {
          var stra = "<select><option value ='0' selected = 'selected'>管理员</option><option value ='1'>普通用户</option><option value ='2'>最高管理员</option></select>";
        }
        else if(an == "普通用户")
        {
          var stra = "<select><option value ='0'>管理员</option><option value ='1' selected = 'selected'>普通用户</option><option value ='2'>最高管理员</option></select>";
        }
        else
        {
          var stra = "<select><option value ='2' selected = 'selected'>最高管理员</option></select>";
        }

        // var stra = "<select><option value ='0'>管理员</option><option value ='1'>普通用户</option><option value ='2' selected = 'selected'>最高管理员</option></select>";
        
        var auth = but.parent().prev().html(stra);

        var isStu = but.parent().prev().prev().children('input:text').val();
        if(isStu == "教职工")
        {
          var ide = "<select><option value='0' selected='selected'>教职工</option><option value='1'>学生</option></select>";
        }
        else
        {
          var ide = "<select><option value='0'>教职工</option><option value='1' selected='selected'>学生</option></select>";
        }

        but.parent().prev().prev().html(ide);
        
        var id = but.parent().prev().prev().prev().prev().prev().html(num);
                
    }
    else if($(this).val() == "删除")
    {
      //进行删除操作
        var name = $(this).parent().prev().prev().prev().prev().prev().text();
        var id = $(this).parent().prev().prev().prev().prev().prev().prev().text();
        if (confirm("确认删除【 "+name+" 】用户？")==true)
        {
            cutUser(id);
        }
        else
        {
            location.reload();
        } 
    }
    else
    {
        var but = $(this);
          //获取表格信息，并 输入数据库中 
        var authority = but.parent().prev().children('select').val();
        var isStu = but.parent().prev().prev().children('select').val();
        var password = but.parent().prev().prev().prev().children('input:text').val();
        var username = but.parent().prev().prev().prev().prev().children('input:text').val();
        // var id = but.parent().prev().prev().prev().prev().children('input:text').val();

        
      //添加新成员的相关操作
        if(username && password)
        {
          if (confirm("添加新用户？")==true) {  
                //调用函数进行修改操作
              addUser(username,password,authority,isStu);

          }
          else
          {
              location.reload();
          }
        }
        else
        {
            confirm("输入必要信息");
            location.reload();
        }

    }   //最后操作
    }); //input:button

//依照数据修改成员信息
      function changeUser(id,username,password,identity,authority){
        // alert(id+username+password+identity+authority);
        var dataString = 'id='+ id + '&username=' + username+ '&password=' + password+ '&identity='+ identity +'&authority=' + authority+ '&method=1'; 
          $.ajax({ 
          type: "POST", 
          url: "changeUser.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if( change == 1)
            {
              confirm("修改成功");
              location.reload();
            }
            else
            {
              confirm("修改失败");
              location.reload();
            }
          } 
          }); 

      }   //修改成员信息

//依照数据删除成员信息
      function cutUser(id){
        var dataString = 'id='+ id + '&operation=0'; 
          $.ajax({ 
          type: "POST", 
          url: "changeUser.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if( cut == 1)
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

      }   //删除成员信息


//依照数据添加成员信息
      function addUser(username,password,authority,isStu){
        // alert(username+password+isStu+authority);
        var dataString = 'username=' + username+ '&password=' + password+ '&authority=' + authority+ '&identity=' + isStu +'&method=1&add=1'; 
          $.ajax({ 
          type: "POST", 
          url: "changeUser.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if( add == 1)
            {
              confirm("添加成功");
              location.reload();
            }
            else
            {
              confirm("添加失败");
              location.reload();
            }
          } 
          }); 

      }   //添加成员信息

});