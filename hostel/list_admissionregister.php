<?php
include_once('security_check_admin.php');
include_once('../database.php');
$ho_id=$_COOKIE['hoa_id'];
$query="SELECT hostel_admission_register.ha_id, 
hostel_admission_register.rb_id, 
`ha_name`, `ha_dob`,
 `ha_gender`, `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`,
 `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`, 
 `ha_guardianmobilenumber`, `ha_permenanetaddress`, 
 `ha_temeroryaddress`, `ha_admissiondate`, `ha_vacatedate`, 
 `ha_status`, `ha_notes`, `ha_image`,rb_number,hr_roomnumber
 FROM `hostel_admission_register` 
 inner join room_beds 
 on room_beds.rb_id=hostel_admission_register.rb_id
 inner join hostel_rooms 
 on room_beds.hr_id=hostel_rooms.hr_id
 where hostel_admission_register.ho_id=$ho_id ";
$data=DataBase::SelectData($query);
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
						if(!empty($_GET['msg'])&&($_GET['msg']=="editsuccess"))
						{
						?>
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Admission Register Successfully Edited
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="deletesuccess")){
						?>
						  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<span class="badge badge-pill badge-danger">Success</span>
								Admission Register  Successfully Deleted
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div> 
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="photosuccess")){
						
                        ?>
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Photo Successfully Updated
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="notesuccess")){
						
                        ?>
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Note Successfully Updated
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="vacatesuccess")){
						?>
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Vacating Process Completed
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}
                        ?>
						
						
						<div class="card">
							<div class="card-header">
								<strong class="card-title"><th>Admission Register</th></strong>
								<a href="manage_admissionregister.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-list"></i>&nbsp; New Admission</a>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table">
									<thead>
										<tr>
										<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										while($row=mysqli_fetch_array($data)){
										if($row["ha_image"]==null){
										$imagepath="../images/students/noimage.png";
										}else{
											$imagepath="../images/students/".$row["ha_image"];	
										}
										?>
										<tr>
											<td>
											<div class="card">
												<div class="card-header">
													<strong class="card-title"><?php echo $row["ha_name"]; ?></strong> 
													
													<?php
													if($row["ha_status"]!='vacate'){
													?>
													<a href="#" data-toggle="modal" data-target="#vacateModal" data-whatever="<?php echo $row["ha_id"]; ?>=<?php echo $row["ha_name"]; ?>=<?php echo $row["rb_id"]; ?>" class="btn btn-danger btn-sm pull-right "><i class="fa fa-fighter-jet"></i>&nbsp; Vacate</a>
													<?php
													}
													if(DataBase::RowExists("attendance","ha_id=".$row["ha_id"])){
													?>
													<a class="btn btn-outline-danger btn-sm pull-right mr-2 disabled"><i class="fa fa-cut"></i>&nbsp; Delete</a>
													<?php
													}else{
													?>
													<a href="manage_admissionregister.php?ha_id=<?php echo $row["ha_id"]; ?>&mode=delete" class="btn btn-outline-danger btn-sm pull-right mr-2"><i class="fa fa-cut"></i>&nbsp; Delete</a>
													<?php
													}
													?>
													<a href="manage_admissionregister.php?ha_id=<?php echo $row["ha_id"]; ?>&mode=edit" class="btn btn-outline-primary btn-sm pull-right mr-2"><i class="fa fa-clipboard"></i>&nbsp; Edit</a>
													<a href="#" data-toggle="modal" data-target="#noteModal" data-whatever="<?php echo $row["ha_id"]; ?>=<?php echo $row["ha_name"]; ?>" class="btn btn-outline-dark btn-sm pull-right mr-2"><i class="fa fa-clipboard"></i>&nbsp; Add Note</a>
													<a href="#" data-toggle="modal" data-target="#photoModal" data-whatever="<?php echo $row["ha_id"]; ?>=<?php echo $row["ha_name"]; ?>" class="btn btn-outline-dark btn-sm pull-right mr-2"><i class="fa fa-clipboard"></i>&nbsp; Upload Photo</a>
													<a href="list_attendance_report_student_step_1.php?ha_id=<?php echo $row["ha_id"]; ?>&student=<?php echo $row["ha_name"]; ?>" class="btn btn-outline-primary btn-sm pull-right mr-2"><i class="fa fa-calendar"></i>&nbsp; Attendnace Register</a>
													
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-4">
															<ul class="list-group">
															  <li class="list-group-item active text-center">Personal Details</li>
															  <li class="list-group-item text-center"><img src="<?php echo $imagepath; ?>" style="width:130px;height:150px;" alt="..." class="img-thumbnail"></li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Name <span class="badge"><?php echo $row["ha_name"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Date of Birth <span class="badge"><?php echo $row["ha_dob"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Gender <span class="badge"><?php echo $row["ha_gender"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Email ID <span class="badge badge-primary badge-pill"><?php echo $row["ha_emailid"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Mobile Number <span class="badge badge-primary badge-pill"><?php echo $row["ha_mobilenumber"]; ?></span>
															  </li>
															</ul>
														</div>
														<div class="col-4">
															<ul class="list-group">
															  <li class="list-group-item active text-center">Guardian Details</li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Name <span class="badge"><?php echo $row["ha_guardian"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Relation <span class="badge"><?php echo $row["ha_guardianrelation"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Email ID <span class="badge badge-primary badge-pill"><?php echo $row["ha_giardianemailid"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Mobile Number <span class="badge badge-primary badge-pill"><?php echo $row["ha_guardianmobilenumber"]; ?></span>
															  </li>
															  <li class="list-group-item active text-center p-0">Permenent Address</li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  <?php echo $row["ha_permenanetaddress"]; ?>
															  </li>
															  <li class="list-group-item active text-center p-0">Temperory Address</li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  <?php echo $row["ha_temeroryaddress"]; ?>
															  </li>
															</ul>
														</div>
														<div class="col-4">
															<ul class="list-group">
															  <li class="list-group-item active text-center">Official Details</li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Admission Number <span class="badge badge-primary badge-pill"><?php echo $row["ha_admissionnumber"]; ?></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
															  Admission Date <span class="badge"><?php echo $row["ha_admissiondate"]; ?></span>
															  </li>
															   <li class="list-group-item d-flex justify-content-between align-items-center">
																Room / Bed <span><span class="badge badge-light badge-pill"><?php echo $row["hr_roomnumber"]; ?></span> / <span class="badge badge-light badge-pill"><?php echo $row["rb_number"]; ?></span></span>
															  </li>
															  <li class="list-group-item d-flex justify-content-between align-items-center">
																Status 
																<?php if($row["ha_status"]=="in"){
																?>
																<span class="badge badge-success badge-pill " style="font-size:20px;"><?php echo $row["ha_status"]; ?></span>
																<?php } else if($row["ha_status"]=="out"){
																?>
																<span class="badge badge-danger badge-pill " style="font-size:20px;"><?php echo $row["ha_status"]; ?></span>
																<?php } else if($row["ha_status"]=="vacate"){
																?>
																<span class="badge badge-secondary badge-pill " style="font-size:20px;"><?php echo $row["ha_status"]; ?></span>
																
																<?php }
																?>
															  </li>
															  <?php if($row["ha_vacatedate"]!=null){
																?>
																
																<li class="list-group-item d-flex justify-content-between align-items-center">
																Vacate Date <span class="badge badge-dark badge-pill"><?php echo $row["ha_vacatedate"]; ?></span>
															  </li>
																<?php }
																?>
																<?php if($row["ha_notes"]!=null){
																?>
																<li class="list-group-item active text-center p-0">Notes</li>
															  
																<li class="list-group-item d-flex justify-content-between align-items-center">
																<?php echo $row["ha_notes"]; ?>
															  </li>
																<?php }
																?>
															  
															</ul>
														</div>
													</div>
												</div>
											</div>
											
											</td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	<!-- Modal -->
	<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" enctype="multipart/form-data" >
		  <div class="modal-header">
			<h5 class="modal-title" id="photoModalLabel">Upload Photo</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
			<label for="exampleFormControlFile1">choose a photo graph of selected student</label>
			<input type="file" name="ha_image" class="form-control-file" id="exampleFormControlFile1">
		  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Upload Photo</button>
			<input name="ha_id" id="ha_id" value="" type="hidden" required/>
			<input name="mode" value="photo" type="hidden" required/>
											
		 </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" enctype="multipart/form-data" >
		  <div class="modal-header">
			<h5 class="modal-title" id="noteModalLabel">Write a note</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label >Write a Note</label>
				<textarea name="ha_notes" placeholder="type here" class="form-control" required></textarea>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save Note</button>
			<input name="ha_id" id="ha_id_1" value="" type="hidden" required/>
			<input name="mode" value="note" type="hidden" required/>
											
		 </div>
		  </form>
		</div>
	  </div>
	</div>
	<div class="modal fade" id="vacateModal" tabindex="-1" aria-labelledby="vacateModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" enctype="multipart/form-data" >
		  <div class="modal-header">
			<h5 class="modal-title" id="vacateModalLabel">Vacate from Hostel</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label class="control-label mb-1">Select Vacated Date</label>
				<input name="ha_vacatedate" min="<?php echo date('Y-m-d', strtotime('-10 day')); ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" type="date" class="form-control" required/>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Confirm Vacate From Hostel</button>
			<input name="ha_id" id="ha_id_2" value="" type="hidden" required/>
			<input name="rb_id" id="rb_id_2" value="" type="hidden" required/>
			<input name="mode" value="vacate" type="hidden" required/>
											
		 </div>
		  </form>
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
        } );
		$('#photoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); 
		  var recipient = button.data('whatever'); 
		  var res = recipient.split("=");
		 var modal = $(this);
		  modal.find('.modal-title').text('Upload Photo of ' + res[1]);
		 modal.find('#ha_id').val(res[0]);
		});
		
		$('#noteModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); 
		  var recipient = button.data('whatever'); 
		  var res = recipient.split("=");
		 var modal = $(this);
		  modal.find('.modal-title').text('Write a note about ' + res[1]);
		 modal.find('#ha_id_1').val(res[0]);
		});
		$('#vacateModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); 
		  var recipient = button.data('whatever'); 
		  var res = recipient.split("=");
		 var modal = $(this);
		  modal.find('.modal-title').text('Vacate ' + res[1]+ ' from hostel');
		 modal.find('#ha_id_2').val(res[0]);
		 modal.find('#rb_id_2').val(res[2]);
		});
    </script>


</body>
</html>
