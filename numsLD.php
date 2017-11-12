<?php 
	error_reporting(0);
	session_start();
	$_SESSION['newtab'] = 0;
	require_once("connect.php");
	require_once("check.php");
	// mysql_query('set names utf8');
	$count = 0;
	if(isset($_POST['submit']))
	{
		for($i = 0; $i < 10; $i ++)
		{
			$roomNum = $_POST["roomNum$i"];
			if($roomNum == NULL)
				continue;
			$memberFixArr = $_POST["{memberFixArr$i}"];
			if($memberFixArr == NULL)
				continue;
			$memberFix = "";
			foreach ($memberFixArr as $key => $value) {
				# code...
				$memberFix .= $value.' ';
			}
			$discribe = $_POST["discribe$i"];
			if($discribe == NULL)
				$discribe = "无记录";

			if(inject_check($discribe) || inject_check($roomNum))
			{
				echo "<script>alert(\"请不要尝试进行非法注入!\");</script>";
				echo "<script language=\"javascript\">window.location.href = 'newpage.php';</script>";
				return;
			}
			if(isset($_SESSION['name']))
				$memberLD = $_SESSION['name'];
			else
				$memberLD = "无记录";
			$solution = "未录入";
			$cost = "未录入";
			$isFinish = 0;
			// $roomNum = mysql_real_escape_string($roomNum);
			// $discribe = mysql_real_escape_string($discribe);
			// $solution = mysql_real_escape_string($solution);
			// $cost = mysql_real_escape_string($cost);
			$type = $_POST["type$i"];

			// $memberFix = iconv("utf-8", "gbk", $memberFix);
			// $memberLD = iconv("utf-8", "gbk", $memberLD);
			// $discribe = iconv("utf-8", "gbk", $discribe);
			// $solution = iconv("utf-8", "gbk", $solution);
			// $cost = iconv("utf-8", "gbk", $cost);
			$query="INSERT INTO $table_mark VALUES($roomNum, getdate(), '$memberFix', '$memberLD', '$type', '$discribe', '$solution', '$cost', $isFinish)";
			// mysql_query($query, $link);
			// $re = odbc_exec($conn, $query);
			$re = $mysqli->query($query);
			if($re)
				$count ++;
		}	
	}
	echo "<script language=\"javascript\">alert(\"成功插入\" + $count+ \"条记录\")</script>";
	// header("location: newpage.php");
	echo "<script language=\"javascript\">window.location.href = 'newpage.php';</script>"
 ?>