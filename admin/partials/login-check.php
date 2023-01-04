<?php
// authorization and access control
// check whether the user is logged in or not
if(!isset($_SESSION['user'])){
$_SESSION['no-login-message']= "<div class='error text-center'>Please login to access admin pannel</div>";
header('location:'.SITEURL.'admin/login.php');
}

?>