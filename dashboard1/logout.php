<?php
		session_start();
			$_SESSION['pid'] = "";
			$_SESSION['uname'] = "";
			$_SESSION['img'] = "";
			$_SESSION['user'] = "";
			session_destroy();
			header("Location:../login.php");
			
	
?>