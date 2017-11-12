<!DOCTYPE html>
<?php 
	error_reporting(0);
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
						<label onclick="document.location='searchpage.php';">按条件查询</label>
						<label onclick="document.location='searchUnfinishPage.php';">未完成卤蛋</label>
						<label class="checkLabel" onclick="document.location='searchfinishPage.php';">已完成卤蛋</label>
							<div class="myPanel">
								<?php 
									require_once("searchFinish.php");
									searchFinish();
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