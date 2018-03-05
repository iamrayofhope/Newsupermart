<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();	
?>

<?php
		if(isset($_POST['submit']))
		{
			$pwd = $_POST['pwd'];
			$cpwd = $_POST['cpwd'];
			$rpwd = $_POST['rpwd'];
			if($pwd == $rpwd)
			{
				$n = $obj->UPDATE_PASSWORD($pid,$cpwd,$pwd);
				if($n)
					header("Location:change_password.php?n=".md5("changed"));
				else
					header("Location:change_password.php?n=".md5("didn't_match"));
			}
			else
				header("Location:change_password.php?n=".md5("not_match"));
		}

?>


<!DOCTYPE HTML>
<html>
<head>
<title>New SuperMart</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->


<!--static chart-->
<script src="js/Chart.min.js"></script>
<!--//charts-->
<!-- geo chart -->
    <script src="js/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
     <!-- Chartinator  -->
    <script src="js/chartinator.js" ></script>
<!--//skycons-icons-->
</head>
<body>	

<?php include_once('header_top.php');?>

<div class="inner-block">
    <div class="blank">
    	<h2>Change Password</h2>
    	
        <?php
				if(isset($_GET['n']))
				{
					$n = $_GET['n'];
					if($n == md5("not_match"))
						echo '<div class="alert alert-danger"><strong>New Password and Retype password didn\'t match</strong></div>';
					else if($n == md5("didn't_match"))
						echo '<div class="alert alert-danger"><strong>Current Password didn\'t match</strong></div>';
					else if($n == md5("changed"))
						echo '<div class="alert alert-success"><strong>Password Successfully changed</strong></div>';
				}
		?>
        	
        
        <div class="blankpage-main">
      
      		<div class="row">
        
                <div class="col-md-6">
              
               <form action="#" method="post">
                  <div class="form-group">
                    <label for="cpwd">Current Password</label>
                    <input type="password" class="form-control" id="cpwd" placeholder="" name="cpwd">
                   
                   
                  </div>
                  <div class="form-group">
                    <label for="pwd">New Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="" name="pwd">
                   
                   
                  </div>
                  <div class="form-group">
                    <label for="rpwd">Retype Password</label>
                    <input type="password" class="form-control" id="rpwd" placeholder="" name="rpwd">
                  </div>
                  
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>

                     
        		</div>
	        </div>

      
   		</div>
    
    </div>
</div>
 
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>All Rights Reserved</p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
   <?php include_once("slider_menu.php");?>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
