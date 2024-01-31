<?php
	ob_start();
	include_once '../../database.php';
	ob_clean();
	if((isset($_POST["ur_mobile"]) && !empty($_POST["ur_mobile"]))) {
		mailcheck(); 
	}
	function mailcheck(){
		$ur_mobile=$_POST["ur_mobile"];
		$ha_id=$_POST["ha_id"];
		if(database::RowExists("hostel_admission_register","ha_guardianmobilenumber='$ur_mobile' and ha_id!=$ha_id")){
			echo "exsists";
		}
		else{
			echo "notexsists";
		}
	}
?>