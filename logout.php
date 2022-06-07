<?php
session_start();
if(isset($_SESSION['user_id'])){
    unser($_SESSION['user_id']);
}
header("location:index.php");
die;
?>
