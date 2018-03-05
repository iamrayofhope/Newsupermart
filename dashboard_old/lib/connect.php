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





		/*function get_Child($pid)
		{
			$sql = "select  id,child_id,parent_id from (select * from tbl_tree order by parent_id, id) tbl_tree,(select @pv := '1') initialisation where find_in_set(parent_id, @pv) > 0 and @pv := concat(@pv, ',', id)";	
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			return $res;
		}*/
		
		
		function COUNT_SELF_TEAM($pid)
		{
			$sql = "SELECT * FROM tbl_tree AS T1 INNER JOIN (SELECT child_id FROM tbl_tree WHERE parent_id = '$pid') AS T2 ON T2.child_id = T1.parent_id AND T1.parent_id != '$pid' GROUP BY T1.child_id";
			$res = mysqli_query($this->con,$sql);
			$c = mysqli_num_rows($res);
			return $c;
		}
		
		/*
		
		function printList($array = null) {
        if (count($array)) {
            echo "<ul>";

            foreach ($array as $item) {
                echo "<li>";
                print_r($item['child_id']);
                if (count($item['child_id'])) {
                    $this->printList($item['child_id']);
                }
                echo "</li>";
            }

            echo "</ul>";
        }*/
		
		
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
			$sel_query  = "SELECT id  FROM  tbl_users WHERE id =%d"; // query to select value 
			$ins_query = "INSERT INTO tbl_users(id) VALUES(%d)";    // query to insert value
			$result =  mysqli_query($this->con,sprintf($sel_query,$num));
			while( mysqli_num_rows($result) != 0 ) {                      // loops till an unique value is found 
				$num = mt_rand(100000,9999999);
				$result = mysqli_query($this->con,sprintf($sel_query,$num));
			}

			
			$sql="INSERT INTO tbl_users(profile_id,name,email,pwd,ph_no,created_date) VALUES ('$num','$name','$email','$pwd','$phno','$date')";
			$n = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			$sql="INSERT INTO tbl_tree(parent_id,child_id) VALUES ('$sid','$num')";
			$n2 = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			
			
			mysqli_close($this->con);
		

			if($n && $n2)
			{
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

			if($n && $n2)
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
			$sql = "SELECT status FROM tbl_users WHERE profile_id='$pid'";
			$res = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
			$arr = mysqli_fetch_row($res);
			return $arr[0];
			
		}
		
		function UPDATE_DETAILS($pid,$email,$ph_no,$nominee_name,$nominee_relation,$father_name,$gender,$state,$city,$pin,$country,$address)
		{
			$sql = "UPDATE tbl_users SET email='$email',ph_no='$ph_no',nominee_name='$nominee_name',nominee_relation='$nominee_relation',father_name='$father_name',gender='$gender',state='$state',city='$city',pin='$pin',country='$country',address='$address' WHERE profile_id='$pid'";
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

		
    }

		
		
//=========================================================================

	
	
//}//End of Class
		?>