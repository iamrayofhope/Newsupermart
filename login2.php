<?php
		session_start();
		if(isset($_SESSION['pid']))
		{
			$pid = $_SESSION['pid'];
			header("Location:dashboard2/index.php");
		}
?><!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NewSuperMart</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="dashboard1/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dashboard1/assets/font-awesome/css/font-awesome.min.css">
		
        
        <link rel="stylesheet" href="dashboard1/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


		
    </head>

    <body background="assets/img/backgrounds/1.jpg">

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                   <!-- <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Member Area</strong></h1>
                            
                        </div>
                    </div>
                    -->
                    <div class="alert alert-info">
                      <h2>Welcome to <strong>New Super Mart</strong></h2> 
                    </div>
                    
  					<?php
						
                         $msg = (isset($_GET['n']))?($_GET['n'])?$_GET['n']:"":"";
						 if($msg == md5("yUp"))
						 {
						 ?>            
                     <div class="alert alert-success">
  					<strong>Successfully Done!</strong>
					</div>
                    	<?php
						 }
						 else if($msg == md5("noPe")){
						?>
                    <div class="alert alert-danger">
                      <strong>There was some problem, Please try again.</strong>
                    </div>
                          <?php
						 }
						 else if($msg == md5("eMailoRsPonsoriD")){
						  ?>              
                    <div class="alert alert-danger">
                      <strong>Sponsor'id or Email was wrong!</strong>
                    </div>
                          
                          <?php
						 }
						  ?>
                    <div class="row">
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                            		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="check2.php" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="pid">Profile Id</label>
				                        	<input type="text" name="pid" placeholder="Profile Id" class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="pwd">Password</label>
				                        	<input type="password" name="pwd" placeholder="Password" class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit"  name="login" class="btn btn-primary">Login</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="check2.php" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="sid">Sponsor Id</label>
				                        	<input type="text" required name="sid" onBlur="validate()" placeholder="Sponsor Id" class="form-first-name form-control" id="sid">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="sponcername">Sponsor name</label>
				                        	<input type="text" disabled name="sname" placeholder="Sponcer name" class="form-last-name form-control" value="" id="sname">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="uname">Full Name</label>
				                        	<input type="text" required  name="uname" placeholder="Full Name" class="form-email form-control" id="uname">
				                        </div> 
                                        <div class="form-group">
				                        	<label class="sr-only" for="phno">Mobile No.</label>
				                        	<input type="number" required  name="phno" placeholder="Mobile No." class="form-email form-control" id="phno">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="email">Email</label>
				                        	<input type="email" required onBlur="validate2()" name="email" placeholder="Email" class="form-email form-control" id="email">
                                            <span style="color:red" id="email2"></span>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="pwd">Password</label>
				                        	<input type="password" required  name="pwd" placeholder="Password" class="form-email form-control" id="pwd">
				                        </div>
				                      
                                      
            	                        <button type="submit" id="signup" name="register" class="btn btn-success">Register</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>Copyright | <a href="#" target="_blank"><strong>ui</strong></a> 
        					</p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="dashboard1/assets/js/jquery-1.11.1.min.js"></script>
        <script src="dashboard1/assets/bootstrap/js/bootstrap.min.js"></script>
        
        
		<script>
        function validate() {
			var sid = document.getElementById("sid").value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("sname").value = this.responseText;
            }
          };
          xhttp.open("GET", "dashboard1/validate_login.php?sid="+sid, true);
          xhttp.send();
        }
	
		/*function validate2() {
			var email = document.getElementById("email").value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
				if(this.responseText == "1")
              	{
					document.getElementById("email2").innerHTML = "*Email already exists.";

					document.getElementById("signup").disabled = true;
				}
				else
					document.getElementById("signup").disabled = false;
				
			}
          };
          xhttp.open("GET", "validate_login.php?email="+email, true);
          xhttp.send();
        }*/
        </script>

        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>