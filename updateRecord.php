<?php 
	
	error_reporting(0);
	require "connect.php";
	// mysql_query("set names utf8");

	$id = $_POST['id'];

	$query = "SELECT * FROM $table_mark WHERE id = '$id'";
	// $result = mysql_query($query, $link);
	$result = $mysqli->query($query);

	// $row = mysql_fetch_array($result);
	$row = $result->fetch_assoc();

	// $room = $row['l_roomNum'];
	// $time = $row['l_time'];
	// $memberFix = $row['l_memberFix'];
	// $memberLD = $row['l_memberLD'];
	// $discribe = $row['l_discribe'];
	// $solution = $row['l_solution'];
	// $cost = $row['l_cost'];
	// $isFinish = $row['l_isFinish'];

	// $room = mysql_real_escape_string($room);
	// $memberFix = mysql_real_escape_string($memberFix);
	// $memberLD = mysql_real_escape_string($memberLD);
	// $discribe = mysql_real_escape_string($discribe);
	// $solution = mysql_real_escape_string($solution);
	// $cost = mysql_real_escape_string($cost);
	// $isFinish = mysql_real_escape_string($isFinish);
	$room = $row["room"];
	$mendTime = $row["mendTime"];
	// $mendTime = substr($mendTime, 0, 19);
	$mender = $row["mender"];
	$marker = $row["marker"];
	$type = $row["type"];
	$reportText = $row["reportText"];
	$mendText = $row["mendText"];
	$cost = $row["cost"];
	$isFinish = $row["isFinish"];

	// $room = iconv('GBK','UTF-8',$room);
	// $mendTime = iconv('GBK','UTF-8',$mendTime);
	// $mender = iconv('GBK','UTF-8',$mender);
	// $marker = iconv('GBK','UTF-8',$marker);
	// $reportText = iconv('GBK','UTF-8',$reportText);
	// $mendText = iconv('GBK','UTF-8',$mendText);
	// $cost = iconv('GBK','UTF-8',$cost);
 ?>

<!DOCTYPE html>
<?php 
	require_once("check.php");
	checkSession();
 ?>
<html>
<head>
	<title>查询卤蛋</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/searchFinish.js"charset="utf-8"></script>
	<script type="text/javascript">
		function hideTable(){
			// document.getElementById("infoToLeave").style.display = "none";
			document.getElementById("overDiv").style.display = "none";
			document.getElementById("updatePwd").style.display = "none";
		}
		function updatePwd(){
			var winWidth = document.documentElement.clientWidth;
	        var winHeight = document.documentElement.clientHeight;
	        var div = document.getElementById("updatePwd");
	        div.style.display = "block";
	        div.style.left = winWidth / 3 + "px";
	        div.style.top = winHeight / 3 + "px";
	        var overDiv = document.getElementById("overDiv").style.display = "block";
		}
	</script>
</head>
<body>
	<header id="header">
		<div id="logo" onmouseover="this.style.cursor='pointer'" onclick="document.location='firstpage.php';"></div>
		 <nav>
		 	<ul id="nav">
				<li id="nav_new"><a title="" href="newpage.php"><i></i>新建卤蛋</a></li>
				<li id="nav_search" class="now"><a title="" href="searchpage.php"><i></i>查询卤蛋</a></li>
				<li id="nav_member"><a title="" href="memberpage.php"><i></i>成员管理</a></li>
				<?php 
					if(isset($_SESSION['authority']) && $_SESSION['authority'] == 2)
					{
						echo "<li id=\"nav_admin\"><a href=\"userpage.php\">用户管理</a></li>";
					}
				?>
			</ul>
			
		 </nav>
		 <div class="header-bot">
		 	<span class="hbQuit" onclick="document.location='logout.php';"></span>
		 	<span class="hbQa" onclick="updatePwd();"></span>
		 	<div class="hb3"></div>
		 	<p>Copyright © 2015-2015 网络中心. 保留所有权利</p>
		 </div>
	</header>
	<div id="main">
		<div id="container">
			<div id="member">
				<div id="updatePageSet">
					<form action="updateConfirm.php" id="newOneForm" method="post">
						<strong class="tip">卤蛋信息完善</strong><br>
						<p>宿舍号</p><input disabled="disabled" type="text" value="<?php echo $room; ?>"/><br>
						<input type="hidden" value="<?php echo $room; ?>" name="room" />
						<p>维修人员</p><input type="text" placeholder="记得输入全名沃" value="<?php echo $mender; ?>" name="memberFix" /><br>	
						<p>录单人员</p><input type="text" placeholder="记得输入全名沃" value="<?php echo $marker; ?>" name="memberLD" />	<br>
						
						<p>故障类型</p>
						<select name="type" class="typeSelector">
							<option value=0 <?php if($type == 0) echo "selected=\"selected\""; ?> >校园网</option>
							<option value=1 <?php if($type == 1) echo "selected=\"selected\""; ?> >电信网</option>
							<option value=2 <?php if($type == 2) echo "selected=\"selected\""; ?> >其他</option>
						</select><br>
						<div style="height:20px;"></div>
						<p>故障描述</p><textarea name="discribe"><?php echo $reportText; ?></textarea><br>
						<p>解决方法</p><textarea name="solution"><?php echo $mendText; ?></textarea><br>
						<p>耗材</p>
						<input type="radio" name="isCost" value="0" <?php 
						if($cost == "无耗材" || $cost == "未录入")
							echo "checked=\"checked\"";
						?> />无
						<input type="radio" name="isCost" value="1" <?php 
						if($cost != "无耗材" && $cost != "未录入")
							echo "checked=\"checked\"";
						?>/>有
						<input type="text" value="<?php echo $cost; ?>"name="cost" /><br>
						<p>是否已完成</p>
						<input type="radio" name="isFinish" value="0" <?php
							if($isFinish == 0)
								echo "checked=\"checked\"";
						?> />未完成
						<input type="radio" name="isFinish" value="1" <?php
							if($isFinish == 1)
								echo "checked=\"checked\"";
						?> />已完成<Br>
						<input type="hidden" name="time" value="<?php echo $mendTime; ?>">
						<input class="conSubmit" type="submit" name="submit" value="确认提交">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="updatePwd">
		<div id="clearInline" style="height:50px;"></div>
		<form id="infoTable">
			<p>原密码</p><input type="password" id="oldPwd" width="300px">
			<div id="clearInline"></div>
			<p>新密码</p><input type="password" id="newPwd_first" width="300px">
			<div id="clearInline"></div>
			<p>重复新密码</p><input type="password" id="newPwd_sec" width="300px">
			<div id="clearInline"></div>
			<div id="likeBtn" onclick="updatePassword();">确认修改</div>
		</form>
	</div>
	<div id="overDiv" style="display:none;" onclick="hideTable();"></div>
	<input type="password" id="hideID" style="display:none;" value="<?php echo $_SESSION['id'];  ?>"> 
</body>
</html>