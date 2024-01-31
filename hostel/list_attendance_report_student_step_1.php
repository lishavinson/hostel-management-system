<?php
include_once('security_check_admin.php');
include_once('../database.php');
	$ha_id=$_GET['ha_id'];
	$ha_name=$_GET['student'];
	$total_present=database::SelectData("SELECT 
	case when count(*) is null then 0 
	when count(*)>0 then count(*) end as total,
	MONTH(at_date) as month ,YEAR(at_date) as year
	FROM  `attendance`
	WHERE ha_id=$ha_id and at_status='present' GROUP BY YEAR(at_date), MONTH(at_date) order by YEAR(at_date),MONTH(at_date)");
	$total_absent=database::SelectData("SELECT 
	case when count(*) is null then 0 
	when count(*)>0 then count(*) end as total,
	MONTH(at_date) as month ,YEAR(at_date) as year
	FROM  `attendance`
	WHERE ha_id=$ha_id and at_status='absent' GROUP BY YEAR(at_date), MONTH(at_date) order by YEAR(at_date),MONTH(at_date)");

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
							<strong class="card-title">Attendance Register @ <span class="text-danger"><?php echo $ha_name; ?></span></strong>
							<a href="list_admissionregister.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-angle-left"></i>&nbsp; Back</a>
							
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table-1" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th class="text-center">Month</th>
										<th class="text-center">Total Presnt</th>
										<th class="text-center">Total Absent</th>
										<th>&nbsp;</th>
									 </tr>
									</thead>
									<tbody>
											<?php
										while($row=mysqli_fetch_array($total_present)){
										$row1=mysqli_fetch_array($total_absent);
								
										?>
										<tr>
											
											<td class="text-center">
											<h3 class="text-info"><?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></h3>
											</td>
											<td class="text-center">
											<h3 class="text-success"><b class="text-success"><?php if(!empty($row["total"])) { echo $row["total"]; } else{ echo "0" ;} ?></b></h3>
											</td>
											<td class="text-center">
											<h3 class="text-danger"><b class="text-danger"><?php  if(!empty($row1["total"])) { echo $row1["total"];} else{ echo "0" ;}; ?></b></h3>
											</td>
											<td class="text-right" style="width:150px;">
												<a href="list_attendance_report_student_step_2.php?year=<?php echo $row["year"]; ?>&month=<?php echo $row["month"]; ?>&ha_id=<?php echo $ha_id; ?>&student=<?php echo $ha_name; ?>"  class="btn btn-sm btn-info" ><i class="fa fa-list"></i>&nbsp; View Register on <?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></a>
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
