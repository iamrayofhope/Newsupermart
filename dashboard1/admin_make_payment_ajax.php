<?php
	include('lib/connect.php');
	$obj=new connect();

	if($_SESSION['user']!="admin")
			header("Location:index.php");
	
	if(isset($_GET['id']) && isset($_GET['pid']) && isset($_GET['lid']))
	{
		
		$obj->ADMIN_MAKE_PAYMENT($_GET['id'],$_GET['pid'],$_GET['lid']);
		
	}
	else if(isset($_GET['salary_id']) && isset($_GET['profile_id']) && isset($_GET['slevel']) && isset($_GET['stime']) && isset($_GET['lid']))
	{
		$obj->ADMIN_MAKE_SALARY($_GET['salary_id'],$_GET['profile_id'],$_GET['slevel'],$_GET['stime'],$_GET['lid']);	
	}
	else
		header("Location:index.php");
	
?>