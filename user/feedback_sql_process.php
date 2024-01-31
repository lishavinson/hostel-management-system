<?php
include_once('database.php');
$hf_title=DataBase::RealEscape($_POST['hf_title']);
$hf_message=DataBase::RealEscape($_POST['hf_message']);
$hf_messageby=$_COOKIE['hoa_usertype'];
$ha_id=$_COOKIE['hoa_id'];

 
 $query=("INSERT INTO `hostel_feedbacks`(`ha_id`, `hf_messageby`,
 `hf_title`, `hf_message`, `hf_date`) 
 VALUES ('$ha_id','$hf_messageby','$hf_title','$hf_message',NOW() )");
	DataBase::ExecuteQuery($query);
	header("Location:feedback.php?msg=feedbacksuccess");

?>