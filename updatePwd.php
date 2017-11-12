<?php 
	error_reporting(0);
	header("Content-type: text/html;charset=utf-8");
	require_once("connect.php");
	require_once("check.php");
	require_once("md5sample.php");

	$id = $_POST['id'];
	$oldPwd = $_POST['oldPwd'];
	$newPwd = $_POST['newPwd'];

	// echo "<script>alert(\"".$id."\");</script>";

	if(inject_check($oldPwd) || inject_check($newPwd))
	{
		echo "var ud=2";
	}
	else
	{	$newPwd= my_XOR($newPwd);
		$oldPwd= my_XOR($oldPwd);
		// $sql = "select * from $table_user where id = '$id' and passWord = '$oldPwd'";
		$sql = "select * from $table_user where id = '$id' and passWord = '$oldPwd'";

		// $res = @odbc_exec($conn, $sql);
		$res = $mysqli->query($sql);
		// if(odbc_fetch_row($res))
		if($res)
		{
			// $row = $res->fetch_assoc();
			$sql = "update $table_user set passWord = '$newPwd' where id = '$id'";
			// $re = @odbc_exec($conn, $sql);
			$re = $mysqli->query($sql);
			if($re)
				echo "var ud=1";
			else
				echo "var ud=0";
		}
		else
		{
			echo "var ud=3";
		}

	}

 ?>