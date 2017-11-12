<?php 
	error_reporting(0);

	
	header("Content-type: text/html;charset=utf-8");
	require_once("connect.php");	//number,name,address,grade,project,job,state,timeJoin,timeLeave
	require_once("check.php");
	// mysql_query('set names utf8');
	if($_POST['method'] == 1){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$hometown = $_POST['hometown'];
		$grade = $_POST['grade'];
		$profession = $_POST['profession'];
		$job = $_POST['job'];
		$state = $_POST['state'];
		$timeIn = $_POST['timeIn'];

		if(inject_check($id) || inject_check($name) || inject_check($hometown) || inject_check($grade) || inject_check($profession)
				|| inject_check($job) || inject_check($state) || inject_check($timeIn) )
		{
			// echo "<script>alert(\"警告：请不要尝试进行非法注入!\");</script>";
			// echo "<script language=\"javascript\">window.location.href = 'memberpage.php';</script>";
			// return;
			$warning = 1;
		}
		else
		{
			$warning = 0;
		}

		// $id = iconv("utf-8", "gbk", $id);
		// $name = iconv("utf-8", "gbk", $name);
		// $hometown = iconv("utf-8", "gbk", $hometown);
		// $grade = iconv("utf-8", "gbk", $grade);
		// $profession = iconv("utf-8", "gbk", $profession);
		// $job = iconv("utf-8", "gbk", $job);
		// $state = iconv("utf-8", "gbk", $state);
		// $timeIn = iconv("utf-8", "gbk", $timeIn);

	// confirm($timeLeave+$timeJoin+$state+$job+$project+$grade+$address+$name+$number);
	// $number = mysql_real_escape_string($number);
	// $name = mysql_real_escape_string($name);
	// $address = mysql_real_escape_string($address);
	// $grade = mysql_real_escape_string($grade);
	// $project = mysql_real_escape_string($project);
	// $job = mysql_real_escape_string($job);
	// $state = mysql_real_escape_string($state);
	// $timeJoin = mysql_real_escape_string($timeJoin);
	// $timeLeave = mysql_real_escape_string($timeLeave);

		if(!($_POST['add'])){		//如果不存在属性  add,就修改成员信息，否则，添加成员信息
		// $query = "INSERT INTO `test`.`b_member` (`m_number`, `m_name`, `m_address`, `m_grade`, `m_project`, `m_job`, `m_state`, `m_timeJoin`, `m_timeLeave`) VALUES ('201340887', '金坷垃', '就看见', '健康了发', '解放路', '偶记经历', '放到家了', '链接', '链接了了链接')";
		if($warning == 1)
		{
			echo  "var change=2";
		}
		else{
		$query = "update $table_member set name='$name',hometown='$hometown',grade='$grade',profession='$profession',job='$job',state='$state',timeIn='$timeIn' where id='$id'";
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
		}

		else{				//添加成员信息
			if($warning == 1)
			{
				echo "var add=2";
			}
			else{
			// $query = "insert into $table_member(`m_number`, `m_name`, `m_address`, `m_grade`, `m_project`, `m_job`, `m_state`, `m_timeJoin`, `m_timeLeave`) VALUES ('$number', '$name', '$address', '$grade', '$project', '$job', '$state', '$timeJoin', '$timeLeave')";
			$query = "insert into $table_member VALUES ('$id', '$name', '$hometown', '$grade', '$profession', '$job', '$state', '$timeIn')";
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
		}
		$query = "insert into $table_user VALUES ('$id', '8505230', 1, 1)";
		$result = @odbc_exec($conn, $query);
		}//tianjia 
	}
	elseif($_POST['method'] == 2)
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$hometown = $_POST['hometown'];
		$grade = $_POST['grade'];
		$profession = $_POST['profession'];
		$timeIn = $_POST['timeIn'];
		$timeOut = $_POST['timeOut'];
		$contact = $_POST['contact'];
		$graduateWork = $_POST['graduateWork'];
		$offer = $_POST['offer'];
		$comment = $_POST['comment'];

		// $id = iconv("utf-8", "gbk", $id);
		// $name = iconv("utf-8", "gbk", $name);
		// $hometown = iconv("utf-8", "gbk", $hometown);
		// $grade = iconv("utf-8", "gbk", $grade);
		// $profession = iconv("utf-8", "gbk", $profession);
		// $timeIn = iconv("utf-8", "gbk", $timeIn);
		// $timeOut = iconv("utf-8", "gbk", $timeOut);
		// $contact = iconv("utf-8", "gbk", $contact);
		// $graduateWork = iconv("utf-8", "gbk", $graduateWork);
		// $offer = iconv("utf-8", "gbk", $offer);
		// $comment = iconv("utf-8", "gbk", $comment);

		$sql = "insert into $table_memLeave VALUES('$id', '$name', '$hometown','$grade','$profession','$timeIn',
			'$timeOut','$contact','$graduateWork','$offer','$comment')";
		$result = @odbc_exec($conn, $sql);
		if(!$result)
		{
			echo "var leave = 0";
		}
		else
		{
			$sql = "delete from $table_member where id='$id'";
			$result = @odbc_exec($conn, $sql);
			if(!$result)
				echo "var leave = 0";
			else
				echo "var leave = 1";
		}
		$query = "delete from $table_user where userName='$id'";
		$result = @odbc_exec($conn, $query);
	}

	else{				//否则处理删除操作
	$id = $_POST['id'];
	$name = $_POST['name'];

	// $number = mysql_real_escape_string($number);
	// $name = mysql_real_escape_string($name);

	// $query = "update $table_member set m_name='3333333333' where m_number='$name'";
	$query = "delete from $table_member where id='$id'";
	// $result = @mysql_query($query, $link);
	$result = @odbc_exec($conn, $query);
	if($result)
	{
		echo "var cut=1";
	}
	else
	{
		echo "var cut=0";
	}
	$query = "delete from $table_user where userName='$id'";
	$result = @odbc_exec($conn, $query);

}


 ?>