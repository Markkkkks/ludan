function updatePassword(){
	var oldPwd = $("input#oldPwd").val();
	var newPwd_first = $("input#newPwd_first").val();
	var newPwd_sec = $("input#newPwd_sec").val();
	// alert(oldPwd);
	// alert(newPwd_first);
	// alert(newPwd_sec);
	if(oldPwd == "" || newPwd_first == "" || newPwd_sec == "")
	{
		alert("请填写完整所需信息！");
		return;
	}
	if(newPwd_first != newPwd_sec)
	{
		alert("两次输入的密码不同，请重新输入！");
		return;
	}
	var id = document.getElementById("hideID").value;

	update(id, oldPwd, newPwd_first);
}

function update(id, oldPwd,newPwd)
{
   	var dataString = 'id=' + id + '&oldPwd=' + oldPwd+ '&newPwd=' + newPwd; 
	$.ajax({ 
		type: "POST", 
		url: "updatePwd.php", 
		data: dataString, 
		success: function(data){ 
			eval(data);
			if(ud == 1)
			{
				confirm("密码修改成功,请重新登陆！");
				// location.reload();
				document.location='logout.php';
			}
            else if(ud == 2)
            {
              alert("警告：输入非法！");
              
            }
            else if(ud == 3)
            {
            	alert("原密码输入错误，请重试！");
            }
			else
			{
				confirm("密码修改失败，请重试！");
				location.reload();
			}
		} 
	}); 
}