$(function() 
		{ 
			$('.error').hide(); 
			$(".button").click(function() 
				{ 
					$('.error').hide(); 
					var name = $("input#username").val(); 
					if (name == "")
					{ 
						$("label#name_error").show(); 
						$("input#username").focus(); 
						return false; 
					} 
					var pwd = $("input#password").val(); 
					if (pwd == "") 
					{ 
						$("label#password_error").show(); 
						$("input#password").focus(); 
						return false; 
					}
					
					var dataString = 'username='+ name + '&password=' + pwd; 
					$.ajax({ 
					type: "POST", 
					url: "loginValidate.php", 
					data: dataString, 
					success: function(data){ 
						// alert(data);
						eval(data);
						if(login == 1)
						{
							window.location.href = 'index.php';
						}
						else if(login == 2)
						{
							alert("警告：请不要尝试进行非法注入！");
						}
						else if(login == 0)
						{
							alert("用户名或密码错误！");
						}
						else
						{
							alert("您已离职，无访问权限！")
						}
					} 
					}); 
					return false; 
				}); 
		});