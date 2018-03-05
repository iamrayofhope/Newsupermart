<?php
		session_start();
		$pid = (isset($_SESSION['pid']))?$_SESSION['pid']:header("Location:../login.php");
		include('lib/connect.php');
		$obj=new connect();
		
		
		if($_SESSION['user']!="admin")
			header("Location:index.php");
		
		
		$res = $obj->GET_PENDING_PAYOUT();
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
    	<h2>Payout</h2>
    	
        <div class="blankpage-main">
      
      
       <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Profile id</th>
        <th>Level</th>
        
       <th>Pay</th>
       <th>Due</th>
       <th>Date</th>
     	<th>Action</th>
      </tr>
    </thead>
    <tbody>
    		<?php
			
			$c =1; 
				while($arr = mysqli_fetch_array($res))
				{
				    if($arr['level_id']==0)
                                    continue;	
			?>	
    
      <tr>
        <td><?php echo $c;?></td>
        <td><?php echo $arr['profile_id']?></td>
        <td><?php echo $arr['level_id']?></td>
        <td><?php echo $arr['given_payout']?></td>
        <td><?php echo $arr['due_payout']?></td>
        <td><?php echo $arr['date1']?></td>
    	<td id="i<?php echo $arr['id']?>"><button class="btn btn-primary" onClick="validate(<?php echo $arr['id'].",".$arr['profile_id'].",".$arr['level_id']?>)">Make Payment</button></td>
    
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
<script>

        function validate(pid,pid2,lid) {
			//var td_id = document.getElementById("i"+pid).innerHTML
			//var cid = cid.id;
			//alert(cid);
			//document.getElementById("btn-payment").innerHTML = "<img src='loading.gif' height='48px' width='48px' />";
			document.getElementById("i"+pid).innerHTML = "<img src='loading.gif' height='48px' width='48px' />";
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("i"+pid).innerHTML = "Paid";
            }
          };
          xhttp.open("GET", "admin_make_payment_ajax.php?id="+pid+"&pid="+pid2+"lid="+lid, true);
          xhttp.send();
        }
</script>
<!-- mother grid end here-->
</body>
</html>