<?php
include_once('database.php');
$ho_name=DataBase::RealEscape($_POST['ho_name']);
$ho_institution=DataBase::RealEscape($_POST['ho_institution']);
$ho_address=DataBase::RealEscape($_POST['ho_address']);
$ho_landline=DataBase::RealEscape($_POST['ho_landline']);
$ho_mobilenumber=DataBase::RealEscape($_POST['ho_mobilenumber']);
$ho_emailid=DataBase::RealEscape($_POST['ho_emailid']);
$lg_password=DataBase::RealEscape($_POST['lg_password']);

   $query="INSERT INTO `hostels`(`ho_name`, `ho_institution`, `ho_address`,
   `ho_mobilenumber`, `ho_landline`, `ho_emailid`, `ho_verificationstatus`)
values   ('$ho_name','$ho_institution','$ho_address','$ho_mobilenumber'
,'$ho_landline','$ho_emailid','waiting')";	
  $ho_id= DataBase::ExecuteQueryReturnID($query);
  
     $query="INSERT INTO `login_details`(`lg_type`, `lg_refferalid`, 
	 `lg_emailid`, `lg_password`) VALUES('hostel','$ho_id',
	 '$ho_emailid','$lg_password')";	
   DataBase::ExecuteQuery($query);
   header("Location:index.php?msg=registrationsuccess");

?>