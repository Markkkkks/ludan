<?php 
	error_reporting(0);
	if($_POST['submit'])
	{
		$room = $_POST['room'];
		$discribe = $_POST['discribe'];
		$solution = $_POST['solution'];
		$cost = $_POST['cost'];
		$isFinish = $_POST['isFinish'];
		require_once("showResult.php");
		showResult($room, $discribe, $solution, $cost, $isFinish);
	}
?>