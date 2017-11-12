<?php 
	error_reporting(0);
	require_once("connect.php");
	require_once("check.php");
	// mysql_query('set names utf8');
	session_start();
	$_SESSION['newtab'] = 1;
	if(isset($_POST['submit']))
	{
		$roomNum = $_POST["roomNum"];
		$memberFixArr = $_POST["memberFixArr"];
		$memberFix = "";
		foreach ($memberFixArr as $key => $value) {
				# code...
			$memberFix .= $value.' ';
		}
		$discribe = $_POST["discribe"];
		$memberLDArr = $_POST["memberLDArr"];
		$memberLD = "";
		$type = $_POST["type"];
		foreach ($memberLDArr as $key => $value) {
				# code...
			$memberLD .= $value.' ';
		}
		$solution = $_POST["solution"];
		if($_POST['isCost'] == 1)
		{
			$cost = $_POST['cost'];
		}
		else
		{
			$cost = "无耗材";
		}
		$isFinish = $_POST["isFinish"];

		if(inject_check($roomNum) || inject_check($memberFix) || inject_check($memberLD) || inject_check($discribe)
			|| inject_check($solution) || inject_check($cost))
		{
			echo "<script>alert(\"请不要尝试进行非法注入!\");</script>";
			echo "<script language=\"javascript\">window.location.href = 'searchpage.php';</script>";
			return;
		}

		// $roomNum = mysql_real_escape_string($roomNum);
		// $discribe = mysql_real_escape_string($discribe);
		// $solution = mysql_real_escape_string($solution);
		// $cost = mysql_real_escape_string($cost);
		// $memberFix = iconv("utf-8", "gbk", $memberFix);
		// $memberLD = iconv("utf-8", "gbk", $memberLD);
		// $discribe = iconv("utf-8", "gbk", $discribe);
		// $solution = iconv("utf-8", "gbk", $solution);
		// $cost = iconv("utf-8", "gbk", $cost);

		if($roomNum && $memberFixArr && $memberLDArr && $discribe && $solution)
		{
			$query="INSERT INTO $table_mark VALUES($roomNum, getdate(), '$memberFix', '$memberLD','$type', '$discribe', '$solution', '$cost', $isFinish)";
			// mysql_query($query, $link);
			// odbc_exec($conn, $query);
			$mysqli->query($query);
			echo "<script language=\"javascript\">alert(\"新建卤蛋成功\")</script>";
			// header("location: newpage.php");
			echo "<script language=\"javascript\">window.location.href = 'newpage.php';</script>";
		}
		else
		{
			echo "<script language=\"javascript\">alert(\"请填写完整信息！\")</script>";
			// header("location: newpage.php");
			echo "<script language=\"javascript\">window.location.href = 'newpage.php';</script>";
		}
	}
	
 ?>