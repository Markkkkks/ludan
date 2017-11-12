<?php 
	function showLeaveMember()
	{
		error_reporting(0);
		require "connect.php";
		echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\">";
		echo "<tr>";
		echo "<td>";
		echo "<center><h2>网络中心服务小组离职成员名单</h2></center>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		// mysql_query("set names utf8");
		$sql = "select * from $table_memLeave";		
		// $result = @mysql_query($sql,$link);				//查询成员信息
		$result = $mysqli->query($sql);

		// $nums = mysql_num_rows($result);
		// $nums = @odbc_num_rows($result);											//成员总数
		$nums = $result->num_rows;
		$stuNumber = "m_number";												//假定表中学号 属性名为　 $stuNumber

		echo "<table width=\"95%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
		echo "<tr>";
		echo "<th>学号</th><th>姓名</th><th>籍贯</th><th>年级</th><th>学院专业</th>";
		echo "<th>入职时间</th><th>离职时间</th><th>联系方式</th>";
		echo "<th>毕业去向</th><th>签约薪资</th><th>评价</th>";
		if(isset($_SESSION['authority']) && ($_SESSION['authority'] == 0 || $_SESSION['authority'] == 2))
		{
			echo "<th colspan=\"2\">操作</th>";
		}
		echo "</tr>";

		if( 0 == $nums )
		{
			// echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
			echo "<tr>";
			echo "<td colspan=\"11\">";
			echo "<center><h4>暂无成员</h4></center>";
			echo "</td>";
			echo "</tr>";

			if(isset($_SESSION['authority']) && ($_SESSION['authority'] == 0 || $_SESSION['authority'] == 2))
			{
				
				echo "<tr><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td colspan=\"3\"><input type=\"button\" class=\"button button-primary button-small\" value=\"添加新成员\"></td></tr>";
			}  

			echo "</table>";
		} 
		else
		{
			$count = 10;															//每页显示的成员数
			$p_count = ceil($nums/$count);

			if ($_GET['page'] == 0 && !$_GET['page'])
			{								//未选择显示页数
				$page = 1;
			}
			elseif($_GET['page'] < 0)
			{
				$page = 1;
			}
			elseif($_GET['page'] > $p_count)
			{
				$page = $p_count;
			}
			else
			{	
				$page = $_GET['page'];											//获取当前页
			}	
			$s = ($page-1)*$count ;
			

			// $sql = "select * from $table_member order by m_state, m_number limit $s,$count";
			$sql = "select top $count * from $table_memLeave where id not in 
				(select top $s id from $table_memLeave order by id desc) order by id desc";
				$sql = "select  * from $table_memLeave order by id desc limit ".($page-1)*10 .", $count";
			// $result = @mysql_query($sql,$link);
			$result = $mysqli->query($sql);

			// while($rows = mysql_fetch_array($result))
			// while(odbc_fetch_row($result))
			while($row = $result->fetch_assoc())
			{							//循环显示成员信息
				$id = $row["id"];
				$name = $row["name"];
				$hometown = $row["hometown"];
				$grade = $row["grade"];
				$profession = $row["profession"];
				$timeIn = $row["timeIn"];
				$timeOut = $row["timeOut"];
				$contact = $row["contact"];
				$graduateWork = $row["graduateWork"];
				$offer = $row["offer"];

				// $id = iconv('GBK','UTF-8',$id);
				// $name = iconv('GBK','UTF-8',$name);
				// $hometown = iconv('GBK','UTF-8',$hometown);
				// $grade = iconv('GBK','UTF-8',$grade);
				// $profession = iconv('GBK','UTF-8',$profession);
				// $timeIn = iconv('GBK','UTF-8',$timeIn);
				// $timeOut = iconv('GBK','UTF-8',$timeOut);
				// $contact = iconv('GBK','UTF-8',$contact);
				// $graduateWork = iconv('GBK','UTF-8',$graduateWork);
				// $offer = iconv('GBK', 'UTF-8', $offer);

				echo "<tr>";
				echo "<td>".$id."</td>";
				echo "<td>".$name."</td>";
				echo "<td>".$hometown."</td>";
				echo "<td>".$grade."</td>";
				echo "<td>".$profession."</td>";
				echo "<td>".$timeIn."</td>";
				echo "<td>".$timeOut."</td>";
				echo "<td>".$contact."</td>";
				echo "<td>".$graduateWork."</td>";
				echo "<td>".$offer."</td>";
				// echo "<td><a onclick=\"showComment();\" class=\"alinkToCom\">点击查看</a></td>";
				echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"查看\"></td>";

				// 面对管理员显示，对成员不显示   通过 _GET['权限'],判断是否显示
			if(isset($_SESSION['authority']) && ($_SESSION['authority'] == 0 || $_SESSION['authority'] == 2))
			{
				
			echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"编辑\"></td>";
			echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"删除\"></td>";
			}
				echo "</tr>";
			}
						// 面对管理员显示，对成员不显示   通过 _GET['权限'],判断是否显示
			if(isset($_SESSION['authority']) && ($_SESSION['authority'] == 0 || $_SESSION['authority'] == 2))
			{
				echo "<tr><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td><td><input type=\"text\" style=\"width:100%\"></td>";
				echo "<td colspan=\"2\"><input type=\"button\" class=\"button button-primary button-small\" value=\"添加新成员\"></td></tr>";
			}  
				
			echo "</table>";


			echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"pageturn\">";
			echo "<tr><td><center>";
			$prev_page = $page-1;
			$next_page = $page+1;

			if($page <= 1 )
			{
				echo "第一页  | ";
			} 
			else 
			{
				echo "<a href='$PATH_INFO?page=1'>第一页  </a>| ";
			}
			if($prev_page < 1 )
			{
				echo "上一页  | ";
			} 
			else 
			{
				echo "<a href='$PATH_INFO?page=$prev_page'>上一页  </a>| ";
			}
			if( $next_page > $p_count )
			{
				echo "下一页  | ";
			}
			else 
			{
				echo "<a href='$PATH_INFO?page=$next_page'>下一页  </a>| ";
			}
			if( $page >= $p_count )
			{
				echo "最后一页  | ";
			} 
			else 
			{
				echo "<a href='$PATH_INFO?page=$p_count'>最后一页  </a>| ";
			}

			echo "第".$page."页/共".$p_count."页 ";
			echo "<form action=\"$PATH_INFO\" method=\"GET\" id=\"pageLink\">";
			echo "<input type=\"text\" name=\"page\"/ size=\"1\">";
			echo "<input type=\"submit\" value=\"跳到此页\">";
			echo "</form>";

			echo "</center>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}
	}
 ?>