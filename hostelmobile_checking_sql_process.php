<?php
	ob_start();
	include_once 'database.php';
	ob_clean();
	if((isset($_POST["ho_mobilenumber"]) && !empty($_POST["ho_mobilenumber"]))) {
		mailcheck(); 
	}
	function mailcheck(){
		$ho_mobilenumber=$_POST["ho_mobilenumber"];
		$ho_id=$_POST["ho_id"];
		if(database::RowExists("hostels","ho_mobilenumber='$ho_mobilenumber' and ho_id!=$ho_id")){
			echo "exsists";
		}
		else{
			echo "notexsists";
		}
	}
?>