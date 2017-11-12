var btnLeave;
$(function() 
		{ 
    $("input:button").click(function() {
    	var but = $(this);

    	if($(this).val() == "确定"){
 
        if (confirm("确认修改?")==true)
          {
             		//获取表格信息，并 输入数据库中 
             		var timeIn = but.parent().prev().children('input:text').val();
                var state = "在职";   
             		var jo = but.parent().prev().prev().prev().children('select').val();
                if( 1 == jo)  { var job = "组长" ; } else { var job = "组员"; }     
             		var profession = but.parent().prev().prev().prev().prev().children('input:text').val();
             		var grade = but.parent().prev().prev().prev().prev().prev().children('input:text').val();
             		var hometown = but.parent().prev().prev().prev().prev().prev().prev().children('input:text').val();
             		var name = but.parent().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
             		var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().text();
             			//调用函数进行修改操作
             		changeMember(id,name,hometown,grade,profession,job,state,timeIn);						//chanmeMessage()
          }
        else
        {
        	location.reload();
        } 
      }


    		// changeMessage();
    		if(!($(this).val() == "删除") && !($(this).val() == "添加新成员") && !($(this).val() == "离职") && !($(this).val() == "确认离职") && !($(this).val() == "取消操作")){
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
        
        var j = but.parent().prev().prev().prev().children('input:text').val();

          if(j == "组长")
          {
            var strj = "<select><option value ='1' selected='selected'>组长</option><option value ='2'>组员</option></select>";
          }
          else
          {
            var strj = "<select><option value ='1'>组长</option><option value ='2' selected='selected'>组员</option></select>";
          }

          but.parent().prev().prev().html("在职");
                
          var job = but.parent().prev().prev().prev().html(strj);

          // var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().html
          //       ("<input type='text' disabled=\"readonly\" style=\"width:100%;\"value='"+ n+"'>");
          var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
          but.parent().prev().prev().prev().prev().prev().prev().prev().prev().html(id);
                
    }else if($(this).val() == "删除"){
    	//进行删除操作
    			var name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().text();
       		var number = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
			 	if (confirm("确认删除成员【 "+name+"--"+number+" 】？")==true)
    {
       		//获取表格信息，并 输入数据库中 
    		// var name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
      		
       			//调用函数进行删除操作
       		cutMember(number,name);						//chanmeMessage()
    }
  else
    {
    	location.reload();
    } 
    }else if($(this).val() == "添加新成员"){
	 	  	var but = $(this);
       		//获取表格信息，并 输入数据库中 
        var timeIn = but.parent().prev().children('input:text').val();
        var state = "在职";
        var jo = but.parent().prev().prev().prev().children('select').val();
        if( 1 == jo)  { var job = "组长" ; } else { var job = "组员"; }  
        var profession = but.parent().prev().prev().prev().prev().children('input:text').val();
        var grade = but.parent().prev().prev().prev().prev().prev().children('input:text').val();
        var hometown = but.parent().prev().prev().prev().prev().prev().prev().children('input:text').val();
        var name = but.parent().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
    	  var id = but.parent().prev().prev().prev().prev().prev().prev().prev().prev().children('input:text').val();
  
         
    	//添加新成员的相关操作
    	if(id && name && hometown && grade && profession){
    		// alert("This is a interesting story");
	
	 	if (confirm("添加新成员信息？")==true) {  

    		
       			//调用函数进行修改操作
       		addMember(id,name,hometown,grade,profession,job,state,timeIn);

       	}else{
       		// confirm("放弃添加新成员");
       		// location.reload();
          return;
       	}


    	}else{
    		confirm("输入必要信息");
    		// location.reload();
        return;
    	}


    }   //最后操作

    else if($(this).val() == "离职"){
        btnLeave = $(this);
        var winWidth = document.documentElement.clientWidth;
        var winHeight = document.documentElement.clientHeight;
        var div = document.getElementById("infoToLeave");
        div.style.display = "block";
        div.style.left = winWidth / 3 + "px";
        div.style.top = winHeight / 3 + "px";
        var overDiv = document.getElementById("overDiv");
        overDiv.style.display = "block";
    }

    else if($(this).val() == "取消操作"){
        document.getElementById("leaveTime").value = "";
        document.getElementById("phoneNum").value = "";
        document.getElementById("workPlace").value = "";
        document.getElementById("commentEd").value = "";
        document.getElementById("infoToLeave").style.display = "none";
        document.getElementById("overDiv").style.display = "none";
    }

    else if($(this).val() == "确认离职"){
      if(document.getElementById("leaveTime").value == "")
      {
          confirm("请填写必填项！");
          return;
      }
      if(confirm("确认您的操作？"))
      {
          var id = btnLeave.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
          var name = btnLeave.parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().text();
          var hometown = btnLeave.parent().prev().prev().prev().prev().prev().prev().prev().prev().text();
          var grade = btnLeave.parent().prev().prev().prev().prev().prev().prev().prev().text();
          var profession = btnLeave.parent().prev().prev().prev().prev().prev().prev().text();
          var timeIn = btnLeave.parent().prev().prev().prev().text();
          var timeOut = document.getElementById("leaveTime").value;
          var contact = document.getElementById("phoneNum").value;
          var workPlace = document.getElementById("workPlace").value;
          var comment = document.getElementById("commentEd").value;
          // alert("success");
          // location.reload();
          memLeave(id,name,hometown,grade,profession,timeIn,timeOut,
            contact,workPlace,comment);
      }
    }

    });	//input:button

//依照数据修改成员信息
   		function changeMember(id,name,hometown,grade,profession,job,state,timeIn){
   			var dataString = 'id='+ id + '&name=' + name+ '&hometown=' + hometown+ '&profession=' + profession+ '&grade=' + grade+ '&state=' + state+ '&job=' + job+ '&timeIn=' + timeIn+ '&method=1'; 
					$.ajax({ 
					type: "POST", 
					url: "changeMember.php", 
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
   		function cutMember(number,name){
   			var dataString = 'id='+ number + '&name=' + name; 
					$.ajax({ 
					type: "POST", 
					url: "changeMember.php", 
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

   		}		//删除成员信息

      function memLeave(id, name, hometown, grade, profession, timeIn, timeOut, contact, graduateWork, comment)
      {
        var dataString = 'id='+id+'&name='+name+'&hometown='+hometown+'&grade='+grade+'&profession='+profession+
        '&timeIn='+timeIn+'&timeOut='+timeOut+'&contact='+contact+'&graduateWork='+graduateWork+'&comment='+comment+
        '&method=2';
        $.ajax({ 
          type: "POST", 
          url: "changeMember.php", 
          data: dataString, 
          success: function(data){ 
            eval(data);
            if( leave == 1)
            {
              confirm("操作成功");
              location.reload();
            }
            else if(leave == 2)
            {
              alert("警告：输入非法！");
              location.reload();
            }
            else
            {
              confirm("操作失败");
              location.reload();
            }
          } 
          }); 
      }

//依照数据添加成员信息
   		function addMember(id,name,hometown,grade,profession,job,state,timeIn){
   			var dataString = 'id='+ id + '&name=' + name+ '&hometown=' + hometown+ '&profession=' + profession+ '&grade=' + grade+ '&state=' + state+ '&job=' + job+ '&timeIn=' + timeIn +'&method=1&add=1'; 
					$.ajax({ 
					type: "POST", 
					url: "changeMember.php", 
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