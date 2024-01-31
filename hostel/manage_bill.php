<?php
include_once('security_check_admin.php');
include_once('../database.php');
$hb_month= date('Y-m', strtotime('last month')); 
$temp=explode("-",$hb_month);
$ho_id=$_COOKIE['hoa_id'];

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
                     <div class="col-md-6 offset-md-3">
						<div class="card">
							<form action="sqlprocess/messbill_sql_process.php" method="post" autocomplete="off" >
							 <div class="card-header">
                                    <strong class="card-title">Hostel Bill @ <span class="text-danger"><?php echo $_COOKIE['hoa_username']; ?></span></strong>
                                </div>
                                <div class="card-body">
									<div class="form-group">
										<label class="control-label mb-1">Mess Fees / Day</label>
										<input name="hb_perdaymessfees" min="1" type="number" placeholder="mess fees per day" class="form-control" required />
									</div>
                                    <div class="form-group">
										<label class="control-label mb-1">You can Only Prepare Bill of the Previous Month</label>
										<input name="hb_month" value="<?php echo date('Y-m', strtotime('last month')); ?>" min="<?php echo date('Y-m', strtotime('last month')); ?>" max="<?php echo date('Y-m', strtotime('last month')); ?>" type="month" class="form-control" required />
									</div>
									<div class="form-group">
										<label class="control-label mb-1">Due Date</label>
										<input name="hb_duedate" min="<?php echo date('Y-m-d', strtotime('+15 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+30 day')); ?>" value="<?php echo date('Y-m-d', strtotime('+15 day')); ?>" type="date" class="form-control" required/>
									</div>
									<?php
									if(!database::RowExists("hostel_bill_calculator","ho_id=$ho_id and MONTH(hb_month)=".$temp[1]." AND YEAR(hb_month)=".$temp[0])){
									
									
									?>
									<button type="submit" class="btn btn-md btn-info btn-block mb-3">
                                    <i class="fa fa-check"></i>&nbsp;Generate Hostel Bill @ <?php echo date('Y-M', strtotime('last month')); ?>
                                    </button>
									<?php
									}else{
									$query="SELECT hb_id, `ho_id` FROM `hostel_bill_calculator`
									where ho_id=$ho_id and MONTH(hb_month)=".$temp[1]." AND YEAR(hb_month)=".$temp[0];
									$bill=database::SelectData($query);
									$row=mysqli_fetch_array($bill);
									?>
									<a href="list_bill.php?hb_id=<?php echo $row["hb_id"]; ?>&hb_month=<?php echo $hb_month; ?>" class="btn btn-md btn-danger btn-block mb-3">
                                    <i class="fa fa-check"></i>&nbsp;Hostel Bill for  <?php echo date('Y-M', strtotime('last month')); ?> had Already Genrated<b/>
									Click To View the Bills
                                    </a>
									<?php
									}
									?>
                                </div>
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
        } );
    </script>
    
</body>
</html>
