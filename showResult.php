﻿<?php
	function showResult($room, $discribe, $solution, $cost, $isFinish)
	{
		error_reporting(0);
		require "connect.php";
		// mysql_query("set names utf8");

		// $discribe = iconv("UTF-8", "gbk", $discribe);
		// $solution = iconv("UTF-8", "gbk", $solution);
		// $cost = iconv("UTF-8", "gbk", $cost);

		if($room && $isFinish != 2)
		{
			$sql = "select * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
			 and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish'";	
		}
		else if($room && $isFinish == 2)
		{
			$sql = "select * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
			 and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%'";	
		}
		else if($room == NULL && $isFinish != 2)
		{
			$sql = "select * from $table_mark where reportText LIKE '%".$discribe."%'
			 and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish'";	
		}
		else if($room == NULL && $isFinish == 2)
		{
			$sql = "select * from $table_mark where reportText LIKE '%".$discribe."%'
			 and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%'";	
		}
		// $sql = "select * from b_ludan where l_isFinish = 1";		
		// $result = mysql_query($sql,$link) or die(mysql_error());	
		$result = $mysqli->query($sql);			

		// $nums = mysql_num_rows($result);
		// $nums = odbc_num_rows($result);	
		$nums = $result->num_rows;					
		// $stuNumber = "m_number";												
		echo "<strong style=\"color:red;font-size:14px;\"}>共匹配".$nums."条相关的";
		if($isFinish == 0)
			echo "未完成";
		else if($isFinish == 1)
			echo "已完成";
		echo "记录</strong>";
		echo "<table width=\"100%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
		echo "<tr>";
		echo "<th>宿舍号</th><th>录入时间</th><th>维修人员</th><th>录单人员</th><th>故障类型</th><th>故障描述</th><th>解决方法</th>";
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
			$p_count = ceil($nums/$count);									//向上取证为页数

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
			
			if($room && $isFinish != 2)
			{
				// $sql = "select * from mark where room = '$room' and discribe LIKE '%".$discribe."%'
				//  and solution LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish' order by l_time desc limit $s,$count";
				// $sql = "select top $count * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish'
				// 	and id not in(select top $s id from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish' order by mendTime desc) 
				// 		order by mendTime desc";
				$sql = 	"select * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
				and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish' 
				ORDER BY mendtime DESC limit ".($page-1)*20 .", $count
				";	
			}
			else if($room && $isFinish == 2)
			{
				// $sql = "select * from $table_ld where l_roomNum = '$room' and l_discribe LIKE '%".$discribe."%'
				//  and l_solution LIKE '%".$solution."%' and l_cost LIKE '%".$cost."%' order by l_time desc limit $s,$count";	
				// $sql = "select top $count * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%'
				// 	and id not in(select top $s id from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' order by mendTime desc) 
				// 		order by mendTime desc";	
				
				$sql = "select * from $table_mark where room LIKE '%".$room."%' and reportText LIKE '%".$discribe."%'
					and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' ORDER BY mendtime DESC limit ".($page-1)*20 .", $count
					";	
			}
			else if($room == NULL && $isFinish != 2)
			{
				// $sql = "select top $count * from $table_mark where reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish'
				// 	and id not in(select top $s id from $table_mark where reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' order by mendTime desc) 
				// 		order by mendTime desc";		
				$sql = "select * from $table_mark where reportText LIKE '%".$discribe."%'
				and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish' 
				ORDER BY mendtime DESC limit ".($page-1)*20 .", $count
				";	
			}
			else if($room == NULL && $isFinish == 2)
			{
				// $sql = "select top $count * from $table_mark where reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%'
				// 	and id not in(select top $s id from $table_mark where reportText LIKE '%".$discribe."%'
				// 	and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' order by mendTime desc) 
				// 		order by mendTime desc";
				$sql = "select * from $table_mark where   reportText LIKE '%".$discribe."%'
				and mendText LIKE '%".$solution."%' and cost LIKE '%".$cost."%' and isFinish = '$isFinish' 
				ORDER BY mendtime DESC limit ".($page-1)*20 .", $count
				";	
			}
			// $sql = "select * from b_ludan where l_isFinish = 1 order by l_time desc limit $s,$count";
			// $result = mysql_query($sql,$link) or die(mysql_error());
			$result = $mysqli->query($sql);

			while($row = $result->fetch_assoc())
			{							//循环显示成员信息
				$id = $row["id"];
				$room = $row["room"];
				$mendTime = $row["mendTime"];
				$mendTime = substr($mendTime, 0, 19);
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
				echo "<td>".$mendText."</td>";
				echo "<td>".$cost."</td>";
				if($isFinish == 1)
				{
					echo "<td>已完成</td>";
				}
				else
					echo "<td>未完成</td>";

				echo "<form method=\"post\" action=\"updateRecord.php\">";
				echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\" />";
				echo "<td><input class=\"button button-primary button-small\" type=\"submit\" value=\"修改\"></td>";
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