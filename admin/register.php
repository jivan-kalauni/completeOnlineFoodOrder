<?php include('../config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-food-order</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="reg-form">
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" id="name" placeholder="Enter your name" require>
                    </td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="uname" id="uname" placeholder="Enter your user name" require>
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" id="password" placeholder="Enter password" max="8" min="4" require>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

<?php

// process the value from form and save in database
// check whether the butto is clicked or not
if(isset($_POST['submit'])){
    // echo "button clicked";
    $fullname= $_POST['name'];
    $username= $_POST['uname'];
    $password= md5($_POST['password']);  //password encryption

    // sql query to save data
    $sql= "INSERT INTO `tbl-admin`(`full-name`, `username`, `password`) VALUES ('$fullname','$username','$password');";
    
    // executing query and saving data
    $result= mysqli_query($conn,$sql) or die(mysqli_error($conn));

    // check whether the data is inserted or not
if($result==true){
    // redirect page
    header("location:".SITEURL.'admin/login.php');
}else{
    // echo "failed to insert data";
    // create a session variable to display message
    $_SESSION['add']= "Failed to add admin" ;
    // redirect page
    header("location:".SITEURL.'admin/add-admin.php');
}

}

?>