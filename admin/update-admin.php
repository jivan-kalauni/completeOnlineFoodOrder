<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>
        <br>

        <?php

            // get the id of selected admin
                $id= $_GET['id'];
            // create sql query
            $sql="SELECT * FROM `tbl-admin` WHERE id=$id";

            // execute query
            $result= mysqli_query($conn,$sql);

            // check whether the query is executed or not
            if($result==true){
                $count= mysqli_num_rows($result);
                if($count==1){
                    // get the details
                    // echo "admin available";
                    $row= mysqli_fetch_assoc($result);

                    $fullname=$row['full-name'];
                    $username=$row['username'];

                }else{
                    // redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{

            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="name" id="name" placeholder="Enter you name" value="<?php echo $fullname; ?>">
                    </td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td>
                        <input type="text" name="uname" id="uname" placeholder="Enter you user name" value="<?php echo $username; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" id="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php

// check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // echo "button clicked";
    // get all the value from form
    $id =$_POST['id'];
    $fullname =$_POST['name'];
    $username =$_POST['uname'];

    // create sql query to update admin
    $sql = "UPDATE `tbl-admin` SET `full-name`='$fullname',`username`='$username' WHERE id=$id";

    // execute the query
    $result= mysqli_query($conn,$sql);

    // check whether the query is successfully executed or not
    if($result==true){
        $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['update']="<div class='error'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}

?>

<?php include('partials/footer.php'); ?>