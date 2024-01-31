<?php
setcookie("hoa_id","",time() - (60*60*24*30));
setcookie("hoa_usertype","",time() - (60*60*24*30));
header('location:index.php');
?>