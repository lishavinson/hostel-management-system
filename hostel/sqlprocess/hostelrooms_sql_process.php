<?php
include_once('../../database.php');
$hr_roomnumber=DataBase::RealEscape($_POST['hr_roomnumber']);
$hr_totalaccomadation=DataBase::RealEscape($_POST['hr_totalaccomadation']);
$hr_id=$_POST['hr_id'];
$ho_id=$_COOKIE['hoa_id'];
$mode=$_POST['mode'];
if($mode=="add")
{
   if(!DataBase::RowExists("hostel_rooms","hr_roomnumber='$hr_roomnumber' and ho_id=$ho_id")){
   $query="INSERT INTO `hostel_rooms`(`ho_id`, `hr_roomnumber`, `hr_totalaccomadation`) 
   VALUES ('$ho_id','$hr_roomnumber','$hr_totalaccomadation')";	
   DataBase::ExecuteQuery($query);
   header("Location:../manage_hostelrooms.php?msg=addsuccess");
   }else{
	header("Location:../manage_hostelrooms.php?msg=exists");	
	}
}
else if($mode=="edit")
{
	if(!DataBase::RowExists("hostel_rooms","hr_id!='$hr_id' and hr_roomnumber='$hr_roomnumber' and ho_id=$ho_id")){
	$query=("update hostel_rooms 
	set hr_roomnumber='$hr_roomnumber',
	hr_totalaccomadation='$hr_totalaccomadation' 
	where hr_id='$hr_id'");
	DataBase::ExecuteQuery($query);
   header("Location:../list_hostelrooms.php?msg=editsuccess");
   }else{
	header("Location:../manage_hostelrooms.php?msg=exists&hr_id=$hr_id&mode=edit");	
	}
}
else if($mode=="delete")
{
	$query=("delete from  hostel_rooms 
	where hr_id='$hr_id'");
	DataBase::ExecuteQuery($query);
	echo "delete from  hostel_rooms 
	where hr_id='$hr_id'";
    header("Location:../list_hostelrooms.php?msg=deletesuccess");
}
?>