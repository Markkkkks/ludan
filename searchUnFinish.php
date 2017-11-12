<?php
	function searchUnFinish()
	{
		error_reporting(0);
		require "connect.php";
		// mysql_query("set names utf8");
		$sql = "select * from $table_mark where isFinish = 0";		
		// $result = @odbc_exec($conn, $sql);				//查询成员信息
		$result = $mysqli->query($sql);			//查询成员信息

		// $nums = odbc_num_fields(odbc_result_all($result));
		// $rs = odbc_result_all($result);
		$nums = $result->num_rows;

		// $nums = mysql_num_rows($result);											//成员总数
		$stuNumber = "m_number";												//假定表中学号 属性名为　 $stuNumber

		echo "<table width=\"100%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
		echo "<tr>";
		echo "<th>宿舍号</th><th>录入时间</th><th>维修人员</th><th>录单人员</th><th>故障类型</th><th>故障描述</th>";
		echo "<th>耗材</th><th>是否已完成</th>";
			
		echo "<th colspan=\"2\">操作</th>";
			
		echo "</tr>";

		if( 0 == $nums )
		{
			// echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
			echo "<tr>";
			echo "<td colspan=\"10\">";
			echo "<center><h4>暂无记录</h4></center>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		} 
		else
		{
			$count = 20;															//每页显示的成员数
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

			// $sql = "select * from b_ludan where l_isFinish = 0 order by l_time desc limit $s,$count";
			// $result = @mysql_query($sql,$link);
			$sql = "select top $count * from $table_mark where isFinish = 0
						and id not in(select top $s id from $table_mark order by mendTime desc) order by mendTime desc";
			// $result = odbc_exec($conn, $sql);
			$result = $mysqli->query($sql);

			// while($rows = mysql_fetch_array($result))
			// while(odbc_fetch_row($result))
			while($row = $result->fetch_assoc())
			{							//循环显示成员信息
				$id =$row["id"];
				$room =$row["room"];
				$mendTime =$row["mendTime"];
				$mendTime = substr($mendTime, 0, 19);
				$mender =$row["mender"];
				$marker =$row["marker"];
				$type =$row["type"];
				$reportText =$row["reportText"];
				$mendText =$row["mendText"];
				$cost =$row["cost"];

				// $room = iconv('GBK','UTF-8',$room);
				// $mendTime = iconv('GBK','UTF-8',$mendTime);
				// $mender = iconv('GBK','UTF-8',$mender);
				// $marker = iconv('GBK','UTF-8',$marker);
				// $reportText = iconv('GBK','UTF-8',$reportText);
				// $mendText = iconv('GBK','UTF-8',$mendText);
				// $cost = iconv('GBK','UTF-8',$cost);

				echo "<tr>";
				echo "<td>".$room."</td>";
				echo "<td>".$mendTime."</td>";
				echo "<td>".$mender."</td>";
				echo "<td>".$marker."</td>";
				switch ($type) {
					case 0:
						echo "<td>校园网</td>";
						break;
					case 1:
						echo "<td>电信网</td>";
						break;
					case 2:
						echo "<td>其他</td>";
						break;
					default:
						# code...
						break;
				}
				echo "<td>".$reportText."</td>";
				echo "<td>".$cost."</td>";
				echo "<td>未完成</td>";
				

				echo "<form method=\"post\" action=\"updateRecord.php\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\" />";
				echo "<td><input class=\"button button-primary button-small\" type=\"submit\" value=\"录入\"></td>";
				echo "</form>";
				echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"删除\"></td>";
				
				echo "</tr>";
			}
			
				
			echo "</table>";


			echo "<table width=\"100%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"pageturn\">";
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