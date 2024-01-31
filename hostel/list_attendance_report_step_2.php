<?php
include_once('security_check_admin.php');
include_once('../database.php');
$at_date=$_GET['at_date'];
$ho_id=$_COOKIE['hoa_id'];
$date=date_create($at_date);
$query="SELECT hostel_admission_register.ha_id,at_id,`ha_name`, `ha_mobilenumber`, `ha_image`,
`rb_number`, `hr_roomnumber` ,at_status
FROM  hostel_admission_register
inner join 
room_beds
on hostel_admission_register.rb_id=room_beds.rb_id
INNER JOIN 
hostel_rooms
ON
hostel_rooms.hr_id=room_beds.hr_id
INNER JOIN 
attendance 
on attendance.ha_id=hostel_admission_register.ha_id
WHERE ha_status!='vaccate' and at_date='$at_date' 
and hostel_admission_register.ho_id=$ho_id";
$data=DataBase::SelectData($query);
$tot_presnt=0;
$tot_absent=0;
 while($row=mysqli_fetch_array($data)){
	 if($row['at_status']=='present'){
		$tot_presnt++; 
	 }else if($row['at_status']=='absent'){
		$tot_absent++; 
	 }
 }
 mysqli_data_seek ( $data , 0 ); 
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
						<div class="card">
							<div class="card-header">
							<strong class="card-title">Attendance Register on <span class="text-primary"><?php echo date_format($date,"d/m/Y"); ?></span> [ <span class="text-success">Present :<?php echo $tot_presnt ?> </span> | <span class="text-danger">Absent :<?php echo $tot_absent; ?> </span> | <span class="text-info">Strength :<?php echo $tot_presnt+$tot_absent; ?> </span>  ]</strong>
							<a href="list_attendance_report_step_1.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-angle-left"></i>&nbsp; Back</a>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th>&nbsp;</th>
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
										if($row["at_status"]=='present'){
											$at_status="Present";
											$at_color="text-success";
											$at_link_color="btn-outline-danger";
											$at_link_text="Mark as Absent";
											$mode="absent";
										}else{
											$at_status="Absent";
											$at_color="text-danger";
											$at_link_color="btn-outline-success";
											$at_link_text="Mark as Presnt";
											$mode="present";
										}
										?>
										<tr>
											<td class="d-flex align-items-center justify-content-between">
												<img src="<?php echo $imagepath; ?>" alt="<?php echo $row["ha_image"]; ?>" style="width:170px;height:200px;" class="img-thumbnail">
												<ul class="list-group w-75 ml-5">
												  <li class="list-group-item d-flex align-items-center justify-content-between">
												  <span>student name</span><h3><?php echo $row["ha_name"]; ?></h3>
												  </li>
												  <li class="list-group-item d-flex align-items-center justify-content-between">
												  <span>mobile number</span><span><?php echo $row["ha_mobilenumber"]; ?></span>
												  </li>
												  <li class="list-group-item d-flex align-items-center justify-content-between">
												  <span>room / bed number </span><span><?php echo $row["hr_roomnumber"]; ?> / <?php echo $row["rb_number"]; ?></span>
												  </li>
												  <li class="list-group-item d-flex align-items-center justify-content-between">
												  <span>Attendance Status </span>
												  <span>
												  <b class="<?php echo $at_color; ?>"><?php echo $at_status; ?></b>
												  </span>
												  </li>
												</ul>
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
    </script>


</body>
</html>
