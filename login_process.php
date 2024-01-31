<?php
include_once('database.php');
$ad_username=$_POST['ad_username'];
$ad_password=$_POST['ad_password'];
$query="SELECT `lg_id`, `lg_type`, `lg_refferalid`,ho_name
FROM `login_details` 
inner join hostels
on hostels.ho_id=login_details.lg_refferalid
where lg_emailid='$ad_username' AND lg_password='$ad_password' 
and lg_type='hostel' and ho_verificationstatus='verificationsuccess'";
$data=database::SelectData($query);
if (mysqli_num_rows($data)!=0){
	$user=mysqli_fetch_array($data);
	setcookie("hoa_id",$user['lg_refferalid'],time() + (60*60*24*30));
	setcookie("hoa_username",$user['ho_name'],time() + (60*60*24*30));
	setcookie("hoa_usertype",$user['lg_type'],time() + (60*60*24*30));
	
	header('location:hostel/list_hostelrooms.php');
	
}
else
{	$query="SELECT `ad_id`, `ad_username`, `ad_password` FROM `administrator` 
	where ad_username='$ad_username' AND ad_password='$ad_password'";
	$data=database::SelectData($query);
	if (mysqli_num_rows($data)!=0){
		$user=mysqli_fetch_array($data);
		setcookie("hoa_id",0,time() + (60*60*24*30));
		setcookie("hoa_username","administrator",time() + (60*60*24*30));
		setcookie("hoa_usertype","admin",time() + (60*60*24*30));
		
		header('location:admin/list_hostels.php');
		
	}else{
		header('location:index.php?msg=failed');
	}
}
?>
	

	