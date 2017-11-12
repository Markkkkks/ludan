<?php 
	error_reporting(0);
	require_once("connect.php");
	require_once("check.php");
	require_once("md5sample.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(inject_check($username) || inject_check($password))
	{
		echo "var login=2";
	}
	else
	{
		$password=my_XOR($password);
		// $query = "select userName,authority from $table_user where userName = '$username' 
		// 	and passWord = substring(sys.fn_sqlvarbasetostr(HashBytes('MD5','$password')),0,30)";

		$query = "select id,userName,authority, isStudent from $table_user where userName = '$username' 
			and passWord = '$password'";

		// $result = @mysql_query($query, $link);

		// $result = odbc_exec($conn, $query);
		// $result = $mysqli->query($conn, $query);	
		$res = $mysqli->query($query);	
		
		// if(odbc_fetch_row($result))
		$row = $res->fetch_assoc();
		if($row!= null)
		{
			// $isStu = odbc_result($result, "isStudent");

			// $row = $res->fetch_assoc();
			$isStu = $row["isStudent"];

			$correct = 1;	//非学生小组成员用户，可直接登陆
			if($isStu == 1)	//需要查学生表验证是否在职
			{
				// $state = '在职';
				// $state = iconv("utf-8", "gbk", $state);
				// $sql = "select id, name from $table_member where id = '$username'
				// 	and state = '$state'";
				$sql = "select id, name from $table_member where id = '$username'";
				// $re = odbc_exec($conn, $sql);
				$re = $mysqli->query($sql);
				
				// if(odbc_fetch_row($re))
				if($re)
				{	
					// $row2 = $re->fetch_assoc();
					$row2 = mysqli_fetch_assoc($re);
					$correct = 2;	//在职学生小组成员用户，通过验证可登陆
					// $name = odbc_result($re, "name");
					$name = $row2["name"];
					// $name = iconv("gbk", "utf-8", $name);
				}
				else
				{
					$correct = 3;	//已离职或不存在的小组成员
				}
			}
			if($correct == 3)
			{
				echo "var login=3";
			}
			else
			{
				session_start();  
			    // $_SESSION['username'] = $row['u_username'];
			    // $_SESSION['authority'] = $row['u_authority'];
			    // $_SESSION['newtab'] = 0;
				// $_SESSION['searchtab'] = 0;
				
			    // $username = odbc_result($result, "userName");
			    // $authority = odbc_result($result, "authority");
				// $id = odbc_result($result, "id");
								
				$username = $row["userName"];
			    $authority = $row["authority"];
				$id = $row["id"];

			    $_SESSION['id'] = $id;
			    $_SESSION['username'] = $username;
			    $_SESSION['authority'] = $authority;
			    $_SESSION['begin'] = 0;
			    if($correct == 2)
			    {
			    	$_SESSION['name'] = $name;
			    	// $_SESSION['name'] = 'xxx';
			    }
				echo "var login=1";
			}
		}
		else
		{
			echo "var login=0";
		}
	}
 ?>

 				