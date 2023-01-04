<?php

// start session
session_start();

// create a constant to store none repeating value
define('SITEURL','http://localhost/online-food-order/');

$conn = new mysqli('localhost', 'root','','food-order');

if($conn){
    // echo "connection successfull";
    
}else{
    die(mysqli_error($conn));
}

?>