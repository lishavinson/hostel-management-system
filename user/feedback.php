<html>
	<?php
		include_once('admin_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
		
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
							 $menuset='feedback';
							 include_once 'parent_menu.php';
							 
					   ?>
					</ul>
				</nav>
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-6 COL-MD-OFFSET-3 text-center">
				<?php
					if(!empty($_GET['msg']) && $_GET['msg']=="feedbacksuccess"){
					?>
					<div class="alert alert-success text-center" role="alert">
					  Feedback Successfully Send
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<?php
					}
					?>
				<div class="panel panel-warning">
					<div class="panel-heading" style="position:relative;">
						<h4>FEEDBACK</h4>
					</div>
					<div class="panel-body display">
						<table class="table">
							
							<tr>
							<td>
							<form class="w-100 " action="feedback_sql_process.php" method="post" autocomplete="off" >
							<div class="form-group">
								<label >Title</label>
								<input type="text" class="form-control" name="hf_title" placeholder="title" required>
							</div>
							<div class="form-group">
								<label >Feedback</label>
								<textarea type="text" class="form-control" name="hf_message" placeholder="type here" rows="3" required></textarea>
							</div>
							<div class="form-group">
							
							<button type="submit" class="btn btn-success btn-lg btn-block" >Send Feedback</button>
							</div>
							</form>
							</td>
							</tr>
							
						</table>
					</div>    
				</div>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
	
</html>