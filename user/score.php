<html>
	<?php
		include_once('anganwadi_parent_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		$data=DataBase::SelectData("SELECT `st_id`, `aw_id`, `st_doj`, `st_fathername`, `st_mothername`, `st_dateoftc`, `st_mobilenumber`, 
		`st_emailid`, `st_passowrd`, `st_status`,upper(hd_membername) as hd_membername FROM `students` inner join
		housedetails on housedetails.hd_id=students.hd_id where st_id=".$_COOKIE['aw_rfid']);
		$studentdetails=mysqli_fetch_array($data);
		$selectquery="SELECT `wq_id`, `wq_question` FROM `workbook_questionnaire` order by wq_id";
		$questions=DataBase::SelectData($selectquery);
	?>
	<body style="background-image:url('../img/repeater.gif');">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<?php
					include_once 'navbar.php';
				?>
				<nav role="navigation" class="collapse navbar-collapse navbar-right">
					<ul class="navbar-nav nav">
					   <?php
							 $menuset='workbook';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<?php
			$data=DataBase::SelectData("SELECT `sw_id`, `aw_id`, `st_id`, `sw_date`, `sw_q1`, `sw_q2`,
			`sw_q3`, `sw_q4`, `sw_q5`, `sw_score`  FROM `student_workbook` where sw_id=".$_GET['sw_id']." order by st_id desc" );
			$score=mysqli_fetch_array($data);
			?>	
			<div class="col-sm-12 col-md-8 col-md-offset-2 text-center" style=" margin-bottom:20px;margin-top:80px;" >
				<div class="panel panel-success">
					<div class="panel-heading">
						<a href="index.php" class="btn btn-default btn-sn pull-left" ><span class="glyphicon glyphicon-chevron-left" style="display:inline-block"></span> back</a>
						<p><span style='color:red;font-weight:bold'><?php echo $score['sw_date']; ?></span> </p>
					</div>
					<div class="panel-body" style=" padding-left:0px;padding-right:0px;margin-bottom:0px;padding-bottom:0px;padding-top:0px;">
						<table class="table" style=" padding-left:0px;padding-right:0px;margin-bottom:0px;padding-bottom:0px;padding-top:0px;">
							<?php
							$count=1;
								while($row=mysqli_fetch_array($questions)){
							?>
							<tr style="padding:0px;">
								<th style="padding:0px;position:relative;" colspan="3" class="text-left">
									<a class="list-group-item" style="border-left:none;border-right:none;border-bottom:none;border-top:none;font-size:10px;"  ><?php echo $row['wq_question']  ?></a>
									<span style="right:5px;top:5px;position:absolute;" ><?php echo $score['sw_q'.$count]; ?> / 5</span>
								</th>
							</tr>
							<?php
							$count++;
								}
							?>
							<tr style="padding:0px;">
								<th style="padding:0px;position:relative;border-top:3px solid black;" colspan="3" class="text-left">
									<a class="list-group-item" style="border-left:none;border-right:none;border-bottom:none;border-top:none;font-size:12px;"  ><b style="color:red;">TOTAL SCORE OUT OF 25</b></a>
									<span style="right:5px;top:5px;position:absolute;color:red;" ><?php echo $score['sw_score']; ?> / 25</span>
								</th>
							</tr>
						</table>
					</div>  
				</div>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
</html>