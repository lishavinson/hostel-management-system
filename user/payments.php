<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$ha_id=$_COOKIE['hoa_id'];
		$query="SELECT `hd_id`, `hd_totalattendance`,
		`hd_totalmessfees`, `hd_roomrent`, `hd_totalfees`, 
		DATE_FORMAT(`hd_paymentdate`, '%d/%M/%Y') as `hd_paymentdate`, `hd_paymentmethod`, `hd_status` ,
		ha_name,ha_admissionnumber,ha_mobilenumber,ha_image,
		rb_number,hr_roomnumber,hb_month,hb_duedate,
		MONTH(hb_month) as month ,YEAR(hb_month) as year
		FROM `hostel_bil_details` 
		inner join hostel_bill_calculator 
		on hostel_bill_calculator.hb_id=hostel_bil_details.hb_id
		inner join hostel_admission_register 
		on hostel_admission_register.ha_id=hostel_bil_details.ha_id
		inner join room_beds 
		on room_beds.rb_id=hostel_admission_register.rb_id
		inner join hostel_rooms 
		on room_beds.hr_id=hostel_rooms.hr_id
		WHERE hostel_bil_details.ha_id=$ha_id and hd_status='paid'";
		$data=DataBase::SelectData($query);
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
							 $menuset='payments';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4>PAYMENT REPORTS</h4>
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
							<a  class="btn btn-info btn-lg" ><?php echo $row["month"]; ?> / <?php echo $row["year"]; ?><br/>Bill Paid on <?php echo $row["hd_paymentdate"]; ?></a>
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
									NO FEES PAID YET
									</span>
								</td>
							</tr>
							<?php
							}
							else{
							?>
							<tr>
								<th>
									Total Paid Fees
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
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
</html>