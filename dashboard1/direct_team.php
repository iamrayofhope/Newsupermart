<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();
		$res = $obj->GET_DIRECT_TEAM($pid);
		$co = $obj->COUNT_DIRECT_TEAM($pid);
		//$arr = mysqli_fetch_array($res);
		
		//$arr = $obj->USER_DETAILS($pid);
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
    	<h2>Direct Team</h2><span>( <b><?php echo $co." Records Found !"?></b> )</span>
    	
        <div class="blankpage-main">
      
      
       <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Profile Id</th>
        <th>Sponsor's Id</th>
       	<th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    		<?php
			
			$c =1; 
				while($arr = mysqli_fetch_array($res))
				{
					$user = $obj->USER_DETAILS($arr['child_id']);				
			?>	
    
      <tr>
        <td><?php echo $c++;?></td>
        <td><?php echo $user['name']?></td>
        <td><?php echo $arr['child_id']?></td>
        <td><?php echo $arr['parent_id']?></td>
        <td><?php echo $user['created_date']?></td>
        <td><?php echo ($arr['child_status']==1)?"<span class=\"label label-success\">Active</span>":"<span class=\"label label-danger\">Inactive</span>";?></td>

      </tr>
    		<?php
				}
			?>  
      
      </tbody>
      </table>
      
      
      
      
      
      
   		</div>
    
    </div>
</div>
 
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>All Rights Reserved </p>
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


                      
						
