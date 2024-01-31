<?php
include_once('security_check_admin.php');
include_once('../database.php');
$hr_id=$_GET['hr_id'];
$query="select hr_id, `ho_id`, `hr_roomnumber`,`hr_totalaccomadation` 
FROM `hostel_rooms` where hr_id=$hr_id";
$data=DataBase::SelectData($query);
$hostel_room_row=mysqli_fetch_array($data);

$query="SELECT `rb_id`, `ho_id`, `hr_id`, `rb_number`, `ha_id`,
 `rb_rent`, `rb_status` FROM `room_beds` where hr_id=$hr_id";
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
								Room Bed @ Room Number <b><?php echo $hostel_room_row['hr_roomnumber']; ?></b>  Successfully Edited
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="deletesuccess")){
						?>
						  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<span class="badge badge-pill badge-danger">Success</span>
								Room Bed @ Room Number <b><?php echo $hostel_room_row['hr_roomnumber']; ?></b> Successfully Deleted
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div> 
						<?php
						}
                        ?>						
						<div class="card">
							<div class="card-header">
								<strong class="card-title"><th>Room Beds @  Room Number <span class="text-danger"><?php echo $hostel_room_row['hr_roomnumber']; ?></span> </th></strong>
								<a href="list_hostelroombeds_step_1.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th>Bed Number / Name</th>
										<th class="text-right">Rent</th>
										<th class="text-right">Bed Status</th>
										<th></th>
									  </tr>
									</thead>
									<tbody>
										<?php
										while($row=mysqli_fetch_array($data)){
										?>
										<tr>
											<td><?php echo $row["rb_number"]; ?></td>
											<td class="text-right">₹ <?php echo $row["rb_rent"]; ?> /-</td>
											<td class="text-right"><?php echo $row["rb_status"]; ?></td>
											<td class="text-right" style='width:149px;'>
												<a href="manage_hostelroombeds.php?hr_id=<?php echo $row["hr_id"]; ?>&rb_id=<?php echo $row["rb_id"]; ?>&mode=edit" class="btn btn-outline-primary btn-sm"><i class="fa fa-clipboard"></i>&nbsp; Edit</a>
												<?php
												if(DataBase::RowExists("hostel_admission_register","rb_id=".$row["rb_id"])){
												?>
												<a class="btn btn-outline-danger btn-sm disabled"><i class="fa fa-cut"></i>&nbsp; Delete</a>
												<?php
												}else{
												?>
												<a href="manage_hostelroombeds.php?hr_id=<?php echo $row["hr_id"]; ?>&rb_id=<?php echo $row["rb_id"]; ?>&mode=delete" class="btn btn-outline-danger btn-sm"><i class="fa fa-cut"></i>&nbsp; Delete</a>
												<?php
												}
												?>
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
