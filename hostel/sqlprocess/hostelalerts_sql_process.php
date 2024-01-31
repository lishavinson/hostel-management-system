<?php
include_once('../../database.php');
$al_type=DataBase::RealEscape($_POST['al_type']);
$al_recivertype=DataBase::RealEscape($_POST['al_recivertype']);
$al_message=DataBase::RealEscape($_POST['al_message']);
$ho_id=$_COOKIE['hoa_id'];
$mode=$_POST['mode'];
if($mode=="add")
{
   $query="INSERT INTO `hostel_alerts`(`ho_id`, `al_type`, `al_date`, `al_message`, `al_recivertype`) 
   VALUES ('$ho_id','$al_type',NOW(),'$al_message','$al_recivertype')";	
   DataBase::ExecuteQuery($query);
   header("Location:../list_hostelalerts.php?msg=addsuccess");
}
?>