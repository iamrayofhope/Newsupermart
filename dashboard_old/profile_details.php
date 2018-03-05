<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();
		$arr = $obj->USER_DETAILS($pid);
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
    	<h2>Profile Details</h2>
    	
        <div class="row">
        <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="update_profile.php">
    	<div class="col-md-3">
        <img src="images/dummy.jpg" width="200" height="200"/>
           <br> <br>
                <input type="file" class="form-control" id="img" placeholder="" name="img">
             
        </div>
    	<div class="col-md-9">
        	
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" disabled id="name" placeholder="" value="<?php echo $arr['name'];?>" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pid">Profile Id:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" value="<?php echo $arr['profile_id'];?>" disabled id="pid" placeholder="" name="pid">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email Id:</label>
      <div class="col-sm-10">          
        <input type="email" class="form-control" value="<?php echo $arr['email'];?>" id="email" placeholder="" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="phno">Mobile No:</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" value="<?php echo $arr['ph_no'];?>" id="phno" placeholder="" name="phno">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="nominee">Nominee Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" value="<?php echo $arr['nominee_name'];?>" id="nominee" placeholder="" name="nominee">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="n_relation">Nominee Relation:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="n_relation" value="<?php echo $arr['nominee_relation'];?>" placeholder="" name="n_relation">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="fname">Father's Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="fname" value="<?php echo $arr['father_name'];?>"  placeholder="" name="fname">
      </div>
    </div>
    
    <div class="form-group">
    	<label class="control-label col-sm-2" for="gender">Gender</label>
        <div class="col-sm-10">
        <label class="radio-inline">
      <input type="radio" name="gender"  value="male" <?php echo ($arr['gender']=='male')?"checked='checked'":"";?> >Male
    </label>
    <label class="radio-inline">
      <input type="radio" value="female" <?php echo ($arr['gender']=='female')?"checked='checked'":"";?> name="gender">Female
    </label>
    
        </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="state">State:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" value="<?php echo $arr['state'];?>" id="state" placeholder="" name="state">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="city">City:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="city" value="<?php echo $arr['city'];?>"  placeholder="" name="city">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pin">Pin:</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" id="pin" value="<?php echo $arr['pin'];?>" placeholder="" name="pin">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="country">Country:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="country" value="<?php echo $arr['country'];?>" placeholder="" name="country">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2"for="addr">Address:</label>
      <div class="col-sm-10">  
      	<textarea name="addr"  class="form-control" id="addr"> <?php echo $arr['address'];?> </textarea>        
     
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
    </div>
 
        
        </div>
        
         </form>
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


                      
						
