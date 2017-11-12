<?php 
	function showUser()
	{
		error_reporting(0);
		require "connect.php";
		echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\">";
		echo "<tr>";
		echo "<td>";
		echo "<center><h2>后台数据库用户管理</h2></center>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		// mysql_query("set names utf8");
		$sql = "select * from $table_user";		
		// $result = mysql_query($sql,$link) or die(mysql_error());				//查询成员信息
		$result = $mysqli->query($sql);

		// $nums = odbc_num_rows($result);	
		$nums = $result->num_rows;										//成员总数
		$stuNumber = "m_number";												//假定表中学号 属性名为　 $stuNumber

		if( 0 == $nums )
		{
			echo "<table width=\"80%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
			echo "<tr>";
			echo "<td>";
			echo "<center><h4>暂无用户</h4></center>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		} 
		else
		{
			echo "<table width=\"90%\" cellpadding=\"1\" align=\"center\" bgcolor=\"#FFFFFF\" class=\"gridtable\">";
			echo "<tr>";
			echo "<th>ID</th><th>用户名</th><th>密码</th><th>身份</th><th>权限</th>";
			echo "<th colspan=\"2\">操作</th>";
			echo "</tr>";

			$sql = "select * from userT order by id";
			// $result = mysql_query($sql,$link) or die(mysql_error());

			// while($rows = mysql_fetch_array($result))
			while($row = $res->fetch_assoc())
			{							//循环显示成员信息
				$id = $row["id"];
				$username = $row["username"];
				$password = $row["password"];
				$authority = $row["authority"];
				$identity = $row["identity"];

				// $username = iconv('GBK','UTF-8',$username);
				// $password = iconv('GBK','UTF-8',$password);

				echo "<tr>";
				echo "<td>".$id."</td>";
				echo "<td>".$username."</td>";
				echo "<td>".$password."</td>";

				if($identity == 0)
				{
					echo "<td>教职工</td>";
				}
				else
				{
					echo "<td>学生</td>";
				}

				if($authority == 0)
				{
					echo "<td>管理员</td>";
				}
				elseif($authority == 1)
				{
					echo "<td>普通用户</td>";
				}
				elseif($authority == 2)
				{
					echo "<td>最高管理员</td>";
				}

				
				echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"编辑\"></td>";
				echo "<td><input class=\"button button-primary button-small\" type=\"button\" value=\"删除\"></td>";
				echo "</tr>";
			}
			
				
			echo "<tr><td></td><td><input type=\"text\" style=\"width:100%\"></td>
			<td><input type=\"text\" style=\"width:100%\"></td>";
			echo "<td><select><option value ='0'>教职工</option><option value ='1'>学生</option></select></td>";
			
			echo "<td><select><option value ='0'>管理员</option><option value ='1'>普通用户</option><option value ='2'>最高管理员</option></select></td>";
			echo "<td colspan=\"2\"><input type=\"button\" class=\"button button-primary button-small\" value=\"添加新用户\"></td>";
			echo "</table>";

			echo "</center>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}
	}
 ?>