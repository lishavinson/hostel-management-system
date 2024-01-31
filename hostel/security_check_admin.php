<?php
if (empty($_COOKIE["hoa_usertype"])){
	header('Location:../logout_process.php');
}
else if(!empty($_COOKIE["hoa_usertype"]) && $_COOKIE["hoa_usertype"] !="hostel"){
	header('Location:../logout_process.php');
}
?>
	
	
