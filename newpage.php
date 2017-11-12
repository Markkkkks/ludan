<!DOCTYPE html>

<?php 
	error_reporting(0);
	require_once("check.php");
	checkSession();
	session_start();
 ?>

<html>
<head>
	<title>新建卤蛋</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script type="text/javascript" src="js/jquery-1.7.1.min.js" charset="utf-8"></script>
	<!-- -->
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">

    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <script src="js/bootstrap.min.js"></script>

	<script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });
        });
    </script>
    <script type="text/javascript" src="js/updatePwd.js"charset="utf-8"></script>
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
	<!-- -->
</head>
<body>
	<header id="header">
		<div id="logo" onmouseover="this.style.cursor='pointer'" onclick="document.location='index.php';"></div>
		 <nav>
		 	<ul id="nav">
				<li id="nav_new" class="now"><a title="" href="newpage.php"><i></i>新建卤蛋</a></li>
				<li id="nav_search"><a title="" href="searchpage.php"><i></i>查询卤蛋</a></li>
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
		 	<!-- <span class="hbQa" onclick="alert('该功能还未上线，敬请期待！');"></span> -->
		 	<span class="hbQa" onclick="updatePwd();"></span>
		 	<div class="hb3"></div>
		 	<p>Copyright © 2015-2015 网络中心. 保留所有权利</p>
		 </div>
	</header>
	<div id="main">
		<div id="containerOfNew">
			<div id="innerContainer">
				<div class="tabs">
					<input <?php if($_SESSION['newtab'] == 0) echo "checked"; ?> id="one" name="tabs" type="radio">
					<label for="one">批量预录入</label>
					<input <?php if($_SESSION['newtab'] == 1) echo "checked"; ?> id="two" name="tabs" type="radio" value="Two">
					<label for="two">新建卤蛋</label>

					<div class="panels">
						<div class="panel">
							<form id="newForm" method="post" action="numsLD.php">
								<?php
									require_once("connect.php");
									// mysql_query("set names utf8");
									$state = "在职";
									// $state = iconv("utf-8", "gbk", $state);
									$sql = "select name from $table_member where state = '$state'";		
									for($i = 0; $i < 10; $i ++)
									{
										echo "<p>宿舍号</p><input type=\"text\" name=\"roomNum$i\" style=\"width:8%;\">";
										// echo "<p>维修人员</p><input type=\"text\" name=\"memberFix$i\">";
										echo "<p>维修人员</p><select id=\"id_select\" class=\"selectpicker bla bla bli\" multiple data-live-search=\"true\" 
										name=\"{memberFixArr$i}[]\">";
										// $result = mysql_query($sql,$link) or die(mysql_error());
										// $result = @odbc_exec($conn, $sql);
										$result = $mysqli->query($sql);

										// while($rows = mysql_fetch_array($result))
										// while(odbc_fetch_row($result))
										while($row = $res->fetch_assoc())
										{
											
											// $name = odbc_result($result, "name");
											$name = $row["name"];
											// $name = iconv("gbk", "utf-8", $name);
											echo "<option>".$name."</option>";
										}
										echo "</select>";
										echo "<p>故障类型</p><select name=\"type$i\" class=\"selectpicker bla bla bli\">";
										echo "<option value=0>校园网</option>";
										echo "<option value=1>电信网</option>";
										echo "<option value=2>其他</option>";
										echo "</select>";
										echo "<p>故障描述</p><input type=\"text\" name=\"discribe$i\"  style=\"width:15%;\">";
										echo "<br/>";
									}

								?>
								<input class="allSubmit" type="submit" name="submit" value="提交">
							</form>
						</div>

						<div class="panel">
							<form id="newOneForm" method="post" action="newOne.php">
								<div>
									<p>宿舍号</p>
									<input type="text" name="roomNum" />
									</div>
								<div>
									<p>维修人员</p>
									<select id="id_select" class="selectpicker bla bla bli fixSelect" multiple data-live-search="true" 
										name="memberFixArr[]">
									<?php 
										// $result = mysql_query($sql,$link) or die(mysql_error());
										// $result = @odbc_exec($conn, $sql);
										$result = $mysqli->query($sql);
										// while(odbc_fetch_row($result))
										while($row = $res->fetch_assoc())
										{
											// $name = odbc_result($result, "name");
											$name = $row["name"];
											// $name = iconv("gbk", "utf-8", $name);
											echo "<option>".$name."</option>";
										}
									?>
									</select>
								</div>
								<div>
									<p>卤蛋人员</p>
									<select id="id_select" class="selectpicker bla bla bli fixSelect" multiple data-live-search="true" 
										name="memberLDArr[]">"
									<?php 
										// $result = @odbc_exec($conn, $sql);
										$result = $mysqli->query($sql);
										// while(odbc_fetch_row($result))
										while($row = $res->fetch_assoc())
										{
											// $name = odbc_result($result, "name");
											$name = $row["name"];
											// $name = iconv("gbk", "utf-8", $name);
											echo "<option>".$name."</option>";
										}
									?>
									</select>
								</div>
								<div>
									<p>故障类型</p>
									<select class="selectpicker bla bla bli" name="type">
										<option value=0>校园网</option>
										<option value=1>电信网</option>
										<option value=2>其他</option>
									</select>
								</div>
								<div>
									<p>故障描述</p>
									<!-- <input type="text" name="discribe" /> -->
									<textarea name="discribe"></textarea>
								</div>
								<div>
									<p>解决方法</p>
									<!-- <input type="text" name="solution" /> -->
									<textarea name="solution"></textarea>
								</div>
								<div>
								<p>是否已完成</p>
									<input class="radioSet" type="radio" name="isFinish" value="1" />已完成
									<input class="radioSet" type="radio" name="isFinish" value="0" checked="checked" />未完成
								</div>
								<div>
								<p>消耗材料</p>
									<input type="radio" name="isCost" value="0" checked="checked" />无
									<input type="radio" name="isCost" value="1" />有
									<input type="text" name="cost">
								</div>
								<input class="allSubmit" type="submit" name="submit" value="提交" />
							</form>
						</div>
					</div>

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