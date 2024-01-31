<?php
include_once('security_check_admin.php');
include_once('../database.php');
		$year=$_GET['year'];
		$month=$_GET['month'];
		$ha_id=$_GET['ha_id'];
		$ha_name=$_GET['student'];
		$attendance=database::SelectData("SELECT `at_id`, `ha_id`, 
		`at_date`, `at_status`,
		DATE_FORMAT(at_date, '%d/%M/%Y') as at_date1		FROM `attendance`
		WHERE ha_id=$ha_id and YEAR(at_date)=$year and  MONTH(at_date)=$month order by at_date asc");
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
							<strong class="card-title">Attendance Register @ <span class="text-danger"><?php echo $ha_name; ?> ( <?php echo $month;?> / <?php echo $year;?> )</span></strong>
							<a href="list_attendance_report_student_step_1.php?ha_id=<?php echo $ha_id; ?>&student=<?php echo $ha_name; ?>" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-angle-left"></i>&nbsp; Back</a>
							
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table-1" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th class="text-center">Date</th>
										<th class="text-center">Status</th>
									</tr>
									</thead>
									<tbody>
										<?php
										while($row=mysqli_fetch_array($attendance)){
										?>
										<tr>
											
											<td class="text-center">
												<b style="font-size:20px;"><?php echo $row["at_date1"]; ?></b>
											</td>
											<td class="text-center">
											<?php
											if($row["at_status"]=='present'){
											?>
											<b class="text-success">P</b>
											<?php
											}else{
											?>
											<b class="text-danger">A</b>
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
          $('#bootstrap-data-table-1').DataTable({
		  paging:true,
		  ordering:false,
		  }
		  );
        } );
    </script>


</body>
</html>
