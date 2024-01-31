<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$ha_id=$_COOKIE['hoa_id'];
		$hoa_usertype=$_COOKIE['hoa_usertype'];
		$query="SELECT `hd_id`, `hd_totalattendance`,
		`hd_totalmessfees`, `hd_roomrent`, `hd_totalfees`, 
		`hd_paymentdate`, `hd_paymentmethod`, `hd_status` ,
		ha_name,ha_admissionnumber,ha_mobilenumber,ha_image,
		rb_number,hr_roomnumber,hb_month,hb_duedate,
		MONTH(hb_month) as month ,YEAR(hb_month) as year,
		room_beds.ho_id
		FROM `hostel_bil_details` 
		inner join hostel_bill_calculator 
		on hostel_bill_calculator.hb_id=hostel_bil_details.hb_id
		inner join hostel_admission_register 
		on hostel_admission_register.ha_id=hostel_bil_details.ha_id
		inner join room_beds 
		on room_beds.rb_id=hostel_admission_register.rb_id
		inner join hostel_rooms 
		on room_beds.hr_id=hostel_rooms.hr_id
		WHERE hostel_bil_details.ha_id=$ha_id and hd_status='not paid'";
		$data=DataBase::SelectData($query);
		
		$query="SELECT `al_id`, hostel_alerts.ho_id, `al_type`, 
		DATE_FORMAT(al_date, '%I:%i %p') as `al_date`, `al_message`, 
		`al_recivertype` FROM `hostel_alerts`
		inner join hostel_admission_register 
		on hostel_admission_register.ho_id=hostel_alerts.ho_id
		WHERE ha_id=$ha_id and al_recivertype='$hoa_usertype' 
		and DATE(al_date)=CURDATE()";
		$alert_data=DataBase::SelectData($query);
		
		
	?>
	<body style="background-image:url('img/repeater.gif');">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation" style="min-height:60px !important;">
			<div class="container-fluid">
				<?php
					include_once 'navbar.php';
				?>
				<nav role="navigation" class="collapse navbar-collapse navbar-right" style="min-height:60px !important;">
					<ul class="navbar-nav nav">
					   <?php
							 $menuset='pendingbill';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<?php
					if(!empty($_GET['msg']) && $_GET['msg']=="paymentsuccess"){
					?>
					<div class="alert alert-success text-center" role="alert">
					  Payment Process Success
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<?php
					}
					?>
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4>PENDING HOSTEL FEES</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							<tr >
								<th>
								Month
								</th>
								
								<th class="text-right">
								Fees
								</th>
								
							</tr>
							<?php
							$total=0;
							while($row=mysqli_fetch_array($data))
							{
							$total+=$row["hd_totalfees"];	
							?>
							<tr>
								<td>
									<b style="font-size:20px;"><?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></b>
								</td>
							
								<td class="text-right">
								Mess Fees : ₹ <?php echo $row["hd_totalmessfees"]; ?> /-<br/>
								Room Rent : ₹ <?php echo $row["hd_roomrent"]; ?> /-<br/>
								Total : <b class="text-danger">₹ <?php echo $row["hd_totalfees"]; ?> /-</b>
														
								</td>
								
							</tr>
							<tr>
							<td colspan="2" class="text-center"> 
							<a href="payment_gayeway.php?hd_id=<?php echo $row["hd_id"]; ?>"  class="btn btn-success btn-lg" >Pay ₹ <?php echo $row["hd_totalfees"]; ?> /- Now</a>
							</td>
							</tr>
							<?php
							}
							if(mysqli_num_rows($data)==0)
							{
							?>
							<tr>
								<td colspan="2">
									<span  STYLE="COLOR:RED;">
									NO PENDING FEES
									</span>
								</td>
							</tr>
							<?php
							}
							else{
							?>
							<tr>
								<th>
									Total Pending Fees
								</th>
							
								<td class="text-right">
									<span style='color:red;font-weight:bold'>₹ <?php echo $total;?> /-</span>
								</td>
								
							</tr>
							<?php
							}
							?>
						</table>
					</div>    
				</div>
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h4>TODAY ALERTS</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							
							<?php
							while($row=mysqli_fetch_array($alert_data))
							{
								
							?>
							<tr>
								<td class="text-center">
								<h4 class="text-danger text-center"><?php echo $row["al_type"]; ?> @ <?php echo $row["al_date"]; ?></h4>
								<b><?php echo $row["al_message"]; ?></b><br/>
								</td>
								
							</tr>
							<?php
							}
							if(mysqli_num_rows($alert_data)==0)
							{
							?>
							<tr>
								<td colspan="2">
									<span  STYLE="COLOR:RED;">
									NO ALERTS
									</span>
								</td>
							</tr>
							<?php
							}
							?>
						</table>
					</div>    
				</div>
			</div>
		</div>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
		<?php include_once("footer.php"); ?>
	</body>
</html>