<?php
	include('lib/connect.php');
	$obj=new connect();

	if(isset($_GET['sid'])){
		$arr=$obj->GET_UNAME($_GET['sid']);
		echo $arr[0];
	}
	else if(isset($_GET['email'])){
		if($obj->CHECK_EMAIL($_GET['email']))
			echo "1";	
		else
			echo "0";	
	}
	else
		header("Location:../login.php");
?>