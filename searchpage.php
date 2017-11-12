<!DOCTYPE html>
<?php 
	error_reporting(0);
	require_once("check.php");
	require_once("connect.php");
	checkSession();
	session_start();
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
</head>
<body>
	<header id="header">
		<div id="logo" onmouseover="this.style.cursor='pointer'" onclick="document.location='index.php';"></div>
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
		 	<!-- <span class="hbQa" onclick="alert('该功能还未上线，敬请期待！');"></span> -->
		 	<span class="hbQa" onclick="updatePwd();"></span>
		 	<div class="hb3"></div>
		 	<p>Copyright © 2015-2015 网络中心. 保留所有权利</p>
		 </div>
	</header>
	<div id="main">
		<div id="containerOfNew">
			<div id="innerContainer">
				<div id="record">
					<div class="mytab">
						<label class="checkLabel" onclick="document.location='searchpage.php';">按条件查询</label>
						<label onclick="document.location='searchUnfinishPage.php';">未完成卤蛋</label>
						<label onclick="document.location='searchfinishPage.php';">已完成卤蛋</label>
							<div class="myPanel">
								<strong class="tip2">输入你的查询条件</strong>
								<form action="searchpage.php" method="post" id="newForm">
									<p>报修宿舍</p><input type="text" name="room" placeholder="输入要查询的宿舍号"><!-- <br> -->
									<p>故障描述</p><input type="text" name="discribe" placeholder="输入故障描述关键字"><br>
									<p>解决方法</p><input type="text" name="solution" placeholder="输入解决方法关键字"><!-- <br> -->
									<p>耗材状况</p><input type="text" name="cost" placeholder="输入相关耗材关键字"><br>
									<p>报单状态</p>
									<input type="radio" name="isFinish" value="0" >未完成
									<input type="radio" name="isFinish" value="1" >已完成
									<input type="radio" name="isFinish" value="2" checked="checked">搜索全部
									<!-- <br> -->
									<input class="searchSubmit" type="submit" value="查询" name="submit">
									<input class="searchSubmit" type="submit" value="重置" name="reset">
								</form>
								<div id="countTable">
									<?php $current = date("Y-m"); ?>
									<p class="titleP">本月工作统计</p>
									<div style="display:block"></div>
									<table width="30%" style="float:left;" class="tableType">
										<tr>
											<th>故障类型</th>
											<th>报修数</th>
											<th>完成数</th>
										</tr>
										<tr align="center">
											<td>校园网</td>
											<td><?php $query = "select * from $table_mark where type=0 and mendTime LIKE'%".$current."%'"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
											<td><?php $query = "select * from $table_mark where type=0 and mendTime LIKE'%".$current."%' and isFinish=1"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
										</tr>
										<tr align="center">
											<td>电信网</td>
											<td><?php $query = "select * from $table_mark where type=1 and mendTime LIKE'%".$current."%'"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
											<td><?php $query = "select * from $table_mark where type=1 and mendTime LIKE'%".$current."%' and isFinish=1"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
										</tr>
										<tr align="center">
											<td>其他</td>
											<td><?php $query = "select * from $table_mark where type=2 and mendTime LIKE'%".$current."%'"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
											<td><?php $query = "select * from $table_mark where type=2 and mendTime LIKE'%".$current."%' and isFinish=1"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
										</tr>
									</table>
									<table width="30%" class="tableCost">
										<tr>
											<th>耗材</th>
											<th>消耗量</th>
										</tr>
										<tr align="center">
											<td>模块</td>
											<td><?php 
									$cost="模块"; 
									// $cost=iconv("utf-8", "gbk", $cost);
									$query = "select * from $table_mark where cost LIKE '%".$cost."%' and mendTime LIKE'%".$current."%'"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
										</tr>
										<tr align="center">
											<td>水晶头</td>
											<td><?php 
									$cost="水晶头"; 
									// $cost=iconv("utf-8", "gbk", $cost);
									$query = "select * from $table_mark where cost LIKE '%".$cost."%' and mendTime LIKE'%".$current."%'"; 
														$r = $mysqli->query($query);  $count = $r->num_rows; echo $count; ?></td>
										</tr>
									</table>

								</div>
								<div class="clearDiv"></div>
								<?php 
									error_reporting(0);
									if($_POST['submit'])
									{
										$_SESSION['room'] = $_POST['room'];
										$_SESSION['discribe'] = $_POST['discribe'];
										$_SESSION['solution'] = $_POST['solution'];
										$_SESSION['cost'] = $_POST['cost'];
										$_SESSION['isFinish'] = $_POST['isFinish'];
										$_SESSION['begin'] = 1;
									}
									if($_POST['reset'])
									{
										$_SESSION['begin'] = 0;
									}
									if($_SESSION['begin'] == 1)
									{
										require_once("showResult.php");
										showResult($_SESSION['room'],$_SESSION['discribe'],
											$_SESSION['solution'],$_SESSION['cost'],$_SESSION['isFinish']);
									}
									
								?>
							</div>
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