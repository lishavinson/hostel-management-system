<?php
include_once('security_check_admin.php');
include_once('../database.php');
$hb_month=$_GET['hb_month'];
$hb_id=$_GET['hb_id'];
$ho_id=$_COOKIE['hoa_id'];
$temp=explode("-",$hb_month);

$query="SELECT `hd_id`, `hd_totalattendance`,
`hd_totalmessfees`, `hd_roomrent`, `hd_totalfees`, 
`hd_paymentdate`, `hd_paymentmethod`, `hd_status` ,
ha_name,ha_admissionnumber,ha_mobilenumber,ha_image,
rb_number,hr_roomnumber
FROM `hostel_bil_details` 
inner join hostel_bill_calculator 
on hostel_bill_calculator.hb_id=hostel_bil_details.hb_id
inner join hostel_admission_register 
on hostel_admission_register.ha_id=hostel_bil_details.ha_id
inner join room_beds 
on room_beds.rb_id=hostel_admission_register.rb_id
inner join hostel_rooms 
on room_beds.hr_id=hostel_rooms.hr_id
WHERE hostel_bill_calculator.hb_id=$hb_id";
$data=DataBase::SelectData($query);
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
							<strong class="card-title">Hostel Bills @ <span class="text-primary"><?php echo $hb_month; ?></span></strong>
							<a href="manage_bill.php" class="btn btn-sm btn-outline-primary pull-right"><i class="fa fa-angle-left"></i>&nbsp; Back</a>
							
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
									  <tr>
										<th style="width:80px;">&nbsp;</th>
										<th style="width:280px;">Student Details</th>
										<th style="width:80px;" class="text-center">Attendance</th>
										<th style="width:180px;">Fees</th>
										<th style="width:150px;" class="text-center">Status</th>
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
										if($row["hd_status"]=="not paid"){
											$color="bg-danger";
										}else{
											$color="bg-success";
										}
										
										?>
										<tr>
											<td><img src="<?php echo $imagepath; ?>" alt="<?php echo $row["ha_image"]; ?>" style="width:90px;height:100px;" class="img-thumbnail">
											</td>
											<td>
											Student Name : <b><?php echo $row["ha_name"]; ?></b><br/>
											Mobile Number : <?php echo $row["ha_mobilenumber"]; ?><br/>
											Room Number : <b><?php echo $row["hr_roomnumber"]; ?></b><br/>
											Bed Number : <?php echo $row["rb_number"]; ?>
											</td>
											<td class="text-center">
											<b><?php echo $row["hd_totalattendance"]; ?> Days</b>
											</td>
											<td>
											Mess Fees : ₹ <?php echo $row["hd_totalmessfees"]; ?> /-<br/>
											Room Rent : ₹ <?php echo $row["hd_roomrent"]; ?> /-<br/>
											Total : <b class="text-danger">₹ <?php echo $row["hd_totalfees"]; ?> /-</b>
											</td>
											<td class="text-center <?php echo $color; ?> text-white">
											<?php
											if($row["hd_status"]=="not paid"){
											?>
											<h3 class=""><?php echo $row["hd_status"]; ?></h3>
											<?php echo $row["hd_paymentdate"]; ?>
											<?php echo $row["hd_paymentmethod"]; ?>
											<?php
											}else{
											?>
											<h3 class=""><?php echo $row["hd_status"]; ?></h3>
											<b><?php echo $row["hd_paymentdate"]; ?><br/>
											<?php echo $row["hd_paymentmethod"]; ?></b>
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
