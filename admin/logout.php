<?php
include('../config/constant.php');
// destroy the session 
session_destroy();  //unsets $_SESSION['user']
// redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>