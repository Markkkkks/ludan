<?php 
	error_reporting(0);
	require "connect.php";
	require "check.php";
	// mysql_query("set names utf8");

	if($_POST['submit'])
	{
		$room = $_POST['room'];
		$time = $_POST['time'];
		$memberFix = $_POST['memberFix'];
		$memberLD = $_POST['memberLD'];
		$discribe = $_POST['discribe'];
		$solution = $_POST['solution'];
		$isCost = $_POST['isCost'];
		$type = $_POST['type'];
		$cost = $_POST['cost'];
		$isFinish = $_POST['isFinish'];

		if(inject_check($room) || inject_check($time) || inject_check($memberFix) || inject_check($memberLD) || inject_check($discribe)
			|| inject_check($solution) || inject_check($isCost) || inject_check($cost) || inject_check($isFinish))
		{
			echo "<script>alert(\"请不要尝试进行非法注入!\");</script>";
			echo "<script language=\"javascript\">window.location.href = 'searchpage.php';</script>";
			return;
		}

		// $room = mysql_real_escape_string($room);
		// $memberFix = mysql_real_escape_string($memberFix);
		// $memberLD = mysql_real_escape_string($memberLD);
		// $discribe = mysql_real_escape_string($discribe);
		// $solution = mysql_real_escape_string($solution);
		// $cost = mysql_real_escape_string($cost);
		// $isFinish = mysql_real_escape_string($isFinish);

		if($isCost == 0)
		{
			$cost = "无耗材";
		}

		// $memberFix = iconv("utf-8", "gbk", $memberFix);
		// $memberLD = iconv("utf-8", "gbk", $memberLD);
		// $discribe = iconv("utf-8", "gbk", $discribe);
		// $solution = iconv("utf-8", "gbk", $solution);
		// $cost = iconv("utf-8", "gbk", $cost);

		if($memberFix && $memberLD && $discribe && $solution && $cost)
		{
			$sql = "UPDATE $table_mark SET mender = '$memberFix', marker = '$memberLD', type = '$type',
			reportText = '$discribe', mendText = '$solution', cost = '$cost', isFinish = '$isFinish'
			WHERE room = '$room' AND mendTime = '$time'";
			// $result = mysql_query($sql, $link);
			$result = $mysqli->query($sql);
			if($result)
			{
				echo "<script language=\"javascript\">alert(\"录入成功\")</script>";
				// header("location: newpage.php");
				echo "<script language=\"javascript\">window.location.href = 'searchFinishPage.php';</script>";
			}
			else
			{
				echo "<script language=\"javascript\">alert(\"录入失败，请重试\")</script>";
				// header("location: newpage.php");
				echo "<script language=\"javascript\">window.location.href = 'searchFinishPage.php';</script>";
			}
		}
		else
		{
			echo "<script language=\"javascript\">alert(\"请填写完整信息！\")</script>";
				// header("location: newpage.php");
				echo "<script language=\"javascript\">window.location.href = 'searchFinishPage.php';</script>";
		}
	}
 ?>