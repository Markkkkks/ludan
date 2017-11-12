<?php 
	
	error_reporting(0);
	header("Content-type: text/html;charset=utf-8");
	require_once("connect.php");
	if($_POST['method'] == 1)
	{
		$room = $_POST['room'];
		$time = $_POST['time'];

		$query = "delete from $table_mark where room ='$room' and mendTime LIKE '%".$time."%'";
		// $query = "delete from b_ludan where l_roomNum ='1231' and l_time = '2015-11-26 00:59:46'";

		// $result = @mysql_query($query, $link);
		$result = @odbc_exec($conn, $query);
		if($result)
		{
			echo "var del=1"; 
		}
		else
		{
			echo "var del=0";
		}
	}

 ?>