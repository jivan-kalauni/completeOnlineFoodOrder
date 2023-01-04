<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Catagory</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-catagory-found'])){
                echo $_SESSION['no-catagory-found'];
                unset($_SESSION['no-catagory-found']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        <br><br>
        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-catagory.php" class="btn-primary">Add Catagory</a>
        <br>
        <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Fetured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php

                    // query to get all catagories from db
                    $sql= "SELECT * FROM `tbl-catagory`";

                    // execute query
                    $result= mysqli_query($conn,$sql);

                    // count rows
                    $count = mysqli_num_rows($result);
                    // create serial no. variable
                    $sn=1;

                    // check whether we have data in db or not
                    if($count>0){
                        while($row =mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $imagename= $row['image-name'];
                            $featured= $row['featured'];
                            $active= $row['active'];

                            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php 
                                // check whether the image name is available or not
                                if($imagename!=""){
                                    // display the image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/catagory/<?php echo $imagename; ?>" alt="" width="100px">
                                        
                                    <?php
                                }else{
                                    // display the message
                                    echo "<div class='error'>Image not added</div>";
                                }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-catagory.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-catagory.php?id=<?php echo $id; ?>&image-name=<?php echo$imagename ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>


                            <?php
                        }
                    }else{
                        // we need to display message inside the table
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No catagory added</div></td>
                        </tr>

                        <?php
                    }


                ?>

            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>