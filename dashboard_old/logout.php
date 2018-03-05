<?php
		session_start();
			$_SESSION['pid'] = "";
			$_SESSION['uname'] = "";
			$_SESSION['img'] = "";
			session_destroy();
			header("Location:../login.php");
			
	
?>