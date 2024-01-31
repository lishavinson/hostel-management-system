<?php
ob_start();
	include_once 'database.php';
	ob_clean();
	if((isset($_POST["ho_emailid"]) && !empty($_POST["ho_emailid"]))) {
		mailcheck(); 
	}
	function mailcheck(){
		$ho_emailid=$_POST["ho_emailid"];
		$ho_id=$_POST["ho_id"];
		if(database::RowExists("hostel_admission_register","lg_emailid='$ho_emailid' and ho_id!=$ho_id")){
			echo "exsists";
		}
		else{
			echo "notexsists";
		}
	}
?>