<?php
	include('lib/connect.php');
	$obj=new connect();

		date_default_timezone_set("Asia/Kolkata");
		$date = date('d-m-Y h:i:s A');

	if(isset($_POST['login']) && !empty($_POST['submit']))
	{

           

//		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
//		{
				//your site secret key
//				$secret = '6Lf5iEEUAAAAADQTKXMRsD1bnnunmnDrb43yianX';
				//get verify response data
//				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
//				$responseData = json_decode($verifyResponse);
//				if($responseData->success){



				$pid = $_POST['pid'];
				$pwd = $_POST['pwd'];
		
					if($obj->CHECK_USER($pid,$pwd)){
							$arr = $obj->USER_DETAILS($pid);
							session_start();
							$_SESSION['pid'] = $pid;
							$_SESSION['uname'] = $arr['name'];
							$_SESSION['img'] = $arr['img1'];
							header("Location:index.php");
					}
					else
						header("Location:login.php");


//				}
//			}
	}
	else if(isset($_POST['register']))
	{
		$pid = "as57h";
		$email = $_POST['email'];
		$name = $_POST['uname'];
		$pwd = $_POST['pwd'];
		$sid = $_POST['sid'];
		$phno = $_POST['phno'];
		
		$pwd = password_hash($pwd, PASSWORD_DEFAULT); //bcrypt hash
		$check1 = $obj->CHECK_EMAIL($email);
		
		$check2 = count($obj->GET_UNAME($sid));
		
		if(!$check1 && $check2)
		{
			$n = $obj->ADD_USER($pid,$name,$email,$pwd,$sid,$phno,$date);
			if($n)
				header("Location:login.php?n=".md5("yUp"));
			else
				header("Location:login.php?n=".md5("noPe"));
		}
		else
			header("Location:login.php?n=".md5("eMailoRsPonsoriD"));
	}
	
?>