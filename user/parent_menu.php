<style>
li{
	height:60px;
}
li a{
	height:60px;
	font-size:16px !important;
	padding-right:0px;
	padding-left:0px;
	padding:20px 20px !important;
}
</style>

<?php
if($menuset=='pendingbill'){
?>

	<li class="active"><a  href="index.php">PENDING BILL</a></li>
	<li ><a  href="attendance.php">ATTENDANCE</a></li>
	<li ><a  href="payments.php">PAYMENT REPORTS</a></li>
	<li ><a  href="profile.php">PROFILE</a></li>
	<li ><a  href="feedback.php">FEEDBACK</a></li>
	<li ><a  href="logout_process.php">LOGOUT</a></li>
	
<?php
}else if($menuset=='profile'){
?>
	<li ><a  href="index.php">PENDING BILL</a></li>
	<li ><a  href="attendance.php">ATTENDANCE</a></li>
	<li ><a  href="payments.php">PAYMENT REPORTS</a></li>
	<li class="active"><a  href="profile.php">PROFILE</a></li>
	<li ><a  href="feedback.php">FEEDBACK</a></li>
	<li ><a  href="logout_process.php">LOGOUT</a></li>
<?php
}else if($menuset=='payments'){
?>
	<li ><a  href="index.php">PENDING BILL</a></li>
	<li ><a  href="attendance.php">ATTENDANCE</a></li>
	<li class="active"  ><a  href="payments.php">PAYMENT REPORTS</a></li>
	<li ><a  href="profile.php">PROFILE</a></li>
	<li ><a  href="feedback.php">FEEDBACK</a></li>
	<li ><a  href="logout_process.php">LOGOUT</a></li>
<?php
}else if($menuset=='attendance'){
?>
	<li ><a  href="index.php">PENDING BILL</a></li>
	<li class="active"><a  href="attendance.php">ATTENDANCE</a></li>
	<li ><a  href="payments.php">PAYMENT REPORTS</a></li>
	<li ><a  href="profile.php">PROFILE</a></li>
	<li ><a  href="feedback.php">FEEDBACK</a></li>
	<li ><a  href="logout_process.php">LOGOUT</a></li>
<?php
}else if($menuset=='feedback'){
?>
<li ><a  href="index.php">PENDING BILL</a></li>
	<li><a  href="attendance.php">ATTENDANCE</a></li>
	<li ><a  href="payments.php">PAYMENT REPORTS</a></li>
	<li ><a  href="profile.php">PROFILE</a></li>
	<li  class="active" ><a  href="feedback.php">FEEDBACK</a></li>
	<li ><a  href="logout_process.php">LOGOUT</a></li>
<?php
}
?>
