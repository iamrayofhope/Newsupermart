<?php
	class connect{
		private $db_host="localhost";
		private $db_user="i4301252_wp2";
		private $db_pwd="P#Prhsyr*KHSCM]ED@.65@.0";
		private $db_name="i4301252_wp2";
		private $db;
		protected $con;
		function __construct()
		{
			$this->con = mysqli_connect($this->db_host,$this->db_user,$this->db_pwd,$this->db_name);

			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			            
		}
		//========================== PROFILE==============================================
		/*function get_Child($pid)
		{
			$sql = "select  id,child_id,parent_id from (select * from tbl_tree order by parent_id, id) tbl_tree,(select @pv := '1') initialisation where find_in_set(parent_id, @pv) > 0 and @pv := concat(@pv, ',', id)";	
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;
		}
		
		
		function COUNT_SELF_TEAM($pid)
		{
			$sql = "SELECT * FROM tbl_tree AS T1 INNER JOIN (SELECT child_id FROM tbl_tree WHERE parent_id = '$pid') AS T2 ON T2.child_id = T1.parent_id AND T1.parent_id != '$pid' GROUP BY T1.child_id";
			$res = mysqli_query($this->con,$sql);
			$c = mysqli_num_rows($res);
			return $c;
		}
		*/
		function GET_TREE_ROW_BY_CHILD($child_id)
		{
			$sql = "SELECT * FROM tbl_tree WHERE child_id='$child_id'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_array($res);
			return $arr;
		}
		function GET_ONE_LEVEL($pid){
			$query=mysqli_query($this->con,"SELECT * FROM tbl_tree WHERE parent_id='".$pid."'");
			$p_id=array();
			
			if(mysqli_num_rows($query)>0){
				while($result=mysqli_fetch_assoc($query)){
					$p_id[]=$result['child_id'];
				}
			  
			}
			
			return $p_id;
		}

		function GET_SELF_TEAM($parent_id,$c, &$tree_st=array()) {
			$tree = array();
			
			// getOneLevel() returns a one-dimensional array of child ids        
			$tree = $this->GET_ONE_LEVEL($parent_id);     
			if(count($tree)>0 && is_array($tree)){  
				if($c++!=0)    
				$tree_st=array_merge($tree_st,$tree);
			}
			foreach ($tree as $key => $val) {
				$this->GET_SELF_TEAM($val,$c, $tree_st);
			}   
			return $tree_st;
		}


		/*function GET_ONE_LEVEL2($pid){
			$query=mysqli_query($this->con,"SELECT * FROM tbl_tree WHERE parent_id='".$pid."' AND child_status=1");
			$p_id=array();
			
			if(mysqli_num_rows($query)>0){
				while($result=mysqli_fetch_assoc($query)){
					$p_id[]=$result['child_id'];
				}
			  
			}
			
			return $p_id;
		}*/

		function GET_SELF_TEAM2($parent_id,$c, &$tree_st=array()) {
			$tree = array();
			
			// getOneLevel() returns a one-dimensional array of child ids        
			$tree = $this->GET_ONE_LEVEL2($parent_id);     
			if(count($tree)>0 && is_array($tree)){  
				if($c++!=0)    
				{
					$tree_st=array_merge($tree_st,$tree);
					
				}
				//$count+=count($tree);
			}
			foreach ($tree as $key => $val) {
				$this->GET_SELF_TEAM2($val,$c, $tree_st);
			}   
			return $tree_st;
		}


		function COUNT_SELF_TEAM($pid,$level) {
				$directDescendents = mysqli_query($this->con,"SELECT child_id FROM tbl_tree WHERE parent_id = '$pid'");
				if($level!=0)
					$count = mysqli_num_rows($directDescendents);
				else
					$count=0;
				while($row =mysqli_fetch_array($directDescendents))
					$count += $this->COUNT_SELF_TEAM($row['child_id'],$level+1);
				return $count;
		}
		
		function CHECK_USER($pid,$pwd)
		{
                        //$this->securityy();
			$sql = "SELECT pwd FROM tbl_users WHERE profile_id='$pid'";
			$res = mysqli_query($this->con,$sql);
			$arr = mysqli_fetch_row($res);
			if(password_verify($pwd, $arr[0]))
				return true;
			
			return false;
			//$res=mysql_query($sql,$this->con)  or die(mysql_error());
			
		}
		
		function USER_DETAILS($pid)
		{
			$sql = "SELECT * FROM tbl_users WHERE profile_id='$pid'";
			$res = mysqli_query($this->con,$sql);
			$arr = mysqli_fetch_array($res);
			return $arr;
		}
		
		function ADD_USER($pid,$name,$email,$pwd1,$sid,$phno,$date)
		{
                        $pid = strip_tags($pid);
                        $name = strip_tags($name);
                        $email = strip_tags($email);
                        $pwd1 = strip_tags($pwd1);
                        $sid = strip_tags($sid);
                        $phno = strip_tags($phno);
                        $date = strip_tags($date);
                        $pwd = password_hash($pwd1, PASSWORD_DEFAULT); //bcrypt hash
			$num= mt_rand(100000,9999999);
			$sel_query  = "SELECT profile_id  FROM  tbl_users WHERE profile_id =%d"; // query to select value 
			$ins_query = "INSERT INTO tbl_users(profile_id) VALUES(%d)";    // query to insert value
			$result =  mysqli_query($this->con,sprintf($sel_query,$num));
			while( mysqli_num_rows($result) != 0 ) {                      // loops till an unique value is found 
				$num = mt_rand(100000,9999999);
				$result = mysqli_query($this->con,sprintf($sel_query,$num));
			}

			
			$sql="INSERT INTO tbl_users(profile_id,name,email,pwd,ph_no,created_date) VALUES ('$num','$name','$email','$pwd','$phno','$date')";
			$n = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			$sql="INSERT INTO tbl_tree(parent_id,child_id) VALUES ('$sid','$num')";
			$n1 = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			//$sql2 = "INSERT INTO wp_sm_salary (profile_id) VALUES('$num')";
			//$n2 = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
			
			//$sql3 = "INSERT INTO wp_sm_payout (profile_id) VALUES('$num')";
			//$n3 = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
			
			//$sql4 = "INSERT INTO wp_sm_gift (profile_id) VALUES('$num')";
			//$n4 = mysqli_query($this->con,$sql4) or die(mysqli_error($this->con));
			
		

			if($n && $n1)
			{
				//$d1=date("Y-m-d");
				$this->ADD_GIFT(0,$num);
				$this->ADD_PAYOUT(0,$num);
				$this->ADD_SALARY(0,$num);	
				
				
				
				
$msg9 = "Welcome ".$name." to New SuperMart! Your Profile id : ".$num.". & Password : ".$pwd1.". Thank you for joining with us.";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.msg91.com/api/v2/sendsms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"sender\": \"NSMART\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"".$msg9."\", \"to\": [ ".$phno." ] } ] }",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTPHEADER => array(
    "authkey: 195331AElt4D91B5a6c2bb9",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
				
			
				
				

				$to      = $email.",users@newsupermart.com";
				$subject = 'New Register On New Super Mart';
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: admin@newsupermart.com' . "\r\n" .
					    'X-Mailer: PHP/' . phpversion();
				
				$message = '<html><body align="center">';
				$message .= '<img src="http://www.newsupermart.com/wp-content/uploads/2018/01/cropped-65c04767-18b4-41cb-95f2-e8b8a06cb294-e1516477176557.png" alt="NEWSUPERMART" />';
				$message .= '<h3>WELCOME '.$name.' TO NEWSUPERMART<h3>';
				$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$message .= '<tr><th>Profile Id : </th><td>'.$num.'</td></tr>';
				$message .= '<tr><th>Password : </th><td>'.$pwd1.'</td></tr>';
				$message .= '<tr><th>Login URL (main) : </th><td><a href="http://www.newsupermart.com/dashboard1/">Click Here</a></td></tr>';
				$message .= "</table>";
				$message .= "</body></html>";
				
				
				/*$message = 'Now You are a member of New Super Mart.<br>Login URL : http://www.newsupermart.com/dashboard1/ Profile id : '.$num.' Password : '.$pwd1;*/
				
				mail($to, $subject, $message, $headers);

			}

			mysqli_close($this->con);

			if($n && $n1)
				return true;
			return false;
				
				
			
		}
		
		function GET_UNAME($id)
		{
			$sql = "SELECT name FROM tbl_users WHERE profile_id='$id'";
			$res = mysqli_query($this->con,$sql);
			
			$arr = mysqli_fetch_row($res);
			return $arr;	
		}

		function CHECK_EMAIL($email)
		{
			$sql = "SELECT COUNT(*) FROM tbl_users WHERE email='$email'";
			$res = mysqli_query($this->con,$sql);
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		
		function UPDATE_PASSWORD($pid,$cpwd,$pwd)
		{
			$pwd = password_hash($pwd, PASSWORD_DEFAULT);
			$sql = "SELECT pwd FROM tbl_users WHERE profile_id='$pid'";
			$res = mysqli_query($this->con,$sql);
			$arr = mysqli_fetch_row($res);
			if(password_verify($cpwd, $arr[0]))
			{
				$sql2 = "UPDATE tbl_users SET pwd='$pwd' WHERE profile_id='$pid'";
			
				mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));	
				return true;
			}
			else
				return false;
			
	
		}
		/*function GET_USER_DETAILS($pid)
		{
			$sql = "SELECT * FROM tbl_users WHERE profile_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			return $arr;
			
		}*/

		function COUNT_DIRECT_TEAM($pid)
		{
			$sql = "SELECT COUNT(*) FROM tbl_tree WHERE parent_id='$pid' ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		function GET_DIRECT_TEAM($pid)
		{
			$sql = "SELECT * FROM tbl_tree WHERE parent_id='$pid' ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			//$arr = mysqli_fetch_row($res);
			return $res;
		}
		/*function GET_SELF_TEAM($pid)
		{
			$sql = "SELECT * FROM tbl_tree AS T1 INNER JOIN (SELECT child_id FROM tbl_tree WHERE parent_id = '$pid') AS T2 ON T2.child_id = T1.parent_id AND T1.parent_id != '$pid' GROUP BY T1.child_id  ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql);
			return $res;
				
		}*/
		function COUNT_TOTAL_TEAM($pid)
		{
			$sql = "SELECT count(*) FROM tbl_users WHERE id>(SELECT id FROM tbl_users WHERE profile_id='$pid')";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		
		function GET_TOTAL_TEAM($pid)
		{
			$sql = "SELECT * FROM tbl_users WHERE id>(SELECT id FROM tbl_users WHERE profile_id='$pid') ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			//$arr = mysqli_fetch_row($res);
			return $res;
		}
		
		function GET_PARENT_ID($pid)
		{
			$sql = "SELECT parent_id FROM tbl_tree WHERE child_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			return $arr[0];
			
		}
		
		function CHECK_STATUS($pid)
		{
			$sql = "SELECT child_status FROM tbl_tree WHERE child_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			return $arr[0];
			
		}
		
		function UPDATE_DETAILS($name,$pid,$email,$ph_no,$nominee_name,$nominee_relation,$father_name,$gender,$state,$city,$pin,$country,$address)
		{
			$sql = "UPDATE tbl_users SET name='$name',email='$email',ph_no='$ph_no',nominee_name='$nominee_name',nominee_relation='$nominee_relation',father_name='$father_name',gender='$gender',state='$state',city='$city',pin='$pin',country='$country',address='$address' WHERE profile_id='$pid'";
			//$sql = "SELECT COUNT(*) FROM tbl_tree WHERE parent_id='$pid' ORDER BY id DESC";
			mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
		}
		
		function GET_SPONSOR_ID($pid)
		{
			$sql = "SELECT parent_id FROM tbl_tree WHERE child_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			return $arr[0];
		}
		
		
		function EPINS($num1,$pid)
		{
			$d1 = date("Y-m-d");
			//$d2 = date('Y-m-d', strtotime('+1 year'));
			
			for($i=1;$i<=$num1;$i++)
			{
			
				$num= mt_rand(1,9999999);
				$cr = md5($num);
				$cr1 = substr($cr,0,rand(5,8));
				$sel_query  = "SELECT unique_id  FROM  wp_sm_epins WHERE unique_id =%d"; // query to select value 
				$ins_query = "INSERT INTO wp_sm_epins(unique_id) VALUES(%d)";    // query to insert value
				$result =  mysqli_query($this->con,sprintf($sel_query,$cr1));
				while( mysqli_num_rows($result) != 0 ) {                      // loops till an unique value is found 
					$num = mt_rand(100000,9999999);
					$cr = md5($num);
					$cr1 = substr($cr,0,rand(5,8));
					
					$result = mysqli_query($this->con,sprintf($sel_query,$cr1));
				}
				$sql="INSERT INTO wp_sm_epins(unique_id,owner_id,date1,status) VALUES ('$cr1','$pid','$d1',0)";
				$n = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			}
			mysqli_close($this->con);	

		}
		
		function GET_EPINS($pid)
		{
			//if($_SESSION['user']=="admin")
			$sql = "SELECT * FROM wp_sm_epins WHERE owner_id='$pid' AND (status=0 OR status=2) ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;				
		}
		function GET_TRANSFER_RECORD($pid)
		{
			//if($_SESSION['user']=="admin")
			$sql = "SELECT * FROM wp_sm_epins WHERE owner_id='$pid' ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;				
		}
		
		function COUNT_TOTAL_EPINS($pid)
		{
			$sql = "SELECT COUNT(*) FROM wp_sm_epins WHERE owner_id='$pid' AND (status=0 OR status=2)";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		function COUNT_TOTAL_EPINS2($pid)
		{
			$sql = "SELECT COUNT(*) FROM wp_sm_epins WHERE owner_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		
		/*function transfer_epins($owner,$to,$num)
		{
			$d1 = date("Y-m-d");
			$sql = "SELECT * from wp_sm_epins WHERE owner_id='$owner' AND (status=0 OR status=2)";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			$c=0;
			while($arr = mysqli_fetch_array($res))
			{
				$id = $arr['id'];
				$unique = $arr['unique_id'];		
							
				$sql3 = "UPDATE wp_sm_epins SET status='1' WHERE id='$id'";
				$n = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
			
				$sql2 = "INSERT INTO wp_sm_epins (unique_id,owner_id,status,date1) VALUES ('$unique','$to','2','$d1')";
					$n2 = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
				$c++;
				if($c >= $num)
					break;
			}
			return true;
			
			return false;
		}*/

function transfer_epins($owner,$to,$num)
		{
			$d1 = date("Y-m-d");
			$sql = "SELECT * from wp_sm_epins WHERE owner_id='$owner' AND (status=0 OR status=2)";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			$c=0;
			$n = mysqli_num_rows($res);
			if($n<$num)
				return false;
			while($arr = mysqli_fetch_array($res))
			{
				$res2=mysqli_query($this->con,"SELECT ph_no from tbl_users where profile_id='$to'");
				$arr2 = mysqli_fetch_array($res2);
				
				
				
				
				
				
				
				$id = $arr['id'];
				$unique = $arr['unique_id'];		
							
				$sql3 = "UPDATE wp_sm_epins SET status='1' WHERE id='$id'";
				$n = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
			
				$sql2 = "INSERT INTO wp_sm_epins (unique_id,owner_id,status,date1) VALUES ('$unique','$to','2','$d1')";
					$n2 = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
			
			
				
				$msg9 = "Your E-pins number is ".$unique." http://www.newsupermart.com/login.php";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.msg91.com/api/v2/sendsms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"sender\": \"NSMART\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"".$msg9."\", \"to\": [ ".$arr2['ph_no']." ] } ] }",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTPHEADER => array(
    "authkey: 195331AElt4D91B5a6c2bb9",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
				
			
			
			
			
			
			
			
			
			
			
			
			
				$c++;
				if($c >= $num)
					break;
			}
			return true;
			/*if($n)
			{
				for($i=1;$i<=$num;$i++)
				{
					$sql2 = "INSERT INTO wp_sm_epins (owner_id,status,date1) VALUES ('$to','2','$d1')";
					$n2 = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
				}
				return true;						
			}*/
		
		}
		
		function active_acct($pid,$eno)
		{
			$sql = "SELECT owner_id from wp_sm_epins where unique_id='$eno' AND status=2";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			if($arr[0] == $pid)
			{
                                $_SESSION['status']=1;
				$sql2 = "UPDATE wp_sm_epins SET status='3' WHERE unique_id='$eno'";
				$n = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
				
				$sql3 = "UPDATE tbl_tree SET child_status='1' WHERE child_id='$pid'";
				$n = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
				return true;
			}
			
			return false;
		}
		
		function GET_INACTIVE_ACCOUNT($pid)
		{
			$sql = "SELECT A1.*, A2.child_status FROM tbl_tree AS A2 LEFT JOIN tbl_users AS A1 ON A1.profile_id = A2.child_id AND A2.child_status=0 ORDER BY id DESC";
			
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;
		}
		function COUNT_INACTIVE_ACCOUNT($pid)
		{
			$sql = "SELECT A1.*, A2.child_status FROM tbl_tree AS A2 LEFT JOIN tbl_users AS A1 ON A1.profile_id = A2.child_id AND A2.child_status=0 ORDER BY id DESC";
			
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_num_rows($res);
			return $c;
		}
		function BUSINESS_CHART()
		{
			$sql = "SELECT * FROM wp_supermart_income_chart ORDER BY id ASC";
			
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;
		}
		
		
		function COUNT_TOTAL_ACTIVE_TEAM($pid)
		{
			$sql = "SELECT COUNT(*) FROM tbl_tree WHERE id>(SELECT id FROM tbl_tree WHERE child_id='$pid') AND child_status=1";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		
		function COUNT_DIRECT_ACTIVE_TEAM($pid)
		{
			$sql = "SELECT COUNT(*) FROM tbl_tree WHERE parent_id='$pid' AND child_status=1 ORDER BY id DESC";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$c = mysqli_fetch_row($res);
			return $c[0];
		}
		
		function GET_ONE_LEVEL2($pid){
			$query=mysqli_query($this->con,"SELECT * FROM tbl_tree WHERE parent_id='$pid' AND child_status='1'") or die(mysqli_error($this->con));
			$p_id=array();
			
			if(mysqli_num_rows($query)>0){
				while($result=mysqli_fetch_assoc($query)){
					$p_id[]=$result['child_id'];
				}
			  
			}
			return $p_id;
		}

		function COUNT_SELF_ACTIVE_TEAM($parent_id,$c, &$tree_st=array()) {
			$tree = array();
			
			// getOneLevel() returns a one-dimensional array of child ids        
			$tree = $this->GET_ONE_LEVEL2($parent_id);     
			if(count($tree)>0 && is_array($tree)){  
				if($c++!=0)    
				{
				$tree_st=array_merge($tree_st,$tree);
				}
			}
			foreach ($tree as $key => $val) {
				$this->COUNT_SELF_ACTIVE_TEAM($val,$c, $tree_st);
			}   
			return $tree_st;
		}
		
		function LAST_GIFT($pid)
		{
			$sql = "SELECT * FROM wp_sm_gift WHERE profile_id='$pid' ORDER BY id DESC LIMIT 0,1";	
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_array($res);
			return $arr;
		}
		
		function GET_INCOME_CHART_BY_LEVEL($level)
		{
			$l = $level+1;
			$sql = "SELECT * FROM wp_supermart_income_chart WHERE id='$l'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_array($res);
			return $arr;	
		}
		
		function WORKING_PAYOUT($pid)
		{
			$sql = "SELECT * FROM wp_sm_payout WHERE profile_id='$pid' ORDER BY id desc";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			return $res;	
		}
		
		function GET_SALARY_BY_PID($pid)
		{
			$sql = "SELECT * FROM wp_sm_salary WHERE profile_id='$pid' ORDER BY id desc";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;	
			
		}
		
		function WORKING_PAYOUT_ALL()
		{
			$sql = "SELECT * FROM wp_sm_payout WHERE status=1 ORDER BY id desc";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			return $res;	
		}
		
		function GET_SALARY_ALL()
		{
			$sql = "SELECT * FROM wp_sm_salary WHERE status=1 ORDER BY id desc";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			return $res;	
		}
		
		function GET_PENDING_SALARY()
		{
			
			$sql = "SELECT * FROM wp_sm_salary WHERE status=0 ORDER BY id";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	
			return $res;	
		}
		
		function GET_PENDING_PAYOUT()
		{
			$d = date("Y-m-d");
			$sql = "SELECT * FROM wp_sm_payout WHERE status=0 AND date1<='$d' ORDER BY id";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	
			return $res;
		}
		function ADMIN_MAKE_PAYMENT($id,$pid,$lid)
		{
			$sql = "SELECT working_payout from wp_supermart_income_chart WHERE id='$lid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	
			$arr = mysqli_fetch_row($res);
			if($arr[0]>50000)
			{
				$r = $arr[0] - 50000;
				$d1 = date('Y-m-d', strtotime("+10 days"));
				$sql = "INSERT INTO wp_sm_payout (profile_id,level_id,given_payout,date1) VALUES ('$pid','$lid','$r','$d1')";	
				$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	

			}
			
			$sql = "UPDATE wp_sm_payout SET status='1' WHERE id='$id' AND profile_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	
		}
	
		function ADMIN_MAKE_SALARY($id,$pid,$slvl,$stime,$lid,$date1)
		{
			$effectiveDate = date('Y-m-d', strtotime("+".($slvl+1)." months", strtotime($date1)));
			//echo $effectiveDate;
			$slvl1 = $slvl+1;

			$sql = "UPDATE wp_sm_salary SET status='1' WHERE id='$id' AND profile_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));	
			
			$sql2 = "INSERT INTO wp_sm_salary (profile_id,level_id,salary_level,salary_time,date1) VALUES('$pid','$lid','$slvl1','$stime','$d1')";
		$res = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));	
			
		}
		
		function GET_SALARY_BY_LEVEL($level)
		{
			$sql = "SELECT salary FROM wp_supermart_income_chart WHERE id='$level'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_array($res);	
			return $arr['salary'];	
				
		}
		
		function INCOME_CHART_BY_LEVEL($current_level)
		{
			$sql = "SELECT SUM(total_team) AS total_team,SUM(self_team) AS self_team,SUM(referral) AS referral FROM wp_supermart_income_chart WHERE id<='$current_level'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_array($res);
			return $arr;	
			
		}
		
		function ADD_GIFT($new_level,$pid)
		{
$d1=date("Y-m-d");
			$sql = "SELECT gift FROM wp_supermart_income_chart WHERE id='$new_level'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);	
			
			$sql1 = "INSERT INTO wp_sm_gift (profile_id,date1,level_id,gift) VALUES ('$pid','$d1','$new_level','$arr[0]')";
			$res = mysqli_query($this->con,$sql1) or die(mysqli_error($this->con));	
		}
	
		function ADD_PAYOUT($new_level,$pid)
		{
$d1=date("Y-m-d");
			$sql = "SELECT 	working_payout FROM wp_supermart_income_chart WHERE id='$new_level'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);	
			
			$sql2 = "INSERT INTO wp_sm_payout (profile_id,date1,level_id,given_payout) VALUES ('$pid','$d1','$new_level','$arr[0]')";
			mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));	
		}
		
		function ADD_SALARY($new_level,$pid)
		{
$d1=date("Y-m-d");
			$sql = "SELECT salary_duration FROM wp_supermart_income_chart WHERE id='$new_level'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);	
			
			$sql2 = "INSERT INTO wp_sm_salary (profile_id,date1,level_id,salary_time) VALUES ('$pid','$d1','$new_level','$arr[0]')";
			$res = mysqli_query($this->con,$sql2) or die(mysqli_error($this->con));
		}
	
		
		
		
		function ADD_TEAM($pid)
		{
			$this->GET_SELF_TEAM($pid,0);
				
		}
		
		
		function DELETE_USER($pid)
		{
			$sql1 = "DELETE FROM tbl_users WHERE profile_id = '$pid'";
			$sql2 = "DELETE FROM tbl_tree WHERE child_id = '$pid'";
			$sql3 = "DELETE FROM wp_sm_gift WHERE profile_id = '$pid'";
			$sql4 = "DELETE FROM wp_sm_payout WHERE profile_id = '$pid'";
			$sql5 = "DELETE FROM wp_sm_salary WHERE profile_id = '$pid'";
			
			$n = mysqli_query($this->con,$sql2);		
			$n2 = mysqli_query($this->con,$sql1);
			if($n && $n2)
			{
				mysqli_query($this->con,$sql5);		
				mysqli_query($this->con,$sql4);		
				mysqli_query($this->con,$sql3);		
				
				return true;	
			}
			else
				return false;

		}
		
		
    }

		
		
//=========================================================================

	
	
//}//End of Class
		?>