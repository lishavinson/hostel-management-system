<?php
if(!empty($_COOKIE["hoa_usertype"]) && 
($_COOKIE["hoa_usertype"]=='parent' || $_COOKIE["hoa_usertype"]=='student' )  )
{
header('location:index.php');	
}
?>