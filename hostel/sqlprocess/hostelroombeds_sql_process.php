<?php
include_once('../../database.php');
$rb_number=DataBase::RealEscape($_POST['rb_number']);
$rb_rent=DataBase::RealEscape($_POST['rb_rent']);
$hr_id=$_POST['hr_id'];
$rb_id=$_POST['rb_id'];
$ho_id=$_COOKIE['hoa_id'];
$mode=$_POST['mode'];
if($mode=="add")
{
   if(!DataBase::RowExists("room_beds","rb_number='$rb_number' and ho_id=$ho_id")){
   $query="INSERT INTO `room_beds`( `ho_id`, `hr_id`, `rb_number`, `rb_rent`, `rb_status`)
   VALUES ('$ho_id','$hr_id','$rb_number','$rb_rent','open')";	
   DataBase::ExecuteQuery($query);
   header("Location:../manage_hostelroombeds.php?hr_id=$hr_id&msg=addsuccess");
	}else{
	header("Location:../manage_hostelroombeds.php?hr_id=$hr_id&msg=exists");	
	}
}
else if($mode=="edit")
{ 
 if(!DataBase::RowExists("room_beds","rb_number='$rb_number' and ho_id=$ho_id and  rb_id!='$rb_id'")){
    $query=("update room_beds 
	set rb_number='$rb_number',rb_rent='$rb_rent' 
	where rb_id='$rb_id'");
	DataBase::ExecuteQuery($query);
   header("Location:../list_hostelroombeds_step_2.php?hr_id=$hr_id&msg=editsuccess");
	}else{
	header("Location:../manage_hostelroombeds.php?hr_id=$hr_id&rb_id=$rb_id&msg=exists&mode=edit");	
	}
}
else if($mode=="delete")
{
	$query=("delete from  room_beds 
	where rb_id='$rb_id'");
	DataBase::ExecuteQuery($query);
   header("Location:../list_hostelroombeds_step_2.php?hr_id=$hr_id&msg=deletesuccess");
}
?>