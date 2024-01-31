<?php
include_once('security_check_admin.php');
include_once('../database.php');
$ho_id=$_COOKIE['hoa_id'];

$query="SELECT `hb_id`, `ho_id`, `hb_month`, 
MONTH(hb_month) as month ,YEAR(hb_month) as year,
`hb_perdaymessfees`, `hb_totalstudents`, `hb_totalmessfees`, 
`hb_totalrent`, `hb_totalcollection`, 
`hb_duedate` FROM `hostel_bill_calculator`
WHERE hostel_bill_calculator.ho_id=$ho_id";
$bills=DataBase::SelectData($query);

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
							<strong class="card-title">Hostel Bills Report</strong>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th style="width:80px;" class="text-center">Month</th>
										<th style="width:80px;" class="text-right">Per Day Mess Fees</th>
										<th style="width:80px;" class="text-center">Total Students</th>
										<th style="width:150px;" class="text-right">Fees</th>
										<th style="width:80px;" class="text-right">Collected Fees</th>
										<th style="width:80px;" class="text-right">Pending Fees</th>
									 </tr>
									</thead>
									<tbody>
										<?php
										$total=0;
										$balance=0;
										while($row=mysqli_fetch_array($bills)){
										$hb_id=$row['hb_id'];
										$hb_month=$row['year'].'-'.$row['month'];
										 $total_collected=database::RowCount("select case when sum(hd_totalfees) is null then 0 
										 when sum(hd_totalfees)>0 then sum(hd_totalfees) end as totalfees from hostel_bil_details 
										where hb_id=$hb_id and hd_status='paid'");
										$total_balance=database::RowCount("select case when sum(hd_totalfees) is null then 0 
										 when sum(hd_totalfees)>0 then sum(hd_totalfees) end as totalfees from hostel_bil_details 
										where hb_id=$hb_id and hd_status='not paid'");
										$total+=$total_collected;
										$balance+=$total_balance;
										?>
										<tr>
											
											<td class="text-center">
											<h3 class="text-danger"><?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></h3>
											</td>
											<td class="text-right">
											<b>₹ <?php echo $row["hb_perdaymessfees"]; ?> /-</b>
											</td>
											<td class="text-center">
											<b><?php echo $row["hb_totalstudents"]; ?></b>
											</td>
											<td class="text-right">
											Total Mess Fees : <b>₹ <?php echo $row["hb_totalmessfees"]; ?> /-</b> <br/>
											Total Room Rent : <b>₹ <?php echo $row["hb_totalrent"]; ?> /-</b> <br/>
											Total Fees : <b>₹ <?php echo $row["hb_totalcollection"]; ?> /-</b><br/>
											</td>
											<td class="text-right">
											<h4 class="text-success">₹ <?php echo $total_collected; ?> /-</h4><br/>
												<a href="list_bill_collection.php?hb_id=<?php echo $hb_id; ?>&hb_month=<?php echo $hb_month; ?>" class="btn btn-sm btn-outline-success pull-right"><i class="fa fa-list"></i>&nbsp; Collection Report</a>
							
											</td>
											<td class="text-right">
											<h4 class="text-danger">₹ <?php echo $total_balance; ?> /-</h4><br/>
												<a href="list_bill_balance.php?hb_id=<?php echo $hb_id; ?>&hb_month=<?php echo $hb_month; ?>" class="btn btn-sm btn-outline-danger pull-right"><i class="fa fa-list"></i>&nbsp; Pending Report</a>
							
											</td>
											
											
											
										</tr>
										<?php
										} if(mysqli_num_rows($bills)>0){
										?>
										<tr class="bg-dark text-white">
											<td class="text-center">
											<b>Total<b/>
											</td>
											<td class="text-right">
											</td>
											<td class="text-center">
											</td>
											<td class="text-right">
											</td>
											<td class="text-right">
											<h4 >₹ <?php echo $total; ?> /-</h4>
											</td>
											<td class="text-right">
											<h4 >₹ <?php echo $balance; ?> /-</h4>
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
