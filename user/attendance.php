<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$ha_id=$_COOKIE['hoa_id'];
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
					<div class="panel-heading">
						<h4>ATTENDANCE</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							<tr >
								<th>
								Month
								</th>
								<th class="text-right">
								Attendance
								</th>
								
							</tr>
							<?php
							while($row=mysqli_fetch_array($total_present)){
								$row1=mysqli_fetch_array($total_absent);
								
							?>
							<tr>
								<td>
									<b style="font-size:20px;"><?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></b>
								</td>
							
								<td class="text-right">
								Total Present: <b class="text-success"><?php if(!empty($row["total"])) { echo $row["total"]; } else{ echo "0" ;} ?></b><br/>
								Total Absent : <b class="text-danger"><?php  if(!empty($row1["total"])) { echo $row1["total"];} else{ echo "0" ;}; ?>
								</td>
								
							</tr>
							<tr>
							<td colspan="2" class="text-center"> 
							<a href="attendance_register.php?year=<?php echo $row["year"]; ?>&month=<?php echo $row["month"]; ?>"  class="btn btn-success btn-lg" >View Register on <?php echo $row["month"]; ?> / <?php echo $row["year"]; ?></a>
							</td>
							</tr>
							<?php
							}
							if(mysqli_num_rows($total_present)==0)
							{
							?>
							<tr>
								<td colspan="3">
									<span  STYLE="COLOR:RED;">
									NO ATTENDANCE RECORDS
									</span>
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