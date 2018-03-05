<?php
	include('dashboard1/lib/connect.php');
	$obj=new connect();

		date_default_timezone_set("Asia/Kolkata");
		$date = date('d-m-Y h:i:s A');

	if(isset($_POST['login']))
	{
		$pid = $_POST['pid'];
		$pwd = $_POST['pwd'];
		
		if($obj->CHECK_USER($pid,$pwd)){
				$arr = $obj->USER_DETAILS($pid);
				$status = $obj->CHECK_STATUS($pid);
				session_start();
				$_SESSION['pid'] = $pid;
				$_SESSION['uname'] = $arr['name'];
				$_SESSION['img'] = $arr['img1'];
				$_SESSION['status'] = $status;
				$_SESSION['user'] = ($pid == 5438176)?"admin":"user";
				
				if($pid!=5438176)
				{
					$total_team = $obj->COUNT_TOTAL_ACTIVE_TEAM($pid);
					$self_team = count($obj->COUNT_SELF_ACTIVE_TEAM($pid,0));
					$direct_team = $obj->COUNT_DIRECT_ACTIVE_TEAM($pid);
					$current_gift = $obj->LAST_GIFT($pid);
					$current_level = $current_gift['level_id'];
					
					$income_chart=$obj->INCOME_CHART_BY_LEVEL($current_level+1);
					if($total_team >= $income_chart['total_team'] && $self_team >= $income_chart['self_team'] && $direct_team >= $income_chart['referral'] && $total_team!=0 && $self_team!=0 && $direct_team!=0)
					{
						$d1=date("Y-m-d");
						$obj->ADD_GIFT($current_level+1,$pid,$d1);
						$obj->ADD_PAYOUT($current_level+1,$pid,$d1);
						$obj->ADD_SALARY($current_level+1,$pid,$d1);	
							
					}
                                        
						
				}
				
				header("Location:dashboard1/index.php");
		}
		else
			header("Location:login.php");
	}
	else if(isset($_POST['register']))
	{
		$pid = "as57h";
		$email = $_POST['email'];
		$name = $_POST['uname'];
		$pwd = $_POST['pwd'];
		$sid = $_POST['sid'];
		$phno = $_POST['phno'];
		
		//$pwd = password_hash($pwd, PASSWORD_DEFAULT); //bcrypt hash
		//$check1 = $obj->CHECK_EMAIL($email);
		
		$check2 = count($obj->GET_UNAME($sid));
		
		if($check2)
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