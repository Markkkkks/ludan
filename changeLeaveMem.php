<?php 
	error_reporting(0);

	
	header("Content-type: text/html;charset=utf-8");
	require_once("connect.php");	//number,name,address,grade,project,job,state,timeJoin,timeLeave
	require_once("check.php");
	// mysql_query('set names utf8');
	if($_POST['method'] == 1)
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$hometown = $_POST['hometown'];
		$grade = $_POST['grade'];
		$profession = $_POST['profession'];
		$timeIn = $_POST['timeIn'];
		$timeOut = $_POST['timeOut'];
		$graduateWork = $_POST['graduateWork'];
		$contact = $_POST['contact'];
		$offer = $_POST['offer'];
		$comment = $_POST['comment'];

		if(inject_check($id) || inject_check($name) || inject_check($hometown) || inject_check($grade) || inject_check($profession)
				|| inject_check($timeOut) || inject_check($graduateWork) || inject_check($timeIn) || inject_check($contact) || inject_check($comment)
				|| inject_check($offer))
		{
			$warning = 1;
		}
		else
		{
			$warning = 0;
		}

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
		
		if(!($_POST['add']))
		{
			if($warning == 1)
			{
				echo  "var change=2";
			}
			else
			{
				$query = "update $table_memLeave set name='$name',hometown='$hometown',grade='$grade',profession='$profession',timeIn='$timeIn',timeOut='$timeOut',contact='$contact', graduateWork='$graduateWork',
				offer='$offer' where id='$id'";
				// $result = @mysql_query($query, $link);
				$result = $mysqli->query($query);
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

		else
		{				//添加成员信息
			if($warning == 1)
			{
				echo "var add=2";
			}
			else
			{
			
				$query = "insert into $table_memLeave VALUES ('$id', '$name', '$hometown', '$grade', '$profession', '$timeIn', '$timeOut', '$contact',
					'$graduateWork', '$offer','$comment')";
				$result = $mysqli->query($query);
				if($result)
				{
					echo "var add=1";
				}
				else
				{
					echo "var add=0";
				}
			}
		}
	}
	elseif($_POST['method'] == 2)
	{
		$id = $_POST['id'];
		$sql = "select name, comment from $table_memLeave where id='$id'";

		$result = $mysqli->query($sql);
		$row = $result->fetch_assoc();
		// $name = odbc_result($result, "name");
		// $comment = odbc_result($result, "comment");
		$name = $row["name"];
		$comment = $row["comment"];
		// $name = iconv("gbk", "utf-8", $name);
		// $comment = iconv("gbk", "utf-8", $comment);
		if($comment == null || $comment == "")
			echo "var comment=\"该成员尚未评价\"; var name=\"".$name."\"";
		else
			echo "var comment=\"".$comment."\"; var name=\"".$name."\"";
	}
	elseif($_POST['method'] == 3)
	{
		$id = $_POST['id'];
		$comment = $_POST['comment'];
		// $comment = iconv("utf-8", "gbk", $comment);
		if(inject_check($comment))
		{
			echo "var edit=2";
		}
		else
		{
			$sql = "update $table_memLeave set comment = '$comment' where id = '$id'";
			$result = $mysqli->query($sql);
			if($result)
				echo "var edit=1";
			else
				echo "var edit=0";
		}
	}
	else
	{				//否则处理删除操作
		$id = $_POST['id'];

		$query = "delete from $table_memLeave where id='$id'";
		$result = $mysqli->query($query);
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