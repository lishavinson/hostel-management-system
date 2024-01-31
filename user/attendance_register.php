<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$year=$_GET['year'];
		$month=$_GET['month'];
		$ha_id=$_COOKIE['hoa_id'];
		$attendance=database::SelectData("SELECT `at_id`, `ha_id`, 
		`at_date`, `at_status`,
		DATE_FORMAT(at_date, '%d/%M/%Y') as at_date1		FROM `attendance`
		WHERE ha_id=$ha_id and YEAR(at_date)=$year and  MONTH(at_date)=$month order by at_date asc");
		
	?>
	<body style="background-image:url('img/repeater.gif');">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation" style="min-height:60px !important;">
			<div class="container-fluid">
				<?php
					include_once 'navbar.php';
				?>
				<nav role="navigation" class="collapse navbar-collapse navbar-right" style="min-height:60px !important;">
					<ul class="navbar-nav nav">
					   <?php
							 $menuset='attendance';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<div class="panel panel-warning">
					<div class="panel-heading" style="position:relative;">
						<h4>ATTENDANCE REGISTER<br/> 
						( <?php echo $month;?> / <?php echo $year;?> )<br/>
						<a href="attendance.php"  class="btn btn-default btn-sm" style="position:absolute;right:0;top:0;"  >Back</a>
							
						</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							<tr >
								<th>
								Date
								</th>
								<th class="text-right">
								Status
								</th>
								
							</tr>
							<?php
							while($row=mysqli_fetch_array($attendance)){
							?>
							<tr>
								<td>
									<b style="font-size:20px;"><?php echo $row["at_date1"]; ?></b>
								</td>
							
								<td class="text-right">
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
							
						</table>
					</div>    
				</div>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
</html>