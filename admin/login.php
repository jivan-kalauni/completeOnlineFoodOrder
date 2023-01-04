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
    <div class="login">
        
        <h1 class="text-center">Login</h1>
        <br>
        <br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br>
        <br>
        <!-- login form -->
        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="uname" id="uname" placeholder="Enter user name">
            <br>
            <br>
            Password:
            <input type="password" name="password" id="password" placeholder="Enter password">
            <br>
            <br>
            <input type="submit" name="submit" id="submit" value="Login" class="btn-primary">
            <br>
            <br>
        </form>
        <p class="text-center">Created By- Jivan Kalauni</p>
    </div>
</body>
</html>

<?php

// check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // process for login
    $username=$_POST['uname'];
    $password=md5($_POST['password']);

    // sql to check whether the username and password exists
    $sql = "SELECT * FROM `tbl-admin` WHERE username='$username' AND password='$password'";
    // execute the query
    $result = mysqli_query($conn,$sql);

    // count rows to check whether the user exist or not
    $count = mysqli_num_rows($result);
    if($count==1){
        // user available
        $_SESSION['login']= "<div class='success text-center'>Login successful</div>";
        $_SESSION['user']= $username;  //to check whether the user is loged in or not and logout will unset it
        // redirect to home page or dashbord
        header('location:'.SITEURL.'admin/');
    }else{
        // user unavailable
        $_SESSION['login']= "<div class='error text-center'>Login failed</div>";
        // redirect to home page or dashbord
        header('location:'.SITEURL.'admin/login.php');
    }
}

?>

