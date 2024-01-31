<?php
 include_once('../../database.php');
$hr_id=$_POST['hr_id'];
$semesters="SELECT `rb_id`, `ho_id`, `hr_id`, `rb_number`, 
`ha_id`, `rb_rent`, `rb_status` FROM `room_beds` 
where hr_id='$hr_id' and rb_status='open'";
$data=DataBase::SelectData($semesters);
 if(mysqli_num_rows($data)>0){
?>
<option value="">Select Bed Number / Name</option>
<?php
 while($rows=mysqli_fetch_array($data)){

?>

<option value="<?php echo $rows['rb_id']; ?>"><?php echo $rows['rb_number']; ?> ( Rent : <span style="color:red;">₹ <?php echo $rows['rb_rent'];?> /-)</span></option>
 
<?php
}
}
else if(mysqli_num_rows($data)==0){
?>
<option value="">There is no bed available</option>
<?php
}
?>