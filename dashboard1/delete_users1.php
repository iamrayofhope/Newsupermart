<?php
		session_start();
		if($_SESSION['user']!="admin")
			header("Location:index.php");
		include('lib/connect.php');
		$obj=new connect();
		
		if(isset($_GET['pid']))
		{
			$pid=$_GET['pid'];
			$c = $obj->COUNT_DIRECT_ACTIVE_TEAM($pid);
			if($c==0)
			{
				$n = $obj->DELETE_USER($pid);
				if($n)
					header("Location:delete_users.php?pid=".$pid."&s=".md5("yEs"));
				else	
				header("Location:delete_users.php?pid=".$pid."&s=".md5("nOt"));
							
			}
			else
				header("Location:index.php");	
		}
		else
			header("Location:index.php");
		
?>
		
		


                      
						
