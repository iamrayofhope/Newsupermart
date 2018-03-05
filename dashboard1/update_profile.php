<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		
		if(isset($_POST['update']))
		{
			
			$email = $_POST['email'];
			$ph_no = $_POST['phno'];
			$name =  $_POST['name'];	
			$nominee_name = $_POST['nominee'];
			$nominee_relation = $_POST['n_relation'];
			$father_name = $_POST['fname'];
			$gender = $_POST['gender'];
			$state = $_POST['state'];
			$city = $_POST['city'];
			$pin = $_POST['pin'];
			$country = $_POST['country'];
			$address = $_POST['addr'];
		
			include('lib/connect.php');
			$obj=new connect();
			
			$obj->UPDATE_DETAILS($name,$pid,$email,$ph_no,$nominee_name,$nominee_relation,$father_name,$gender,$state,$city,$pin,$country,$address);
			
			header("Location:profile_details.php");
			
		}
		else
			header("Location:index.php");
			
		
?>