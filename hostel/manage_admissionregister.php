<?php
include_once('security_check_admin.php');
include_once('../database.php');
$ho_id=$_COOKIE['hoa_id'];
$query="SELECT `hr_id`, `ho_id`, `hr_roomnumber`,
`hr_totalaccomadation` FROM `hostel_rooms` where ho_id=$ho_id";
$rooms_data=DataBase::SelectData($query);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once('admin_title.php'); ?>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
    #py_ur_code,#py_ur_mobile,#py_email_valid
	,#py_email_valid_1,#py_ur_mobile_1{
        font-weight:bold;
        color:red;
        position:absolute;
        right:0px;
        bottom:-20px;
        display:none;
        font-size:x-small;

    }
    </style>
</head>
<body>
    <?php
     include_once('left_nav.php');
    ?>
    <div id="right-panel" class="right-panel">
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                     <div class="col-md-12">
						<?php
						if(!empty($_GET['msg']) && $_GET['msg']=="addsuccess"){
						?>
                        <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                            <span class="badge badge-pill badge-primary">Success</span>
                                Admission Register Successfully Created
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
						<?php
						}
						?>
                        <div class="card">
							<form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" >
							<?php
							if(empty($_GET['mode'])){
							?>
                                <div class="card-header">
                                    <strong class="card-title">New Admission Register</strong>
                                    <a href="list_admissionregister.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-list"></i>&nbsp; List Admission Register</a>
                                </div>
                                <div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Student Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Student Name</label>
												<input name="ha_name" type="text" placeholder="enter name of student" class="form-control" required/>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Date of Birth</label>
												<input name="ha_dob" type="date" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Gender</label>
												<select class="form-control" name="ha_gender" required>
													<option value="">Select Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Transgender">Transgender</option>
												</select>
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_email_valid" style=""></span>
												<label class="control-label mb-1">Student Email ID</label>
												<input id="ur_email" name="ha_emailid" type="email" placeholder="enter email id of student" class="form-control" required/>
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_ur_mobile" style=""></span>
									            <label class="control-label mb-1">Student Mobile Number</label>
												<input id="ur_mobile" name="ha_mobilenumber" type="text" placeholder="enter mobile number of student" class="form-control" required/>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Guardian Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Guardian Name</label>
												<input name="ha_guardian" type="text" placeholder="enter name of guardian" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Guardian Relation</label>
												<select class="form-control" name="ha_guardianrelation" required>
													<option value="">Select Relation with Guardian</option>
													<option value="Father">Father</option>
													<option value="Mother">Mother</option>
													<option value="Brother">Brother</option>
													<option value="Sister">Sister</option>
													<option value="Relative">Relative</option>
												</select>
											</div>
											<div class="form-group"  style='position:relative;'>
												<span id="py_email_valid_1" style=""></span>
												<label class="control-label mb-1">Guardian Email ID</label>
												<input id="ur_email_1" name="ha_giardianemailid" type="email" placeholder="enter email id of guardian" class="form-control" required/>
											</div>
											<div class="form-group"  style='position:relative;'>
												<span id="py_ur_mobile_1" style=""></span>
												<label class="control-label mb-1">Guardian Mobile Number</label>
												<input id="ur_mobile_1" name="ha_guardianmobilenumber" type="text" placeholder="enter mobile number of guardian" class="form-control" required/>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Official Details
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_ur_code" style=""></span>
												<label class="control-label mb-1">Admission Number</label>
												<input id="ur_code" name="ha_admissionnumber" type="text" placeholder="enter admission number" class="form-control" required/>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Admission Date</label>
												<input name="ha_admissiondate" type="date" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Room Number / Name</label>
												<select class="form-control" name="hr_id" id="hr_id" required>
													<option value="">Select Room Number / Name</option>
													<?php
													while($row=mysqli_fetch_array($rooms_data)){
													?>
													<option value="<?php echo $row["hr_id"]; ?>"><?php echo $row["hr_roomnumber"]; ?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label >Bed Number / Name</label>
												<select class="form-control" name="rb_id" id="rb_id" required>
													<option value="">Select Bed Number / Name</option>
												</select>
											</div>
											
										</div>
									</div>
									<div class="row mt-1">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Permenent Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_permenanetaddress" placeholder="enter permenent address here" class="form-control" required></textarea>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Temperory Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_temeroryaddress" placeholder="enter temperory address here" class="form-control" required></textarea>
											</div>
										</div>
										<div class="col-4 pt-4 mt-5">
											<input name="ha_id" id="ha_id" value="0" type="hidden" required/>
											<input name="mode" value="add" type="hidden" required/>
											<button id="btn_save" type="submit" class="btn btn-md btn-info pull-right ">
											<i class="fa fa-check"></i>&nbsp;Save
											</button>
											<a href="list_admissionregister.php" class="btn btn-md btn-outline-secondary"><i class="ti-close"></i>&nbsp; Cancel</a>
										</div>
									</div>
                               </div>
								<?php 
								}else if(!empty($_GET['mode'])&&($_GET['mode']=="edit")){
								$ha_id=$_GET['ha_id']; 
                                $query="SELECT hostel_admission_register.ha_id, hostel_admission_register.ho_id, hostel_admission_register.rb_id, `ha_name`, `ha_dob`,
								 `ha_gender`, `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`,
								 `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`, 
								 `ha_guardianmobilenumber`, `ha_permenanetaddress`, 
								 `ha_temeroryaddress`, `ha_admissiondate`, `ha_vacatedate`, 
								 `ha_status`, `ha_notes`, `ha_image`,hr_id 
								 FROM `hostel_admission_register` 
								 inner join room_beds 
								 on room_beds.rb_id=hostel_admission_register.rb_id
								 where hostel_admission_register.ha_id='$ha_id'";
                                $data=DataBase::SelectData($query);
								$row=mysqli_fetch_array($data);	
								?>
								<div class="card-header">
                                    <strong class="card-title">Edit Admission Register</strong>
                                    <a href="list_admissionregister.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-list"></i>&nbsp; List Admission Register</a>
                                </div>
                                <div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Student Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Student Name</label>
												<input name="ha_name" value="<?php echo $row['ha_name']; ?>" type="text" placeholder="enter name of student" class="form-control" required/>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Date of Birth</label>
												<input name="ha_dob" value="<?php echo $row['ha_dob']; ?>" type="date" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Gender</label>
												<select class="form-control" name="ha_gender" required>
													<option value="">Select Gender</option>
													<option value="Male" <?php if($row['ha_gender']=="male"){ echo "selected";}?>>Male</option>
													<option value="Female" <?php if($row['ha_gender']=="female"){ echo "selected";}?>>Female</option>
													<option value="Transgender" <?php if($row['ha_gender']=="transgender"){ echo "selected";}?>>Transgender</option>
												</select>
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_email_valid" style=""></span>
                                                <label class="control-label mb-1">Student Email ID</label>
												<input id="ur_email" name="ha_emailid" value="<?php echo $row['ha_emailid']; ?>" type="email" placeholder="enter email id of student" class="form-control" required/>
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_ur_mobile" style=""></span>
												<label class="control-label mb-1">Student Mobile Number</label>
												<input id="ur_mobile" name="ha_mobilenumber" value="<?php echo $row['ha_mobilenumber']; ?>" type="text" placeholder="enter mobile number of student" class="form-control" required/>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Guardian Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Guardian Name</label>
												<input name="ha_guardian" value="<?php echo $row['ha_guardian']; ?>" type="text" placeholder="enter name of guardian" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Guardian Relation</label>
												<select class="form-control" name="ha_guardianrelation" required>
													<option value="">Select Relation with Guardian</option>
													<option value="Father" <?php if($row['ha_guardianrelation']=="Father"){ echo "selected";}?>>Father</option>
													<option value="Mother" <?php if($row['ha_guardianrelation']=="Mother"){ echo "selected";}?>>Mother</option>
													<option value="Brother" <?php if($row['ha_guardianrelation']=="Brother"){ echo "selected";}?>>Brother</option>
													<option value="Sister" <?php if($row['ha_guardianrelation']=="Sister"){ echo "selected";}?>>Sister</option>
													<option value="Relative" <?php if($row['ha_guardianrelation']=="Relative"){ echo "selected";}?>>Relative</option>
												</select>
											</div>
											<div class="form-group" style='position:relative;'>
												<label class="control-label mb-1">Guardian Email ID</label>
												<input name="ha_giardianemailid" value="<?php echo $row['ha_giardianemailid']; ?>" type="email" placeholder="enter email id of guardian" class="form-control" required/>
											</div>
											<div class="form-group" style='position:relative;'>
												<label class="control-label mb-1">Guardian Mobile Number</label>
												<input name="ha_guardianmobilenumber" value="<?php echo $row['ha_guardianmobilenumber']; ?>" type="text" placeholder="enter mobile number of guardian" class="form-control" required/>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Official Details
											</div>
											<div class="form-group" style='position:relative;'>
												<span id="py_ur_code" style=""></span>
												<label class="control-label mb-1">Admission Number</label>
												<input id="ur_code" name="ha_admissionnumber" value="<?php echo $row['ha_admissionnumber']; ?>" type="text" placeholder="enter admission number" class="form-control" required/>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Admission Date</label>
												<input name="ha_admissiondate" value="<?php echo $row['ha_admissiondate']; ?>" type="date" class="form-control" required/>
											</div>
											<div class="form-group">
												<label >Room Number / Name</label>
												<select class="form-control" name="hr_id" id="hr_id" required>
													<option value="">Select Room Number / Name</option>
													<?php
													while($row1=mysqli_fetch_array($rooms_data)){
													?>
													<option value="<?php echo $row1["hr_id"]; ?>" <?php if($row1['hr_id']==$row['hr_id']){ echo "selected";}?>><?php echo $row1["hr_roomnumber"]; ?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label >Bed Number / Name</label>
												<select class="form-control" name="rb_id" id="rb_id" required>
													<option value="">Select Bed Number / Name</option>
													<?php
													$query="SELECT `rb_id`, `ho_id`, `hr_id`, `rb_number`, `ha_id`,
													`rb_rent`, `rb_status` FROM `room_beds` where hr_id=".$row['hr_id'];
													$beds_data=DataBase::SelectData($query);
													while($row1=mysqli_fetch_array($beds_data)){
													?>
													<option value="<?php echo $row1['rb_id']; ?>" <?php if($row1['rb_id']==$row['rb_id']){ echo "selected";}?>><?php echo $row1['rb_number']; ?> ( Rent : <span style="color:red;">₹ <?php echo $row1['rb_rent'];?> /-)</span></option>
													<?php
													}
													?>
												</select>
											</div>
											
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Permenent Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_permenanetaddress" placeholder="enter permenent address here" class="form-control" required><?php echo $row['ha_permenanetaddress']; ?></textarea>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Temperory Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_temeroryaddress" placeholder="enter temperory address here" class="form-control" required><?php echo $row['ha_temeroryaddress']; ?></textarea>
											</div>
										</div>
										<div class="col-4 pt-4 mt-5">
											<input name="ha_id" id="ha_id" value="<?php echo $row['ha_id']; ?>" type="hidden" required/>
											<input name="mode" value="edit" type="hidden" required/>
											<button id="btn_save" type="submit" class="btn btn-md btn-info pull-right ">
											<i class="fa fa-check"></i>&nbsp;Edit
											</button>
											<a href="list_admissionregister.php" class="btn btn-md btn-outline-secondary"><i class="ti-close"></i>&nbsp; Cancel</a>
										</div>
									</div>
                               </div>
								<?php
								}else if(!empty($_GET['mode'])&&($_GET['mode']=="delete")){
								$ha_id=$_GET['ha_id']; 
                               $query="SELECT hostel_admission_register.ha_id, hostel_admission_register.ho_id, hostel_admission_register.rb_id, `ha_name`, `ha_dob`,
								 `ha_gender`, `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`,
								 `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`, 
								 `ha_guardianmobilenumber`, `ha_permenanetaddress`, 
								 `ha_temeroryaddress`, `ha_admissiondate`, `ha_vacatedate`, 
								 `ha_status`, `ha_notes`, `ha_image`,hr_id 
								 FROM `hostel_admission_register` 
								 inner join room_beds 
								 on room_beds.rb_id=hostel_admission_register.rb_id
								 where hostel_admission_register.ha_id='$ha_id'";
                                $data=DataBase::SelectData($query);$row=mysqli_fetch_array($data);		
								?>
								<div class="card-header">
                                    <strong class="card-title">Delete Admission Register</strong>
                                    <a href="list_admissionregister.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-list"></i>&nbsp; List Admission Register</a>
                                </div>
                                <div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Student Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Student Name</label>
												<input name="ha_name" value="<?php echo $row['ha_name']; ?>" type="text" placeholder="enter name of student" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Date of Birth</label>
												<input name="ha_dob" value="<?php echo $row['ha_dob']; ?>" type="date" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label >Gender</label>
												<select class="form-control" name="ha_gender" required disabled >
													<option value="">Select Gender</option>
													<option value="male" <?php if($row['ha_gender']=="male"){ echo "selected";}?>>Male</option>
													<option value="female" <?php if($row['ha_gender']=="female"){ echo "selected";}?>>Female</option>
													<option value="transgender" <?php if($row['ha_gender']=="transgender"){ echo "selected";}?>>Transgender</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Student Email ID</label>
												<input name="ha_emailid" value="<?php echo $row['ha_emailid']; ?>" type="email" placeholder="enter email id of student" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Student Mobile Number</label>
												<input name="ha_mobilenumber" value="<?php echo $row['ha_mobilenumber']; ?>" type="text" placeholder="enter mobile number of student" class="form-control" required disabled />
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Guardian Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Guardian Name</label>
												<input name="ha_guardian" value="<?php echo $row['ha_guardian']; ?>" type="text" placeholder="enter name of guardian" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label >Guardian Relation</label>
												<select class="form-control" name="ha_guardianrelation" required disabled >
													<option value="">Select Relation with Guardian</option>
													<option value="Father" <?php if($row['ha_guardianrelation']=="Father"){ echo "selected";}?>>Father</option>
													<option value="Mother" <?php if($row['ha_guardianrelation']=="Mother"){ echo "selected";}?>>Mother</option>
													<option value="Brother" <?php if($row['ha_guardianrelation']=="Brother"){ echo "selected";}?>>Brother</option>
													<option value="Sister" <?php if($row['ha_guardianrelation']=="Sister"){ echo "selected";}?>>Sister</option>
													<option value="Relative" <?php if($row['ha_guardianrelation']=="Relative"){ echo "selected";}?>>Relative</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Guardian Email ID</label>
												<input name="ha_giardianemailid" value="<?php echo $row['ha_giardianemailid']; ?>" type="email" placeholder="enter email id of guardian" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Guardian Mobile Number</label>
												<input name="ha_guardianmobilenumber" value="<?php echo $row['ha_guardianmobilenumber']; ?>" type="text" placeholder="enter mobile number of guardian" class="form-control" required disabled />
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Official Details
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Admission Number</label>
												<span id="py_ur_code" style=""></span>
												<input name="ha_admissionnumber" value="<?php echo $row['ha_admissionnumber']; ?>" type="text" placeholder="enter admission number" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label class="control-label mb-1">Admission Date</label>
												<input name="ha_admissiondate" value="<?php echo $row['ha_admissiondate']; ?>" type="date" class="form-control" required disabled />
											</div>
											<div class="form-group">
												<label >Room Number / Name</label>
												<select class="form-control" name="hr_id" id="hr_id" required disabled >
													<option value="">Select Room Number / Name</option>
													<?php
													while($row1=mysqli_fetch_array($rooms_data)){
													?>
													<option value="<?php echo $row1["hr_id"]; ?>" <?php if($row1['hr_id']==$row['hr_id']){ echo "selected";}?>><?php echo $row1["hr_roomnumber"]; ?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label >Bed Number / Name</label>
												<select class="form-control" name="rb_id" id="rb_id" required disabled >
													<option value="">Select Bed Number / Name</option>
													<?php
													$query="SELECT `rb_id`, `ho_id`, `hr_id`, `rb_number`, `ha_id`,
													`rb_rent`, `rb_status` FROM `room_beds` where hr_id=".$row['hr_id'];
													$beds_data=DataBase::SelectData($query);
													while($row1=mysqli_fetch_array($beds_data)){
													?>
													<option value="<?php echo $row1['rb_id']; ?>" <?php if($row1['rb_id']==$row['rb_id']){ echo "selected";}?>><?php echo $row1['rb_number']; ?> ( Rent : <span style="color:red;">₹ <?php echo $row1['rb_rent'];?> /-)</span></option>
													<?php
													}
													?>
												</select>
											</div>
											
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Permenent Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_permenanetaddress" placeholder="enter permenent address here" class="form-control" required disabled ><?php echo $row['ha_permenanetaddress']; ?></textarea>
											</div>
										</div>
										<div class="col-4">
											<div class="sufee-alert alert with-close alert-warning fade show">
												Temperory Address Details
											</div>
											<div class="form-group">
												<textarea name="ha_temeroryaddress" placeholder="enter temperory address here" class="form-control" required disabled ><?php echo $row['ha_temeroryaddress']; ?></textarea>
											</div>
										</div>
										<div class="col-4 pt-4 mt-5">
											<input name="ha_id" id="ha_id" value="<?php echo $row['ha_id']; ?>" type="hidden" required/>
											<input name="mode" value="delete" type="hidden" required/>
											<button id="btn_save" type="submit" class="btn btn-md btn-info pull-right ">
											<i class="fa fa-check"></i>&nbsp;Delete
											</button>
											<a href="list_admissionregister.php" class="btn btn-md btn-outline-secondary"><i class="ti-close"></i>&nbsp; Cancel</a>
										</div>
									</div>
                               </div>
								<?php
								}
								?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/lib/data-table/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
		  
		  $("#hr_id").change(function(){
				var id=$(this).val();
				var dataString = 'hr_id='+ id;
				$.ajax({
					type: "POST",
					url: "ajax/hostel_room_beds.php",
					data: dataString,
					cache: false,
					success: function(html){
					$("#rb_id").html(html);
					} 
				});
			});
        } );
    </script>
	<script>
			$(document).ready(function(){
			var typingTimer;   
			var doneTypingInterval = 800;
            <?php
            if(!empty($_GET['ha_id'])){
            ?>
			window.admissionflag=true;
            window.emailflag=true;
            window.mobileflag=true;
			window.emailflag_1=true;
            window.mobileflag_1=true;
            <?php
            }else{
            ?>
			window.admissionflag=false;
            window.emailflag=false;
            window.mobileflag=false;
			window.emailflag_1=false;
            window.mobileflag_1=false;
            <?php
            }
            ?>
			$(document).on("input","#ur_code",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				
				clearTimeout(typingTimer);	
				if ($('#ur_code').val){
					typingTimer = setTimeout(function(){
                    code_validation(); 
                    },doneTypingInterval);
				}
			});
			$(document).on("input","#ur_email",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				
				clearTimeout(typingTimer);	
				if ($('#ur_email').val){
					typingTimer = setTimeout(function(){
                    email_validation(); 
                    },doneTypingInterval);
				}
			});
			$(document).on("input","#ur_email_1",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				
				clearTimeout(typingTimer);	
				if ($('#ur_email_1').val){
					typingTimer = setTimeout(function(){
                    email_validation_1(); 
                    },doneTypingInterval);
				}
			});
            $(document).on("input","#ur_mobile",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				clearTimeout(typingTimer);	
				if ($('#ur_mobile').val){
					typingTimer = setTimeout(function(){
                        mobile_validation();
                   
                    },doneTypingInterval);
				}
			});
			$(document).on("input","#ur_mobile_1",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				clearTimeout(typingTimer);	
				if ($('#ur_mobile_1').val){
					typingTimer = setTimeout(function(){
                        mobile_validation_1();
                   
                    },doneTypingInterval);
				}
			});
			function code_validation(){
                $('#py_ur_code').css("display","inline");
				var ur_code = $("#ur_code").val();
                var ha_id = $("#ha_id").val();
				if(ur_code.length == 6 ){
					document.getElementById('py_ur_code').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "ajax/hostelcode_checking_sql_process.php",  
						data: "ur_code="+ur_code+"&ha_id="+ha_id,
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_ur_code').innerHTML="<span><i>"+ur_code+" </i> is already used</span>";
							    window.admissionflag=false;
                        	}
							else{
								document.getElementById('py_ur_code').innerHTML="<span style='color:green'><i>"+ur_code+" </i> is available</span>";
								window.admissionflag=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_ur_code').innerHTML="<span>admission number should have only 6 characters</span>";
			        window.admissionflag=false;
                    finalvalidate();			
				}
               
            }
			function email_validation(){
                $('#py_email_valid').css("display","inline");
				var ur_email = $("#ur_email").val();
                var ha_id = $("#ha_id").val();
				if(ur_email.length >= 5 && validateEmail(ur_email) ){
					document.getElementById('py_email_valid').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "ajax/hostelemailid_checking_sql_process.php",  
						data: "ur_email="+ur_email+"&ha_id="+ha_id,
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_email_valid').innerHTML="<span><i>"+ur_email+" </i> is already used</span>";
							    window.emailflag=false;
                        	}
							else{
								document.getElementById('py_email_valid').innerHTML="<span style='color:green'><i>"+ur_email+" </i> is available</span>";
								window.emailflag=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_email_valid').innerHTML="<span>please enter a valid email id</span>";
			        window.emailflag=false;
                    finalvalidate();			
				}
               
            }
			function email_validation_1(){
                $('#py_email_valid_1').css("display","inline");
				var ur_email = $("#ur_email_1").val();
                var ha_id = $("#ha_id").val();
				if(ur_email.length >= 5 && validateEmail(ur_email) ){
					document.getElementById('py_email_valid_1').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "ajax/hostelemailid_checking_sql_process_1.php",  
						data: "ur_email="+ur_email+"&ha_id="+ha_id,
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_email_valid_1').innerHTML="<span><i>"+ur_email+" </i> is already used</span>";
							    window.emailflag_1=false;
                        	}
							else{
								document.getElementById('py_email_valid_1').innerHTML="<span style='color:green'><i>"+ur_email+" </i> is available</span>";
								window.emailflag_1=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_email_valid_1').innerHTML="<span>please enter a valid email id</span>";
			        window.emailflag_1=false;
                    finalvalidate();			
				}
               
            }
            function mobile_validation(){
                $('#py_ur_mobile').css("display","inline");
				var ur_mobile = $("#ur_mobile").val();
                var ha_id = $("#ha_id").val();
				if(ur_mobile.length >= 10 && validateMobile(ur_mobile) ){
					document.getElementById('py_ur_mobile').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "ajax/hostelmobile_checking_sql_process.php",  
						data: "ur_mobile="+ur_mobile+"&ha_id="+ha_id,
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_ur_mobile').innerHTML="<span><i>"+ur_mobile+" </i> is already used</span>";
							    window.mobileflag=false;
                        	}
							else{
								document.getElementById('py_ur_mobile').innerHTML="<span style='color:green'><i>"+ur_mobile+" </i> is available</span>";
								window.mobileflag=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_ur_mobile').innerHTML="<span>please enter a valid mobile number</span>";
			        window.mobileflag=false;
                    finalvalidate();			
				}
               
            }
			function mobile_validation_1(){
                $('#py_ur_mobile_1').css("display","inline");
				var ur_mobile = $("#ur_mobile_1").val();
                var ha_id = $("#ha_id").val();
				if(ur_mobile.length >= 10 && validateMobile(ur_mobile) ){
					document.getElementById('py_ur_mobile_1').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "ajax/hostelmobile_checking_sql_process_1.php",  
						data: "ur_mobile="+ur_mobile+"&ha_id="+ha_id,
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_ur_mobile_1').innerHTML="<span><i>"+ur_mobile+" </i> is already used</span>";
							    window.mobileflag_1=false;
                        	}
							else{
								document.getElementById('py_ur_mobile_1').innerHTML="<span style='color:green'><i>"+ur_mobile+" </i> is available</span>";
								window.mobileflag_1=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_ur_mobile_1').innerHTML="<span>please enter a valid mobile number</span>";
			        window.mobileflag_1=false;
                    finalvalidate();			
				}
               
            }
            function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
            }
            function validateMobile($mobile) {
            var mobileReg = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
            return mobileReg.test( $mobile );
            }
            function finalvalidate(){
                if(window.emailflag==true && window.mobileflag==true && 
				window.mobileflag_1==true && window.emailflag_1==true && window.admissionflag==true   ){
                    $("#btn_save").prop('disabled', false);
                }
                else{
                    $("#btn_save").prop('disabled', true);  
                }

            }
        });
	</script>
</body>
</html>
