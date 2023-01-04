<?php 

// include constant.php
include('../config/constant.php');

//1. get the ID of admin to be deleted
$id= $_GET['id'];
// 2. create sql to delete admin
$sql= "DELETE FROM `tbl-admin` WHERE id=$id";

// execute the query
$result = mysqli_query($conn,$sql);

// check whether the query is exdcuted or not
if($result==true){
    // echo "admin deleted";
    // create session variable to display message
    $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    // echo "failed to delete admin";
    $_SESSION['delete']= "<div class='error'>Failed to delete admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
// 3. redirect to manage admin page with message

?>