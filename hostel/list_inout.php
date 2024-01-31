<?php
include_once('security_check_admin.php');
include_once('../database.php');
$ho_id=$_COOKIE['hoa_id'];
$query="SELECT hostel_admission_register.ha_id, 

`ha_name`, `ha_admissionnumber`,ha_outreason,
DATE_FORMAT(ha_outdate, '%d/%M/%Y , %h:%i %p') as ha_outdate,
 `ha_status` FROM `hostel_admission_register` 
 where hostel_admission_register.ho_id=$ho_id and ha_status!='vacate'";
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
						if(!empty($_GET['msg'])&&($_GET['msg']=="outsuccess"))
						{
						?>
						<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Student Successfully GO OUT From the Hostel
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}else if(!empty($_GET['msg'])&&($_GET['msg']=="insuccess")){
						?>
						 <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
							<span class="badge badge-pill badge-primary">Success</span>
								Student Successfully COME IN to the Hostel
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						}
                        ?>
						
						
						<div class="card">
							<div class="card-header">
								<strong class="card-title"><th>IN / OUT Register</th></strong>
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
										?>
										<tr>
											<td>
											<div class="card mb-0">
												<div class="card-header">
													<?php
													if($row["ha_status"]=="in" ){
													?>
													<strong class="card-title text-success"><i class="fa fa-level-down"></i> &nbsp;&nbsp;<?php echo $row["ha_name"]; ?> [ <?php echo $row["ha_admissionnumber"]; ?> ]</strong> 
													<a href="#" data-toggle="modal" data-target="#outModal" data-whatever="<?php echo $row["ha_id"]; ?>=<?php echo $row["ha_name"]; ?>" class="btn btn-danger btn-sm pull-right ">
													<i class="fa fa-level-up"></i>&nbsp; GO OUT
													</a>
													<?php }else{
													?>
													<strong class="card-title text-danger"><i class="fa fa-level-up"></i> &nbsp;&nbsp;<?php echo $row["ha_name"]; ?> [ <?php echo $row["ha_admissionnumber"]; ?> ]  <span class="text-dark">reason to go out : <?php echo $row["ha_outreason"]; ?> ( <?php echo $row["ha_outdate"]; ?> )</span> </strong> 
													<a href="#" data-toggle="modal" data-target="#inModal" data-whatever="<?php echo $row["ha_id"]; ?>=<?php echo $row["ha_name"]; ?>" class="btn btn-success btn-sm pull-right ">
													<i class="fa fa-level-down"></i>&nbsp; COME IN
													</a>
													<?php
													}
													?>
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
	
	
	
	<div class="modal fade" id="outModal" tabindex="-1" aria-labelledby="inoutModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" enctype="multipart/form-data" >
		  <div class="modal-header">
			<h5 class="modal-title" id="outModalLabel">GO OUT</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label >Reason to GO OUT</label>
				<textarea name="ha_outreason" placeholder="type here" class="form-control" required></textarea>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-danger">Confirm GO OUT</button>
			<input name="ha_id" id="ha_id_2" value="" type="hidden" required/>
			<input name="mode" value="out" type="hidden" required/>
											
		 </div>
		  </form>
		</div>
	  </div>
	</div>
	<div class="modal fade" id="inModal" tabindex="-1" aria-labelledby="inModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <form action="sqlprocess/admissionregister_sql_process.php" method="post" autocomplete="off" enctype="multipart/form-data" >
		  <div class="modal-header">
			<h5 class="modal-title" id="inModalLabel">COME IN</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  
		  <div class="modal-footer">
			<button type="submit" class="btn btn-success">COME IN</button>
			<input name="ha_id" id="ha_id_1" value="" type="hidden" required/>
			<input name="mode" value="in" type="hidden" required/>
											
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
		$('#outModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); 
		  var recipient = button.data('whatever'); 
		  var res = recipient.split("=");
		 var modal = $(this);
		  modal.find('.modal-title').text('Confirm GO OUT of ' + res[1]);
		 modal.find('#ha_id_2').val(res[0]);
		});
		$('#inModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); 
		  var recipient = button.data('whatever'); 
		  var res = recipient.split("=");
		 var modal = $(this);
		  modal.find('.modal-title').text('Confirm COME IN ' + res[1]);
		 modal.find('#ha_id_1').val(res[0]);
		});
		
    </script>


</body>
</html>
