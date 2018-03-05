<div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="index.php"><i class="glyphicon glyphicon-home" style="color:#E5E5E5"></i><span>Dashboard</span></a></li>
		        <li><a href="#"><i class="glyphicon glyphicon-file"  style="color:#E5E5E5"></i><span>Documents</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="#">Print Receipts</a></li>
		            <li><a href="#">Downloads Files</a></li>		            
		          </ul>
		        </li>
                <li><a href="#"><i class="glyphicon glyphicon-user"  style="color:#E5E5E5"></i><span>My Team</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="all_team.php">Universal Team</a></li>
		            <li><a href="self_team.php">Self Team</a></li>
		            <li><a href="direct_team.php">Direct Team</a></li>		            
		          </ul>
		        </li>
		        <li id="menu-comunicacao" ><a href="#"><i class="glyphicon glyphicon-random"  style="color:#E5E5E5"></i><span>E-pins</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <?php
				  	//	if($_SESSION['status']==1)
				  	//	{
				  ?>
                  <ul id="menu-comunicacao-sub" >
		            <li id="menu-mensagens" ><a href="aval_epins.php">Available E-pins</a>		              
		            </li>
                    <?php
							if($_SESSION['user']=="admin")
							{
					?>
		            <li id="menu-arquivos" ><a href="inactive_acct.php">Inactive Accounts</a></li>
                    
		            <li id="menu-arquivos" ><a href="generate_epins.php">Generate E-pins</a></li>
                    
		            <?php
							}
					?>
                    <li id="menu-arquivos" ><a href="transfer_epin.php">Transfer E-pins</a></li>
		            <li id="menu-arquivos" ><a href="transfer_epin_history.php">Transfer E-pins History</a></li>
		          </ul>
                  <?php
					//	}
				  ?>
		        </li>
                
                  <?php
							if($_SESSION['user']=="admin")
							{
					?>
		          <li><a href="delete_users.php"><i class="glyphicon glyphicon-trash"  style="color:#E5E5E5"></i><span>Delete User</span></a></li>  
                  <?php
							}
				  ?>
                  <li><a href="#"><i class="glyphicon glyphicon-credit-card"  style="color:#E5E5E5"></i><span>Topup</span></a></li>
		        <li id="menu-academico" ><a href="#"><i class="glyphicon glyphicon-usd"  style="color:#E5E5E5"></i><span>Income</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-academico-sub" >
		          <?php
							if($_SESSION['user']=="admin")
							{
					?>
		            <li id="menu-arquivos" ><a href="admin_payout.php">Payout</a></li>
                    
		            <li id="menu-arquivos" ><a href="admin_salary.php">Salary</a></li>
                    
                    <li id="menu-arquivos" ><a href="admin_payout_history.php">Payout History</a></li>
                    
		            <li id="menu-arquivos" ><a href="admin_salary_history.php">Salary History</a></li>
                    
		            <?php
							}
							else{
					?>
		          	 <li id="menu-academico-boletim" ><a href="payout.php">Payout</a></li>
		          	 <?php
							}
		          	 ?>
		          	 <li id="menu-academico-boletim" ><a href="business_chart.php">Business Chart</a></li>
		            <!--<li id="menu-academico-avaliacoes" ><a href="#">Deduction Report</a></li>	
		            <li id="menu-academico-avaliacoes" ><a href="#">Tra Ledger</a></li>		           
		          --></ul>
		        </li>
		        

		      </ul>
		    </div>
	 </div>