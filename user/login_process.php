<?php
 include_once 'database.php';
$ad_username=$_POST['ad_username'];
$ad_password=$_POST['ad_password'];
$query="SELECT `lg_id`, `lg_type`, `lg_refferalid`,ha_name
FROM `login_details` 
inner join hostel_admission_register
on hostel_admission_register.ha_id=login_details.lg_refferalid
where lg_emailid='$ad_username' AND lg_password='$ad_password' 
and lg_type='parent'";
$data=database::SelectData($query);
if(mysqli_num_rows($data)!=0){
		$user = mysqli_fetch_array($data);
		setcookie("hoa_id", $user['lg_refferalid'], time() + (60*60*24*30));
		setcookie("hoa_username",$user['ha_name'],time() + (60*60*24*30));
		setcookie("hoa_usertype",$user['lg_type'],time() + (60*60*24*30));
	
		header('location:index.php');	
		
}
else{
	$query="SELECT `lg_id`, `lg_type`, `lg_refferalid`,ha_name
FROM `login_details` 
inner join hostel_admission_register
on hostel_admission_register.ha_id=login_details.lg_refferalid
where lg_emailid='$ad_username' AND lg_password='$ad_password' 
and lg_type='student'";
$data=database::SelectData($query);
if(mysqli_num_rows($data)!=0){
		$user = mysqli_fetch_array($data);
		setcookie("hoa_id", $user['lg_refferalid'], time() + (60*60*24*30));
		setcookie("hoa_username",$user['ha_name'],time() + (60*60*24*30));
		setcookie("hoa_usertype",$user['lg_type'],time() + (60*60*24*30));
	
		header('location:index.php');	
		
}
	else{
	header('location:login.php?status=failed');	
	}
}
	?>