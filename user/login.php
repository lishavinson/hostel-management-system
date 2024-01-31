<html>
	<?php
		include_once('guest_security_check.php');
		include_once('database.php');	
		include_once 'parent_head.php';
	?>
	<body style="background-image:url('img/repeater.gif');">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<?php
					include_once 'navbar _guest.php';
				?>
				
			</div>
		</div>    
		<div class="container-fluid registration">
			<div class="col-sm-12 col-md-4 col-md-offset-4 text-center">
				<form action="login_process.php" method="POST" class="form-horizontal">
			
					<div class="panel panel-warning" style="margin-top:150px;">
						<div class="panel-heading">
							<h4> LOGIN</h4>
 						</div>
						<div class="panel-body">
							
							<div class="form-group text-left" style="position:relative;">
								<label class="text-center">Email Id </label>
								<span id="py_email_valid" style="font-weight:bold;color:red;position:absolute;right:15px;top:10px;display:none;font-size:10px;"></span>
								<input type="email" class="form-control" placeholder="Username(Email)" name="ad_username"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required id="ur_email"/>
							</div>
							<div class="form-group text-left">
								<label class="text-center">Password </label>
								<input type="password" class="form-control" placeholder="Password" name="ad_password" readonly onfocus="this.removeAttribute('readonly');"  required />
							</div>
						
						</div>
						<div class="panel-footer">
							<button type="submit" id="btn_save" class="btn btn-success btn-lg" ><span class="glyphicon glyphicon-save"></span> Login</button>
							
						</div>
					</div>
				
				</form>
			</div>
		</div>
		<?php include_once("footer.php"); ?>
	</body>
	<script>
			$(document).ready(function(){
			var typingTimer;   
			var doneTypingInterval = 800;
			$(document).on("input","#ur_email",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				$('#py_email_valid').css("display","inline");
				clearTimeout(typingTimer);	
				if ($('#ur_email').val){
					typingTimer = setTimeout(function(){
						email_validation();
					},doneTypingInterval);
				}
			});
			function email_validation(){
				var ur_email = $("#ur_email").val();
				if(ur_email.length >= 5 && validateEmail(ur_email) ){
					
								document.getElementById('py_email_valid').innerHTML="<span style='color:green'><i>"+ur_email+" </i> is valid email id !!!</span>";
								$("#btn_save").prop('disabled', false);
							}
			
				else{
					document.getElementById('py_email_valid').innerHTML="<span>please enter a valid email</span>";
					$("#btn_save").prop('disabled', true);			
				}
			}
			 function validateEmail($email) {
			  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  return emailReg.test( $email );
			}
			});
	</script>		
</html>