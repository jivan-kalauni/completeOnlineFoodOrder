<?php

// include constants page
include("../config/constant.php");

if(isset($_GET['id']) AND isset($_GET['image-name'])){
    // process to delete
    // echo "process to delete";

    // 1. get id and image name
    $id= $_GET['id'];
    $imagename= $_GET['image-name'];

    // 2. remove image if available
    // check whether the image is available or not
    if($imagename != ""){
        // it has image and need to remove
        // get the image path
        $path = "../images/food/".$imagename;

        // remove image from folder
        $remove = unlink($path);

        // check whether the image is remove or not
        if($remove==false){
            // failed to remove image
            $_SESSION['upload']= "<div class='error'>Failed to remove image</div?";
            // redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
            // stop the process
            die();
        }


    }

    // 3. delete food from db
    $sql= "DELETE FROM `tbl-food` WHERE id=$id";
    // execute the query
    $result= mysqli_query($conn,$sql);

    // check whether the query is executed the query or not and set the session message
    // 4. redirect to manage food with message
    if($result==true){
        // food deleted
        $_SESSION['delete']= "<div class='success'>Food deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }else{
        // failed to delete food
        $_SESSION['delete']= "<div class='error'>Failed to delete food</div?";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    
}else{
    // redirect to manage food page
    // echo "redirect";
    $_SESSION['unauthorize']="<div class='error'>Unauthorized access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>