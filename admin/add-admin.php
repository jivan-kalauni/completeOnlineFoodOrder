<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
        // checking the session is added or not
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="name" id="name" placeholder="Enter you name">
                    </td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td>
                        <input type="text" name="uname" id="uname" placeholder="Enter you user name">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" id="password" placeholder="Enter password">
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
</div>

<?php include('partials/footer.php'); ?>


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
    // echo "data inserted";
    // create a session variable to display message
    $_SESSION['add']= "Admin added successfully" ;
    // redirect page
    header("location:".SITEURL.'admin/manage-admin.php');
}else{
    // echo "failed to insert data";
    // create a session variable to display message
    $_SESSION['add']= "Failed to add admin" ;
    // redirect page
    header("location:".SITEURL.'admin/add-admin.php');
}

}

?>