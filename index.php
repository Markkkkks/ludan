<!DOCTYPE html>
<?php 
	require_once("check.php");
	checkSession();
 ?>
<html>
<head>
	<title>卤蛋3.0</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/echarts-all.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/updatePwd.js" charset="utf-8"></script>
	<script type="text/javascript">
		function hideTable(){
			document.getElementById("updatePwd").style.display = "none";
			document.getElementById("overDiv").style.display = "none";
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
				<li id="nav_new"><a title="" href="newpage.php">新建卤蛋</a></li>
				<li id="nav_search"><a title="" href="searchpage.php">查询卤蛋</a></li>
				<li id="nav_member"><a title="" href="memberpage.php">成员管理</a></li>
				<?php 
					if(isset($_SESSION['authority']) && $_SESSION['authority'] == 2)
					{
						echo "<li id=\"nav_admin\"><a href=\"userpage.php\">用户管理</a></li>";
					}
				?>
			</ul>
			<!-- <div id="logout"><a href="logout.php">退出登录</a></div> -->
			<div class="header-bot">
		 	<span class="hbQuit" onclick="document.location='logout.php';"></span>
		 	<!-- <span class="hbQa" onclick="alert('该功能还未上线，敬请期待！');"></span> -->
		 	<span class="hbQa" onclick="updatePwd();"></span>
		 	<div class="hb3"></div>
		 	<p>Copyright © 2015-2015 网络中心. 保留所有权利</p>
		 </div>
		 </nav>
	</header>

	<div id="main">
		<div id="container">
			<div id="welcome"><p>欢迎<strong><?php if(
				isset($_SESSION['name']))
					echo $_SESSION['name']; ?></strong>进入卤蛋系统，您的权限是<strong><?php checkAuthority(); ?></strong></p></div>
			<div id="up">
				<?php 
					error_reporting(0);
					require "connect.php";
					// mysql_query("set names utf8");
					// $state = '在职';
					// $state = iconv("utf-8", "gbk", $state);
					// $sql = "select name from $table_member where state = '$state'";		
					$sql = "select name from $table_member";

					// $result = @mysql_query($sql,$link);
					// $result = @odbc_exec($conn, $sql);
					$result = $mysqli->query($sql);

					// $nums = mysql_num_rows($result);	
					$nums = $result->num_rows;
				 ?>
				<div id="upleft">
					<img src="img/rank.png" width="60%" height="350px" class="rankimg">
					<?php
						$current = date("Y-m");
						while ($row = $result->fetch_assoc())
						{
							// $name = odbc_result($result, "name");
							$name = $row["name"];
							$query = "select * from $table_mark where mender LIKE'%".$name."%' 
					                    	and isFinish = 1 and mendTime LIKE'%".$current."%'";
							// $res = @mysql_query($query, $link);
							
							// $res = @odbc_exec($conn, $query);
							$res = $mysqli->query($query);
							
					        // $count = mysql_num_rows($res);
							// $count = odbc_num_rows($res);
							$count = $res->num_rows;
					        // $name = iconv("gbk", "utf-8", $name);
					        $array["$name"] = $count;
						}
						
						arsort($array);
						$i = 0;
						foreach ($array as $key => $value) {
							# code...
							$arr[$i] = $key;
							$i ++;
						}
					?>
					<div id="rankname"><p><?php echo $arr[1]; ?></p><p><?php echo $arr[0]; ?></p><p><?php echo $arr[2]; ?></p></div>
				</div>
				<div id="upcontent"></div>
				<script type="text/javascript">
					var myChart = echarts.init(document.getElementById('upcontent')); 

			        var option = {
			            tooltip: {
			                show: true
			            },
			            legend: {
			                data:['本月工作量']
			            },
			            color: ['#99d9eb'],
			            xAxis : [
			                {
			                    type : 'category',
			                    axisLabel:{
                           		interval:0,
                        		// rotate:45,
                         		// 	margin:2,
                         		formatter:function(val){
									    return val.split("").join("\n");
									}
                     			},
			                    data : [<?php
			                    	$n = $nums; 
			                    	// $result = @mysql_query($sql, $link);
									// $result = @odbc_exec($conn, $sql);
									$result = $mysqli->query($sql);


			                    	// while (odbc_fetch_row($result)) {
									while ($row = $result->fetch_assoc()) {
			                    	--$n;
									// $name = odbc_result($result, "name");
									$name = $row["name"];
			                    	// $name = iconv("gbk", "utf-8", $name);
			                    	if($n != 0)
			                    	{
			                    		echo "\"".$name."\",";
			                    	}
			                    	else
			                    		echo "\"".$name."\"";
			                    } ?>]
			                }
			            ],
			            yAxis : [
			                {
			                    type : 'value'
			                }
			            ],
			            series : [
			                {
			                    "name":"本月工作量",
			                    "type":"bar",
			                    // "data":[5, 20, 40, 10, 10, 20,50,40,60]
			                    "data":[
				                    <?php 
										$n = $nums;
										
					                    // $result = @mysql_query($sql, $link);
										// $result = @odbc_exec($conn, $sql);
										$result = $mysqli->query($sql);

					                    while ($row = $result->fetch_assoc())
					                    {
					                    	--$n;
											// $name = odbc_result($result, "name");
											$name = $row["name"];
					                    	$query = "select * from $table_mark where mender LIKE '%".$name."%' 
											and isFinish = 1 and mendTime LIKE'%".$current."%'";
											
					                    	// $res = @mysql_query($query, $link);
											// $res = @odbc_exec($conn, $query);
											$res = $mysqli->query($query);

					                    	// $count = mysql_num_rows($res);
											// $count = odbc_num_rows($res);
											$count = $res->num_rows;
					                    	if($n != 0)
					                    		echo "$count,";
					                    	else
					                    		echo $count;
					                    } 
					                ?>
			                    ]
			                }
			            ]
			        };

			        // 为echarts对象加载数据 
			        myChart.setOption(option);
				</script>
			</div>
			<div id="clear"></div>
			<div id="down">
				<div id="downcontent"></div>
				<script type="text/javascript">
						var myChart = echarts.init(document.getElementById('downcontent')); 
						var option = {
							title : {
					        text: '本月各楼栋报修情况',
					        x:'center'
					    },
					    tooltip : {
					        trigger: 'item',
					        formatter: "{b} : {c} ({d}%)"
					    },
					    legend: {
					        orient : 'vertical',
					        x : 'left',
					        data:['一栋','二栋','三栋','四栋','五栋','六栋','七栋','八栋','九栋']
					    },
					    calculable : true,

					    <?php 
					    	$j = 1;
					    	for($k = 0; $k < 9; $k ++)
					    	{
						    	$str = "select * from  $table_mark where room LIKE '".$j."%' and mendTime LIKE'%".$current."%'";
						    	// $r = @mysql_query($str, $link);
								// $r = @odbc_exec($conn, $str);
								$r = $mysqli->query($str);

						    	// $ar[$k] = mysql_num_rows($r);
								// $ar[$k] = odbc_num_rows($r);
						    	$ar[$k] = $r->num_rows;
								
						    	$j ++;
					    	}
					    ?>

					    series : [
					        {
					            type:'pie',
					            radius : '55%',
					            center: ['50%', '60%'],
					            data:[
					                {value:<?php echo $ar[0]; ?>, name:'一栋'},
					                {value:<?php echo $ar[1]; ?>, name:'二栋'},
					                {value:<?php echo $ar[2]; ?>, name:'三栋'},
					                {value:<?php echo $ar[3]; ?>, name:'四栋'},
					                {value:<?php echo $ar[4]; ?>, name:'五栋'},
					                {value:<?php echo $ar[5]; ?>, name:'六栋'},
					                {value:<?php echo $ar[6]; ?>, name:'七栋'},
					                {value:<?php echo $ar[7]; ?>, name:'八栋'},
					                {value:<?php echo $ar[8]; ?>, name:'九栋'}
					            ]
					        }
					    ]
					 };

					// 为echarts对象加载数据 
					 myChart.setOption(option);
				</script>
				<div id="downright">
					<img src="img/duang.png" width="60%" height="350px" class="duangimg">
					<?php 
						arsort($ar);
						$i = 0;
						foreach ($ar as $key => $value) {
							# code...
							$a[$i] = $key;
							$i ++;
						}
					 ?>
					<div id="building"><p><?php echo $a[1] + 1 ?>栋</p><p><?php echo $a[0] + 1 ?>栋</p><p><?php echo $a[2] + 1 ?>栋</p></div>
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