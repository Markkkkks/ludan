<?php
		$mysql_server_name = "localhost"; //host
		$mysql_username= "myNetc"; //登录名
		$mysql_password= "8505230"; //密码
		$mysql_database= "netc";//数据库
		// $db_host = "SQLFORSONG"; //数据源
		// $db_user = "brothersong"; //登录名
		// $db_pass = "8692644"; //密码
		$table_member = "member";	//在职成员表
		$table_memLeave = "memLeave"; //离职成员表
		$table_mark = "mark";	//录单信息表
		$table_user = "userT";		//密码表
		// $conn = odbc_connect($db_host, $db_user, $db_pass);
		$mysqli = new mysqli($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
		$mysqli->query("set names utf8");
?>