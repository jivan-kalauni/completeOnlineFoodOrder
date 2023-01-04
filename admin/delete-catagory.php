<?php 

// include constant.php
include('../config/constant.php');
// check whether the id and and imagename value is set or not
if(isset($_GET['id']) AND isset($_GET['image-name'])){
    // get the value and delete
    // echo "get value and delete";
    $id=$_GET['id'];
    $imagename=$_GET['image-name'];

    // remove the physical image file if available
    if($imagename !=""){
        $path= "../images/catagory/".$imagename;
        $remove = unlink($path);

        if($remove==false){
            // set the session message
            $_SESSION['remove']="<div class='error'>Failed to remove catagory image</div>";
            // redirect to manage catagory page
            header('location:'.SITEURL.'admin/manage-catagory.php');
            // stop the process
            die(); 
        }
    }

    // delete data from db

    $sql = "DELETE FROM `tbl-catagory` WHERE id=$id";

    $result= mysqli_query($conn,$sql);

    if($result==true){
        // set success message and redirect 
        $_SESSION['delete']= "<div class='success'>Catagory deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-catagory.php');
    }else{
        // set failed message and redirect
        $_SESSION['delete']= "<div class='error'>Failed to delete catagory</div>";
        header('location:'.SITEURL.'admin/manage-catagory.php');
    }

    
}else{
    // redirect to manage catagory page
    header('location:'.SITEURL.'admin/manage-catagory.php');
}


?>