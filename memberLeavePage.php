<!DOCTYPE html>
<?php 
	require_once("check.php");
	checkSession();
 ?>
<html>
<head>
	<title>成员管理</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/leaveMemManage.js"charset="utf-8"></script>
	<script type="text/javascript" src="js/updatePwd.js"charset="utf-8"></script>

	<script type="text/javascript">
		function hideTable(){
			document.getElementById("updatePwd").style.display = "none";
			document.getElementById("comEdit").innerHTML = "<p id=\"comHeader\" class=\"commentHeader\"></p>";
			document.getElementById("comment").style.display = "none";
			document.getElementById("overDiv").style.display = "none";
			document.getElementById("btnName").value = "编辑评价";
			
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
				<li id="nav_search"><a title="" href="searchpage.php"><i></i>查询卤蛋</a></li>
				<li id="nav_member" class="now"><a title="" href="memberpage.php"><i></i>成员管理</a></li>
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
		<div id="containerOfOthers">
			<div id="memberTab">
				<label onclick="document.location='memberpage.php';">在职成员名单</label>
				<label class="checkLabel" onclick="document.location='memberLeavePage.php';">离职成员名单</label>
				<div id="member">
					<?php
						require_once("showLeaveMember.php");
						showLeaveMember();
					?>
				</div>
			</div>
		</div>
	</div>

	<div id="comment" style="display:none;" >
		<div id="comEdit">
			<p id="comHeader" class="commentHeader"></p>
		</div>
		<p id="comBy" class="commentBy"></p>
		<?php 
			if(isset($_SESSION['authority']) && ($_SESSION['authority'] == 2 || $_SESSION['authority'] == 0))
				echo "<input type=\"button\" id=\"btnName\" class=\"leaveSubmit\" value=\"编辑评价\"/>";
		?>
		
	</div>

	<!-- <div id="overDiv" style="display:none;" onclick="hideTable();"></div> -->
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