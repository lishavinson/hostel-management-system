<?php
include_once('security_check_guest.php');
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once('title.php'); ?>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href=".assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content" style="max-width:800px;" >
                <div class="login-logo">
                    <a style='color:#fff;' href="index.php">
					<h1 CLASS="text-success">COLLEGE OSTELLO</h1>
                    <br/><h3>HOSTEL REGISTRATION</h3>
                    </a>
                </div>
                <div class="login-form">
                    <form action="register_process.php" method="post">
                       <div class="row">
						<div class="col-6">
						<div class="form-group">
                            <label>Hostel Name</label>
                            <input type="text" name="ho_name" class="form-control" placeholder="Hostel Name" required="true" />
                        </div>
						<div class="form-group">
                            <label>Institution Name</label>
                            <input type="text" name="ho_institution" class="form-control" placeholder="Institution Name" required="true" />
                        </div>
						<div class="form-group">
                            <label>Hostel Address</label>
                            <textarea type="text" name="ho_address" class="form-control" placeholder="Hostel Address" rows="3" required="true" ></textarea>
                        </div>
						<div class="form-group">
                            <label>Landline Number</label>
                            <input type="text" name="ho_landline" class="form-control" placeholder="Landline Number" required="true" />
                        </div>
						</div>
						<div class="col-6">
						
						<div class="form-group" style="position:relative;">
                            <label>Mobile Number</label>
                            <input type="text" name="ho_mobilenumber" class="form-control" placeholder="Mobile Number" required="true" id="ur_mobile" />
							<span id="py_ur_mobile" style="font-weight:bold;color:red;position:absolute;right:0px;bottom:-20px;display:none;font-size:10px;"></span>
						</div>
						<div class="form-group" style="position:relative;">
                            <label>Email ID</label>
                            <input type="email" name="ho_emailid" class="form-control" placeholder="Email" required="true" id="ur_email" />
                            <span id="py_email_valid" style="font-weight:bold;color:red;position:absolute;right:0px;bottom:-20px;display:none;font-size:10px;"></span>
						</div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password"  name="lg_password" class="form-control" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');"  required />
                        </div>
                        <button id="btn_save"  type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Register Hostel</button>
						<a href="index.php"  type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30 mt-2">Hostel Sign In</a>
						</div>
						</div>
					</form>
					<?php
						if(!empty($_GET['msg'])&& $_GET['msg']=="forogotsuccess" ){
					?>
					<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
						<span class="badge badge-pill badge-primary">Success</span>
							Password Successfully mailed to your registered email id
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php
					}
					else if(!empty($_GET['msg'])&& $_GET['msg']=="forogotfail" ){
					?>
					<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
						<span class="badge badge-pill badge-danger">Failed</span>
							Internal Mail Server Issue, Please Try again after some time
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php
					}
					else if(!empty($_GET['msg'])&& $_GET['msg']=="failed" ){
					?>	
					<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
						<span class="badge badge-pill badge-danger">Failed</span>
							Invalid Login Details
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php
					}else if(!empty($_GET['msg'])&& $_GET['msg']=="failed" ){
					?>
					<?php
					}
					?>					
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-1.11.3.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script>
			$(document).ready(function(){
			var typingTimer;   
			var doneTypingInterval = 800;
            window.emailflag=false;
            window.mobileflag=false;
            $(document).on("input","#ur_email",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				
				clearTimeout(typingTimer);	
				if ($('#ur_email').val){
					typingTimer = setTimeout(function(){
                    email_validation(); 
                    },doneTypingInterval);
				}
			});
            $(document).on("input","#ur_mobile",function(e) {
				e.preventDefault();
				$("#btn_save").prop('disabled', true);
				clearTimeout(typingTimer);	
				if ($('#ur_mobile').val){
					typingTimer = setTimeout(function(){
                        mobile_validation();
                   
                    },doneTypingInterval);
				}
			});
			function email_validation(){
                $('#py_email_valid').css("display","inline");
				var ur_email = $("#ur_email").val();
               if(ur_email.length >= 5 && validateEmail(ur_email) ){
					document.getElementById('py_email_valid').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "hostelemail_checking_sql_process.php",  
						data: "ho_emailid="+ur_email+"&ho_id=0",
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_email_valid').innerHTML="<span><i>"+ur_email+" </i> is already used</span>";
							    window.emailflag=false;
                        	}
							else{
								document.getElementById('py_email_valid').innerHTML="<span style='color:green'><i>"+ur_email+" </i> is available</span>";
								window.emailflag=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_email_valid').innerHTML="<span>please enter a valid email</span>";
			        window.emailflag=false;
                    finalvalidate();			
				}
               
            }
            function mobile_validation(){
                $('#py_ur_mobile').css("display","inline");
				var ur_mobile = $("#ur_mobile").val();
                if(ur_mobile.length >= 10 && validateMobile(ur_mobile) ){
					document.getElementById('py_ur_mobile').innerHTML="<span style='color:orange;'>checking availability...</span>";
					$.ajax({
						type: "POST",  
						url: "hostelmobile_checking_sql_process.php",  
						data: "ho_mobilenumber="+ur_mobile+"&ho_id=0",
						success: function(msg){	
						
							if(msg=="exsists"){
								document.getElementById('py_ur_mobile').innerHTML="<span><i>"+ur_mobile+" </i> is already used</span>";
							    window.mobileflag=false;
                        	}
							else{
								document.getElementById('py_ur_mobile').innerHTML="<span style='color:green'><i>"+ur_mobile+" </i> is available</span>";
								window.mobileflag=true;
                           }
                            finalvalidate();
                 		}				
					});
				}
				else{
					document.getElementById('py_ur_mobile').innerHTML="<span>please enter a valid mobile number</span>";
			        window.mobileflag=false;
                    finalvalidate();			
				}
               
            }
            function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
            }
            function validateMobile($mobile) {
            var mobileReg = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
            return mobileReg.test( $mobile );
            }
            function finalvalidate(){
                if(window.emailflag==true && window.mobileflag==true ) {
                    $("#btn_save").prop('disabled', false);
                }
                else{
                    $("#btn_save").prop('disabled', true);  
                }

            }
        });
		</script>
</body>
</html>
