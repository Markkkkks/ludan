<?php 
	function checkSession()
	{
		session_start();
		// if($_SESSION['username'] == null)
		if(!isset($_SESSION['username']))
		{
			header("location: login.php");
		}
	} 

	function checkAuthority()
	{
		if(!isset($_SESSION['authority']))
			return;
		if($_SESSION['authority'] == 0)
		{
			echo "管理员";
		}
		elseif ($_SESSION['authority'] == 1) {
			echo "普通用户";
		}
		elseif ($_SESSION['authority'] == 2) {
			echo "最高管理员";
		}
	}

	function inject_check($sql_str)
	{ 
    	return preg_match('script|select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
	} 
?>