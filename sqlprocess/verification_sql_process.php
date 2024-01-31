<?php
include_once('../../database.php');
$ho_id=DataBase::RealEscape($_GET['ho_id']);
$mode=DataBase::RealEscape($_GET['mode']);
 
 $query=("update hostels 
	set ho_verificationstatus='$mode'
	where ho_id='$ho_id'");
	DataBase::ExecuteQuery($query);
	
    header("Location:../list_hostels.php?msg=verification");

?>