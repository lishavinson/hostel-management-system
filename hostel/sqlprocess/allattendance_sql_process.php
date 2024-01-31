<?php
include_once('../../database.php');
$at_date=DataBase::RealEscape($_POST['at_date']);
$ho_id=$_COOKIE['hoa_id'];
 
 $query="SELECT `ha_id`, `ha_status`
 FROM `hostel_admission_register`
where ho_id='$ho_id' AND ha_status!='vacate'";
$data=database::SelectData($query);
 while($row=mysqli_fetch_array($data)){
	 $ha_id=$row['ha_id'];
	 $ha_status=$row['ha_status'];
	 if(!database::RowExists('attendance',"ha_id=$ha_id and at_date='$at_date'")){
	   if($ha_status=='in'){
			$query="INSERT INTO `attendance`( `ha_id`, `at_date`,
			`at_status`) VALUES  ('$ha_id','$at_date','present')";	
			DataBase::ExecuteQuery($query);
	   }else if($ha_status=='out'){
		   $query="INSERT INTO `attendance`( `ha_id`, `at_date`,
			`at_status`) VALUES  ('$ha_id','$at_date','absent')";	
			DataBase::ExecuteQuery($query);
	   }
	 }
	 
 }
 header("Location:../list_attendance.php?at_date=$at_date");

?>