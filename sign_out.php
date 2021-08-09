<?php
session_start();
$_SESSION['user_id'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_full_name'] = null;

session_destroy();

if(isset($_SESSION['user_id'])){
    echo "not signed out...";
}else header("Location: login-v2.php");


?>

