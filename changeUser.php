<?php 
	error_reporting(0);
	require_once("md5sample.php");

	
	header("Content-type: text/html;charset=utf-8");
	require_once("connect.php");	//number,name,address,grade,project,job,state,timeJoin,timeLeave
	// mysql_query('set names utf8');
	if($_POST['method'] == 1)
	{
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$authority = $_POST['authority'];
		$identity = $_POST['identity'];

		// confirm($timeLeave+$timeJoin+$state+$job+$project+$grade+$address+$name+$number);
		// $id = mysql_real_escape_string($id);
		// $username = mysql_real_escape_string($username);
		// $password = mysql_real_escape_string($password);
		// $authority = mysql_real_escape_string($authority);

		if(!($_POST['add']))
		{		//如果不存在属性  add,就修改成员信息，否则，添加成员信息
		// $query = "INSERT INTO `test`.`b_member` (`m_number`, `m_name`, `m_address`, `m_grade`, `m_project`, `m_job`, `m_state`, `m_timeJoin`, `m_timeLeave`) VALUES ('201340887', '金坷垃', '就看见', '健康了发', '解放路', '偶记经历', '放到家了', '链接', '链接了了链接')";
			$password= my_XOR($password);
			$query = "update $table_user set userName='$username', password='$password', isStudent='$identity',
				authority=$authority where id='$id'";
			// $result = @mysql_query($query, $link);
			$result = @odbc_exec($conn, $query);
			if($result)
			{
				echo "var change=1";
			}
			else
			{
				echo "var change=0";
			}
		}
		else
		{				//添加成员信息
			// $query = "insert into $table_user VALUES($id, '$username',md5('$password'),$authority)";
			$password= my_XOR($password);
			$query = "insert into $table_user VALUES('$username','$password',$authority, $identity)";
			// $result = @mysql_query($query, $link);
			$result = @odbc_exec($conn, $query);
			if($result)
			{
				echo "var add=1";
			}
			else
			{
				echo "var add=0";
			}
		}//tianjia 
	}
	else
	{				//否则处理删除操作
		$id = $_POST['id'];

		// $query = "update $table_member set m_name='3333333333' where m_number='$name'";
		$query = "delete from $table_user where id='$id'";
		$result = @odbc_exec($conn, $query);
		if($result)
		{
			echo "var cut=1"; 
		}
		else
		{
			echo "var cut=0";
		}

	}


 ?>