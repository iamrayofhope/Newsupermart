<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();
		
		$total_team = $obj->COUNT_TOTAL_TEAM($pid);
		$direct_team = $obj->COUNT_DIRECT_TEAM($pid);
		$total_team_res = $obj->GET_TOTAL_TEAM($pid);
		$self_team = $obj->COUNT_SELF_TEAM($pid,0);
		$status = $obj->CHECK_STATUS($pid);

$arr_self = $obj->GET_SELF_TEAM($pid,0);
		$cou = count($arr_self);
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
   
<!--geo chart-->

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>	

<?php include_once('header_top.php');?>

		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

				<?php
					if($status!=1)
					{
				?>
 				<div class="alert alert-danger">
                      <strong>Status is not Activated</strong>&nbsp;&nbsp;&nbsp;<a href="activate_acct.php" class="btn btn-primary">Active Now</a>
                    </div>
				<?php
					}
				?>

<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $total_team; ?></h3>
						<h4>Universal Team</h4>
						<p>-</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				 <div class="col-md-8 market-update-left">
					<h3><?php echo $cou; ?></h3>
					<h4>Self Team</h4>
					<p>-</p>
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $direct_team; ?></h3>
						<h4>Direct Team</h4>
						<p>-</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1">
	<div class="col-md-9 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                  Direct Team
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      
                                      <th>Sponsor's id</th>                                   
                                                                        
                                      <th>Profile id</th>
                                      <th>Date</th>
                                      <th>Status</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
							 /* $c = 1;
							  		while($arr = mysqli_fetch_array($total_team_res))
									{
										$parent_id = $obj->GET_PARENT_ID($arr['profile_id']);
										if($arr['profile_id'] == $pid)
											continue;
										if($c >= 6)
											break;
							  ?>
                                <tr>
                                  <td><?php echo $c++;?></td>
                                  <td><?php echo $arr['profile_id'];?></td>
                                  
                                   <td><?php echo $parent_id;?></td>
                                  <td><?php echo $arr['created_date'];?></td>   
                                  <td><?php echo ($arr['status']==1)?"<span class=\"label label-success\">Active</span>":"<span class=\"label label-danger\">Inactive</span>";?></td>                                 
                                                             
                                 
                              </tr>
                              <?php
									}*/
							  ?>
                              
                              
                              <?php
							  $res = $obj->GET_DIRECT_TEAM($pid);
							  $c=1;
							  while($arr = mysqli_fetch_array($res))
							  {
								 
									$user = $obj->USER_DETAILS($arr['2']);
								
								
							  		//$children = $obj->get_Child($pid);
									//print_r($children);
							  ?>
                               <tr>
                                  <td><?php echo $c++;?></td>
                                  
                                  <td><?php echo $arr['parent_id'];?></td>   
                                  
                                  <td><?php echo $arr['child_id'];?></td>  
                                  <td><?php echo $user['created_date'] ?></td> 
                                  <td><?php echo ($arr['child_status']==1)?"<span class=\"label label-success\">Active</span>":"<span class=\"label label-danger\">Inactive</span>";?></td>                                 
                                                             
                                 
                              </tr>
                              
                              <?php
							  }
							  ?>
                              
                              
                            <tr>
                            	<td></td>
                            </tr>  
                            <tr>
                            	<td colspan="6"><a href="direct_team.php" class="btn btn-primary btn-group-lg">See More</a></td>
                            </tr>  
                            
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
      <div class="col-md-3 chit-chat-layer1-rit">    	
      	  <div class="geo-chart">
					<section id="charts1" class="charts">
				<div class="wrapper-flex">
				
				   
				
				</div><!-- .wrapper-flex -->
				</section>				
			</div>
      </div>
     <div class="clearfix"> </div>
</div>
<!--main page chit chating end here-->
<!--main page chart start here-->

<!--main page chart layer2-->


<!--climate start here-->

<!--climate end here-->
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>All Rights Reserved &copy Newsupermart</p>
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