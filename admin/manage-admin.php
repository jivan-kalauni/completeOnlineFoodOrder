<?php include('partials/menu.php'); ?>

    <!-- main-content section -->
    <div class="main-content">
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <br>

        <?php

        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];    //displaying session message
            unset($_SESSION['add']);  //removing session message
        }

        if(isset($_SESSION['delete'])){
            echo ($_SESSION['delete']);
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo ($_SESSION['update']);
            unset($_SESSION['update']);
        }

        ?>
        <br>
        <br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM `tbl-admin`";
                    // execute the query
                    $result = mysqli_query($conn,$sql);

                    // check whether the query is executed or not
                    if($result==true){
                        // count rows to check whether we data in database or not
                        $count = mysqli_num_rows($result);
                        $sn =1;  //create a variable and assign the value 


                        // check no of rows if $rows>0
                        if($count>0){

                            // we have data in db
                            while($rows=mysqli_fetch_assoc($result)){
                                // using while loop to get data from db
                                $id = $rows['id'];
                                $full_name = $rows['full-name'];
                                $username = $rows['username'];

                                // display the value in table
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            // we have not data in db
                        }
                    }
                ?>
                
            </table>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>