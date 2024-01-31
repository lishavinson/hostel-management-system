<?php
ob_start();
	include_once '../../database.php';
	ob_clean();
	if((isset($_POST["ur_email"]) && !empty($_POST["ur_email"]))) {
		mailcheck(); 
	}
	function mailcheck(){
		$ur_email=$_POST["ur_email"];
		$ha_id=$_POST["ha_id"];
		if(database::RowExists("hostel_admission_register","ha_giardianemailid='$ha_giardianemailid' and ha_id!=$ha_id")){
			echo "exsists";
		}
		else{
			echo "notexsists";
		}
	}
?>