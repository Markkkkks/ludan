var idShow;

$(function() 
{ 
  $("input:button").click(
    function() 
    {
    	var but = $(this);

    	if($(this).val() == "确定")
      {
 
        if (confirm("确认修改?")==true)
        {
          //获取表格信息，并 输入数据库中
          var offer = but.parent().prev().prev().children('input:text').val();
          var graduateWork = but.parent().prev().prev().prev().children('input:text').val();
          var contact = but.parent().prev().prev().prev().prev().children('input:text').val();
          var timeOut = but.parent().prev().prev().prev().prev().prev().children('input:text').val();
          var timeIn = but.parent().prev().prev().prev().prev().prev().prev().children('input:text').val();
          var profession = but.parent().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
          var grade = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
          var hometown = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
          var name = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
          var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
             			//调用函数进行修改操作
          changeMember(id,name,hometown,grade,profession,timeIn,timeOut,contact,graduateWork,offer);						//chanmeMessage()
        }
        else
        {
        	location.reload();
        } 
      }


    		// changeMessage();
    	if(!($(this).val() == "删除") && !($(this).val() == "添加新成员") && !($(this).val() == "查看") && !($(this).val() == "编辑评价") && !($(this).val() == "确认修改"))
      {
        str = (($(this).val()=="编辑")?("确定"):("编辑"));  
        $(this).val(str);   // 按钮被点击后，在“编辑”和“确定”之间切换
        $(this).parent().siblings("td").each(
          function() {  // 获取当前行的其他单元格
            obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
            obj_button = $(this).find("input:button");
            obj_link = $(this).find("a");
            if(!obj_button.length && !obj_link.length)
            {
              if(!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                $(this).html("<input type='text' style=\"width:100%;\"value='"+ $(this).text()+"'>");  //width='"+$(this).width()+"'
              else   // 如果已经存在文本框，则将其显示为文本框修改的值
                $(this).html(obj_text.val()); 
            }
          }
        );

        // var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().html
        //       ("<input type='text' disabled=\"readonly\" style=\"width:100%;\"value='"+ n+"'>");
        var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
        but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html(id);
                
      }
      else if($(this).val() == "删除")
      {
    	//进行删除操作
    		var name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
       	var number = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
        if(confirm("确认删除成员【 "+name+"--"+number+" 】？")==true)
        {
       		deleteMem(number);
        }
        else
        {
        	location.reload();
        } 
      }
      else if($(this).val() == "添加新成员")
      {
	 	  	var but = $(this);
        var comment = but.parent().prev().children('input:text').val();
        var offer = but.parent().prev().prev().children('input:text').val();
        var graduateWork = but.parent().prev().prev().prev().children('input:text').val();
        var contact = but.parent().prev().prev().prev().prev().children('input:text').val();
        var timeOut = but.parent().prev().prev().prev().prev().prev().children('input:text').val();
        var timeIn = but.parent().prev().prev().prev().prev().prev().prev().children('input:text').val();
        var profession = but.parent().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
        var grade = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
        var hometown = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
        var name = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
    	  var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
  
         
    	 //添加新成员的相关操作
    	 if(id && name && hometown && grade && profession)
       {
        if(confirm("添加新成员信息？")==true)
        {
       		addMember(id,name,hometown,grade,profession,timeIn,timeOut,contact,graduateWork,offer, comment);
       	}
        else
        {
          return;
       	}
    	 }
       else
       {
    		  confirm("输入必要信息");
          return;
    	 }
    }
    else if($(this).val() == "查看")
    {
      var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
      idShow = id;
      var com = showComment(id);
      var name = com.pop();
      var comment = com.pop();


      document.getElementById("comHeader").innerHTML = comment;
      document.getElementById("comBy").innerHTML = "---" + name;

      var winWidth = document.documentElement.clientWidth;
      var winHeight = document.documentElement.clientHeight;
      var div = document.getElementById("comment");
      div.style.display = "block";
      div.style.left = winWidth / 3 + "px";
      div.style.top = winHeight / 3 + "px";
      div.style.display = "block";
      document.getElementById("overDiv").style.display = "block";
    }
    else if($(this).val() == "编辑评价")
    {
      var comment = $("#comHeader").html();
      document.getElementById("comEdit").innerHTML = "<textarea id=\"editArea\"/>";
      document.getElementById("editArea").innerHTML = comment;
      // alert(comment);
      document.getElementById("btnName").value = "确认修改";
    }
    else if($(this).val() == "确认修改")
    {
      var comment = document.getElementById("editArea").value;
      // alert(comment);  /(\r\n|\n|\r)/gm
      comment = comment.replace(/(\r\n|\n|\r)/gm, '<br/>');
      editComment(idShow, comment);
    }

});	//input:button
    
    function editComment(id, comment)
    {
      var dataString = 'id='+id+'&comment='+comment+'&method=3';
      $.ajax({ 
          type: "POST", 
          url: "changeLeaveMem.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if(edit == 1)
            {
              confirm("编辑成功");
              location.reload();
            }
            else if(edit == 2)
            {
              alert("警告：输入非法！");
              return;
            }
            else
            {
              confirm("编辑失败");
              location.reload();
            }
          } 
          }); 
    }

    function showComment(id)
    {
      var dataString = 'id=' + id + '&method=2';
      var com = new Array(2);
      $.ajax({ 
          type: "POST", 
          async: false,
          url: "changeLeaveMem.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            // alert(comment);
            // alert(name);
            // alert("WTF");
            // comment = comment.replaceAll("\\r\\n", "<br>");
            // alert(comment);
            com.push(comment);
            com.push(name);
          } 
          }); 
      return com;
    }

//依照数据修改成员信息
   		function changeMember(id,name,hometown,grade,profession,timeIn,timeOut,contact,graduateWork,offer)
      {
   			var dataString = 'id='+ id + '&name=' + name+ '&hometown=' + hometown+ '&profession=' + profession+ '&grade=' + grade+ '&timeIn=' + timeIn+ 
          '&timeOut=' + timeOut + '&contact=' + contact + '&graduateWork=' + graduateWork + '&offer=' + offer + '&method=1'; 
					$.ajax({ 
					type: "POST", 
					url: "changeLeaveMem.php", 
					data: dataString, 
					success: function(data){ 
						eval(data);
						if( change == 1)
						{
							confirm("修改成功");
							location.reload();
						}
            else if(change == 2)
            {
              alert("警告：输入非法！");
              location.reload();
            }
						else
						{
							confirm("修改失败");
							location.reload();
						}
					} 
					}); 

   		}		//修改成员信息

//依照数据删除成员信息
   		function deleteMem(number){
   			var dataString = 'id='+ number; 
					$.ajax({ 
					type: "POST", 
					url: "changeLeaveMem.php", 
					data: dataString, 
					success: function(data){ 
						eval(data);
						if(del == 1)
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

   		}		//删除成员信息

      

//依照数据添加成员信息
   		function addMember(id,name,hometown,grade,profession,timeIn,timeOut,contact,graduateWork,offer,comment)
      {
   			var dataString = 'id='+ id + '&name=' + name+ '&hometown=' + hometown+ '&profession=' + profession+ '&grade=' + grade+ '&timeIn=' + timeIn+ 
          '&timeOut=' + timeOut + '&contact=' + contact + '&graduateWork=' + graduateWork + '&offer=' + offer + '&comment=' + comment + '&method=1&add=1';  
					$.ajax({ 
					type: "POST", 
					url: "changeLeaveMem.php", 
					data: dataString, 
					success: function(data){ 
						eval(data);
						if( add == 1)
						{
							confirm("添加成功");
							location.reload();
						}
            else if(add == 2)
            {
              alert("警告：输入非法！");
              location.reload();
            }
						else
						{
							confirm("添加失败");
							location.reload();
						}
					} 
					}); 

   		}		//添加成员信息

});