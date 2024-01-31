<html>
	<?php
require "config/constants.php";
session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
}
		$ha_id=$_COOKIE['hoa_id'];
		$hd_id=$_GET['hd_id'];
		$query="SELECT `hd_id`, `hd_totalattendance`,
		`hd_totalmessfees`, `hd_roomrent`, `hd_totalfees`, 
		`hd_paymentdate`, `hd_paymentmethod`, `hd_status` ,
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
		WHERE hostel_bil_details.hd_id=$hd_id and hd_status='not paid'";
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
							 $menuset='pendingbill';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<div class="panel panel-warning">
					<div class="panel-heading" style="position:relative;">
						<h4>PAYMENT GATEWAY</h4>
						<a href="index.php"  class="btn btn-default btn-sm" style="position:absolute;right:0;top:0;"  >Back</a>
						
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
							<div class="form-group" style="position:relative;">
							<label >Debit or Credit Card Number</label>
							<input type="text " id="ur_aadhar" class="form-control" name="a" placeholder="Card Number Format : xxxx xxxx xxxx xxxx" required>
							<span id="py_ur_aadhar"  style="font-weight:bold;color:red;position:absolute;right:15px;bottom:-22px;display:none;"></span>
								
							</div>
							<div class="form-group">
								<label >Name on the Card</label>
								<input type="text" class="form-control" name="b" placeholder="Name on the card" required>
							</div>
							<div class="form-group">
								<label >CVV Number</label>
								<input type="text" class="form-control" name="c" placeholder="CVV Number on the card" required>
							</div>
							<form class="w-100 " action="payment_sql_process.php" method="post" autocomplete="off" >
							<input type="hidden" name="hd_id" value="<?php echo $row["hd_id"]; ?>" required>
							<button id="btn_save" type="submit" class="btn btn-success btn-lg" >Pay ₹ <?php echo $row["hd_totalfees"]; ?> /- Now</button>
							</form>
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
	<script>
			$(document).ready(function(){
			var typingTimer;   
			var doneTypingInterval = 800;
		
			window.aadharflag=false;
			
			$(document).on("input","#ur_aadhar",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				clearTimeout(typingTimer);	
				if ($('#ur_aadhar').val){
					typingTimer = setTimeout(function(){
                        aadhar_validation();
                   
                    },doneTypingInterval);
				}
			});
			
			
			
			function aadhar_validation(){
                $('#py_ur_aadhar').css("display","inline");
				var ur_aadhar = $("#ur_aadhar").val();
               	if(ur_aadhar.length == 19 && validateAadhar(ur_aadhar) ){
					document.getElementById('py_ur_aadhar').innerHTML="<span style='color:green'>valid card number</span>";
					window.aadharflag=true;
					finalvalidate();
                }
				else{
					document.getElementById('py_ur_aadhar').innerHTML="<span>please enter a valid card number</span>";
			        window.aadharflag=false;
                    finalvalidate();			
				}
               
            }
			 function validateAadhar($aadhar) {
            var aadharReg = /^\d{4}\s\d{4}\s\d{4}\s\d{4}$/;
            return aadharReg.test( $aadhar );
            }
			
			
			function finalvalidate(){
                if(window.aadharflag==true ) {
                    $("#btn_save").prop('disabled', false);
                }
                else{
                    $("#btn_save").prop('disabled', true);  
                }

            }
			
			});
		</script>
</html>