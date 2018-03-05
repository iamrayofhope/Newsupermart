<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();
		
		
		$total_team = $obj->COUNT_TOTAL_ACTIVE_TEAM($pid);
		$direct_team = $obj->COUNT_DIRECT_ACTIVE_TEAM($pid);
		
		
		//$self_team1 = $obj->COUNT_SELF_ACTIVE_TEAM($pid,0);
		//$self_team = $self_team1;
	$self_team = count($obj->COUNT_SELF_ACTIVE_TEAM($pid,0));
		
		$status = $obj->CHECK_STATUS($pid);
		
		$last_gift_arr = $obj->LAST_GIFT($pid);
		$next_target_arr = $obj->GET_INCOME_CHART_BY_LEVEL($last_gift_arr['level_id']);
		$current_arr = $obj->GET_INCOME_CHART_BY_LEVEL($last_gift_arr['level_id']-1);
		
		$payout_res = $obj->WORKING_PAYOUT($pid);	
	
		$salary_res = $obj->GET_SALARY_BY_PID($pid);



		$team_by_income_chart = $obj->INCOME_CHART_BY_LEVEL($last_gift_arr['level_id']);
		
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
                      <strong>Status is not Activated</strong>&nbsp;&nbsp;&nbsp;<a href="activate_acct.php" class="btn btn-warning">Active Now</a>
                    </div>
				<?php
					}
					else if($status==1){
						
				?>
                <div class="alert alert-success">
                      <strong>Status is Activated</strong>
                    </div>
                <?php
					}
				?>

<div class="chit-chat-layer1">
	<div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <h4>
                                  <u>Current Status</u> (Level <?php echo $last_gift_arr['level_id'];?>)
                            </h4><br>
                           <b>Universal Team : </b><em><?php echo ($total_team - $team_by_income_chart['total_team']);?></em><br>
                           <b>Self Team : </b><em><?php echo ($self_team - $team_by_income_chart['self_team']);?></em><br>
                           <b>Direct Team : </b><em><?php echo ($direct_team - $team_by_income_chart['referral']);?></em><br>
                           
                           <b>Gift : </b><em><?php echo $last_gift_arr['gift'];?></em><br>
                           <b>Working Payout : </b><em><?php echo $current_arr['working_payout'];?></em><br>

                           <b>Salary : </b><em><?php echo $current_arr['salary']."(".$current_arr['salary_duration']." months)";?></em><br>
                           

                           
                       
                       </div>
                       
                         </div>
                              
         </div>
         
         <div class="col-md-6 chit-chat-layer1-rit">    	
      	  
					<section id="charts1" class="charts">
				
					<div class="work-progres">
                            <h4>
                                  <u>Next Target</u> (Level <?php echo $last_gift_arr['level_id']+1;?>)
                            </h4><br>
                           <b>Universal Team : </b><em><?php echo $next_target_arr['total_team'];?></em><br>
                           <b>Self Team : </b><em><?php echo $next_target_arr['self_team'];?></em><br>
                           <b>Direct Team : </b><em><?php echo $next_target_arr['referral'];?></em><br>
                           
                           <b>Gift : </b><em><?php echo $next_target_arr['gift'];?></em><br>
                           <b>Working Payout : </b><em><?php echo $next_target_arr['working_payout'];?></em><br>

                           <b>Salary : </b><em><?php echo $next_target_arr['salary']."(".$next_target_arr['salary_duration']." months)";?></em><br>
                       </div>
				   
				
				
				</section>				
			
      </div>
                              <div class="clearfix"> </div>

</div>

<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1">
	<div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                  Working Payout
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Amount</th>
                                      <th>Due</th>
                                      <th>Date</th>                                   
                                                                        
                                     
                                      <th>Status</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                           
                              <?php
							  $res = $obj->GET_DIRECT_TEAM($pid);
							  $c=1;
							  while($payout_arr = mysqli_fetch_array($payout_res))
							  {
								 
									//$user = $obj->USER_DETAILS($arr['2']);
								
								
							  		//$children = $obj->get_Child($pid);
									//print_r($children);
									if($payout_arr['level_id']!=0)
									{
							  ?>
                               <tr>
                                  <td><?php echo $c++;?></td>
                                  <td><?php echo $payout_arr['given_payout'];?></td>
                                  <td><?php echo $payout_arr['due_payout'];?></td>   
                                  
                                  
                                  <td><?php echo $payout_arr['date1'] ?></td> 
                                  <td><?php echo ($payout_arr['status']==1)?"<span class=\"label label-success\">Received</span>":"<span class=\"label label-danger\">Pending</span>";?></td>                                 
                                                             
                                 
                              </tr>
                              
                              <?php
									}
							  }
							  
							  ?>
                              
                              
                            <tr>
                            	<td></td>
                            </tr>  
      
                            
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
      <div class="col-md-6 chit-chat-layer1-rit">    	
      	  <div class="work-progres">
                            <div class="chit-chat-heading">
                                  Salary
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Level</th>
                                      <th>Salary</th>                                   
                                                                        
                                      
                                      <th>Date</th>
                                      <th>Status</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                           
                              <?php
							  $res = $obj->GET_DIRECT_TEAM($pid);
							  $c=1;
							  while($salary_arr = mysqli_fetch_array($salary_res))
							  {
								 	if($salary_arr['level_id']!=0)
									{
								 	$income = $obj->GET_INCOME_CHART_BY_LEVEL($salary_arr['level_id']);
							  		//$children = $obj->get_Child($pid);
									//print_r($children);
                                                                        if($income['salary']==0)
                                                                        continue;
							  ?>
                               <tr>
                                  <td><?php echo $c++;?></td>
                                  <td><?php echo $salary_arr['level_id'];?></td>
                                  <td><?php echo $income['salary'];?></td>   
                                  
                            
                                  <td><?php echo $salary_arr['date1'] ?></td> 
                                  <td><?php echo ($salary_arr['status']==1)?"<span class=\"label label-success\">Received</span>":"<span class=\"label label-danger\">Pending</span>";?></td>                                 
                                                             
                                 
                              </tr>
                              
                              <?php
									}
							  }
							  ?>
                              
                              

                            
                          </tbody>
                      </table>
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