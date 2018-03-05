<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
								<a href="index.php"> <h1>NewSuperMart</h1> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								</a>
								<br>
								<a href="http://www.newsupermart.com"><h5>Go back to homepage<h5></a> 								
							</div>
							
                            
						 </div>
						 <div class="header-right">
							
                            
							<!--notification menu end -->
							<div class="profile_details">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img height="50px" width="50px" src="images/<?php echo $_SESSION['img'];?>" alt=""> </span> 
												<div class="user-name">
													<p><?php echo $pid;?></p>
													<span><?php echo $_SESSION['uname'];?></span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<!--<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> -->
											<li> <a href="profile_details.php"><i class="fa fa-user"></i> Profile</a> </li> 
                                            <li> <a href="change_password.php"><i class="fa fa-user"></i>Change Password</a> </li> 
											<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>