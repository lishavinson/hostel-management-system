<?php
if (!empty($_COOKIE["hoa_usertype"]) && $_COOKIE["hoa_usertype"] =='hostel')
{
	header('location:hostel/list_hostelrooms.php');
}
?>
	
	
