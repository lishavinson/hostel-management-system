<?php
include_once('database.php');
$hd_id=DataBase::RealEscape($_POST['hd_id']);
 
 $query=("update hostel_bil_details 
	set hd_paymentmethod='online',hd_paymentdate=NOW(),hd_status='paid'
	where hd_id='$hd_id'");
	DataBase::ExecuteQuery($query);
	header("Location:index.php?msg=paymentsuccess");

?>