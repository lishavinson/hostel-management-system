<?php
include_once('../../database.php');
$ha_name=DataBase::RealEscape($_POST['ha_name']);
$ha_dob=DataBase::RealEscape($_POST['ha_dob']);
$ha_gender=DataBase::RealEscape($_POST['ha_gender']);
$ha_emailid=DataBase::RealEscape($_POST['ha_emailid']);
$ha_mobilenumber=DataBase::RealEscape($_POST['ha_mobilenumber']);
$ha_guardian=DataBase::RealEscape($_POST['ha_guardian']);
$ha_guardianrelation=DataBase::RealEscape($_POST['ha_guardianrelation']);
$ha_giardianemailid=DataBase::RealEscape($_POST['ha_giardianemailid']);
$ha_guardianmobilenumber=DataBase::RealEscape($_POST['ha_guardianmobilenumber']);
$ha_admissionnumber=DataBase::RealEscape($_POST['ha_admissionnumber']);
$ha_admissiondate=DataBase::RealEscape($_POST['ha_admissiondate']);
$hr_id=DataBase::RealEscape($_POST['hr_id']);
$rb_id=DataBase::RealEscape($_POST['rb_id']);
$ha_permenanetaddress=DataBase::RealEscape($_POST['ha_permenanetaddress']);
$ha_temeroryaddress=DataBase::RealEscape($_POST['ha_temeroryaddress']);
$ha_id=$_POST['ha_id'];
$ho_id=$_COOKIE['hoa_id'];
$mode=$_POST['mode'];
$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
$student_password = substr(str_shuffle($chars),6,6);
$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
$parent_password = substr(str_shuffle($chars),6,6);
if($mode=="add")
{
   $query="INSERT INTO `hostel_admission_register` 
   ( `ho_id`, `rb_id`, `ha_name`, `ha_dob`, `ha_gender`,
   `ha_admissionnumber`, `ha_emailid`, `ha_mobilenumber`, 
   `ha_guardian`, `ha_guardianrelation`, `ha_giardianemailid`,
   `ha_guardianmobilenumber`, `ha_permenanetaddress`,
   `ha_temeroryaddress`, `ha_admissiondate`,`ha_status`) 
   VALUES ('$ho_id','$rb_id','$ha_name'
   ,'$ha_dob','$ha_gender','$ha_admissionnumber'
   ,'$ha_emailid','$ha_mobilenumber','$ha_guardian'
   ,'$ha_guardianrelation','$ha_giardianemailid','$ha_guardianmobilenumber'
   ,'$ha_permenanetaddress','$ha_temeroryaddress','$ha_admissiondate'
   ,'in')";	
   $ha_id=DataBase::ExecuteQueryReturnID($query);
   
   $query=("update room_beds 
	set ha_id='$ha_id',rb_status='close' 
	where rb_id='$rb_id'");
	DataBase::ExecuteQuery($query);
	
	 $query="INSERT INTO `login_details`(`lg_type`, `lg_refferalid`, 
	 `lg_emailid`, `lg_password`) VALUES('student','$ha_id',
	 '$ha_emailid','$student_password')";	
   DataBase::ExecuteQuery($query);
   
    $query="INSERT INTO `login_details`(`lg_type`, `lg_refferalid`, 
	 `lg_emailid`, `lg_password`) VALUES('parent','$ha_id',
	 '$ha_giardianemailid','$parent_password')";	
   DataBase::ExecuteQuery($query);
   
   header("Location:../manage_admissionregister.php?msg=addsuccess");
}
else if($mode=="edit")
{
	$query=("update room_beds 
	set ha_id=NULL,rb_status='open' 
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	$query=("update hostel_admission_register 
	set rb_id='$rb_id',ha_name='$ha_name',ha_dob='$ha_dob',
	ha_gender='$ha_gender',ha_admissionnumber='$ha_admissionnumber',ha_emailid='$ha_emailid',
	ha_mobilenumber='$ha_mobilenumber',ha_guardian='$ha_guardian',ha_guardianrelation='$ha_guardianrelation',
	ha_giardianemailid='$ha_giardianemailid',ha_guardianmobilenumber='$ha_guardianmobilenumber',rb_id='$rb_id',
	ha_permenanetaddress='$ha_permenanetaddress',ha_temeroryaddress='$ha_temeroryaddress',ha_admissiondate='$ha_admissiondate'
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	$query=("update room_beds 
	set ha_id='$ha_id',rb_status='close' 
	where rb_id='$rb_id'");
	DataBase::ExecuteQuery($query);
	
   header("Location:../list_admissionregister.php?msg=editsuccess");
}
else if($mode=="delete")
{	$query=("update room_beds 
	set ha_id=NULL,rb_status='open' 
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	$query=("delete from  hostel_admission_register 
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
   header("Location:../list_admissionregister.php?msg=deletesuccess");
}
else if($mode=="photo")
{
	$ha_image=$_FILES["ha_image"]["name"];
	  $target_dir = "../../images/students/";
	$target_file = $target_dir . basename($ha_image);
	move_uploaded_file($_FILES['ha_image']['tmp_name'], $target_file);


	$query=("update hostel_admission_register 
	set ha_image='$ha_image' where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	   header("Location:../list_admissionregister.php?msg=photosuccess");

}
else if($mode=="note")
{
	$ha_notes=$_POST['ha_notes'];


	$query=("update hostel_admission_register 
	set ha_notes='$ha_notes' where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	   header("Location:../list_admissionregister.php?msg=notesuccess");

}
else if($mode=="vacate")
{
	$ha_vacatedate=$_POST['ha_vacatedate'];
	$rb_id=$_POST['rb_id'];

	$query=("update hostel_admission_register 
	set ha_vacatedate='$ha_vacatedate' ,ha_status='vacate'
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	$query=("update room_beds 
	set rb_status='open' where rb_id='$rb_id'");
	DataBase::ExecuteQuery($query);
	
	   header("Location:../list_admissionregister.php?msg=vacatesuccess");

}
else if($mode=="out")
{
	$ha_outreason=$_POST['ha_outreason'];


	$query=("update hostel_admission_register 
	set ha_status='out' ,ha_outreason='$ha_outreason',ha_outdate=NOW()
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	   header("Location:../list_inout.php?msg=outsuccess");

}
else if($mode=="in")
{
	
	$query=("update hostel_admission_register 
	set ha_status='in' ,ha_outreason='',ha_outdate=null
	where ha_id='$ha_id'");
	DataBase::ExecuteQuery($query);
	
	   header("Location:../list_inout.php?msg=insuccess");

}
?>