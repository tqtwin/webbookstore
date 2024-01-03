<?php 
if($_POST['txtkey']){
    header("location:../index.php?keyvalue=".$_POST['txtkey']);
}
else
header("location:../index.php");
?>
