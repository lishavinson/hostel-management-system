<?php
ob_start();
	include_once '../../database.php';
	ob_clean();
	if((isset($_POST["ur_code"]) && !empty($_POST["ur_code"]))) {
		mailcheck(); 
	}
	function mailcheck(){
		$ur_code=$_POST["ur_code"];
		$ha_id=$_POST["ha_id"];
		if(database::RowExists("hostel_admission_register","ha_admissionnumber='$ur_code' and ha_id!=$ha_id")){
			echo "exsists";
		}
		else{
			echo "notexsists";
		}
	}
?>