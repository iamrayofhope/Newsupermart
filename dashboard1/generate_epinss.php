<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		if($_SESSION['user']!="admin")
			header("Location:404.html");
			
		include('lib/connect.php');
		$obj=new connect();
		
		if(isset($_POST['generate']))
		{
			$num = $_POST['number'];
			$obj->EPINS($num,$pid);
			
			header("Location:generate_epins.php?msg=".md5(1));
		}
			header("Location:generate_epins.php?msg=".md5(0));
			
?>