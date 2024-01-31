<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$ha_id=$_COOKIE['hoa_id'];
		$query="SELECT hostel_admission_register.ha_id, 
hostel_admission_register.rb_id, 
`ha_name`,DATE_FORMAT(ha_dob, '%d/%M/%Y') as `ha_dob`,
 `ha_gender`, `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`,
 `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`, 
 `ha_guardianmobilenumber`, `ha_permenanetaddress`, 
 `ha_temeroryaddress`, DATE_FORMAT(ha_admissiondate, '%d/%M/%Y') as `ha_admissiondate`, `ha_vacatedate`, 
 `ha_status`, `ha_notes`, `ha_image`,rb_number,hr_roomnumber,
 `ho_name`, `ho_institution`, `ho_address`, `ho_mobilenumber`, 
 `ho_landline`, `ho_emailid`
 FROM `hostel_admission_register` 
 inner join room_beds 
 on room_beds.rb_id=hostel_admission_register.rb_id
 inner join hostel_rooms 
 on room_beds.hr_id=hostel_rooms.hr_id
 inner join hostels 
 on hostels.ho_id=hostel_admission_register.ho_id
 where hostel_admission_register.ha_id=$ha_id";
 $data=DataBase::SelectData($query);
$studentdetails=mysqli_fetch_array($data);
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
							 $menuset='profile';
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
						<h4>STUDENT PROFILE</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							<tr >
								<td>
								Student Name
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_name'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Gender
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_gender'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Date of Birth
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_dob'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Date of Admission
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_admissiondate'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Admission Number
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_admissionnumber'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Guardian
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_guardian'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Relation
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_guardianrelation'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Mobile Numebr
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_mobilenumber'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Email ID
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_emailid'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Guardian Mobile Numebr
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_guardianmobilenumber'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Guardian Email ID
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ha_giardianemailid'];?></span>
								</th>
								
							</tr>
							
						</table>
					</div>    
				</div>
			</div>
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4>HOSTEL PROFILE</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							<tr >
								<td>
								Hostel Name
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_name'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Institution
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_institution'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Address
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_address'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Mobile Number
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_mobilenumber'];?> </span>
								</th>
								
							</tr>
							<tr >
								<td>
								Landline Number
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_landline'];?> </span>
								</th>
								
							</tr>
							<tr >
								<td>
								Contact Email ID
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['ho_emailid'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Room Number
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['hr_roomnumber'];?></span>
								</th>
								
							</tr>
							<tr >
								<td>
								Bed Number
								</td>
								
								<th class="text-right">
								<span style="color:red;"><?php echo $studentdetails['rb_number'];?></span>
								</th>
								
							</tr>
						</table>
					</div>    
				</div>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
</html>