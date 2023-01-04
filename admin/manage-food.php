<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorize'])){
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            // if(isset($_SESSION['update-food'])){
            //     echo $_SESSION['update-food'];
            //     unset($_SESSION['update-food']);
            // }
            if(isset($_SESSION['remove-failed'])){
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
            
        ?>
        <br><br>
        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>

        
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php

                    // create sql to get all the food
                    $sql = "SELECT * FROM `tbl-food`";

                    // execute the query
                    $result= mysqli_query($conn,$sql);

                    // count rows to check whether we have foods or not
                    $count =mysqli_num_rows($result);

                    // create serial varialble
                    $sn=1;

                    if($count>0){
                        // we have food in db
                        // get the food from db and display
                        while($row= mysqli_fetch_assoc($result)){
                            // get the value from indivisual column
                            $id= $row['id'];
                            $title= $row['title'];
                            $price= $row['price'];
                            $imagename= $row['image-name'];
                            $featured= $row['featured'];
                            $active= $row['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                        // check whether we have image or not
                                        if($imagename==""){
                                            // we do not have image
                                            echo "<div class='error'>Image not added</div>";
                                        }else{
                                            // we have image and display image
                                            ?>

                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imagename; ?>" alt="" width="100px">


                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image-name=<?php echo $imagename; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }else{
                        // not found food
                        echo "<tr> <td colspan='7' class='error'>Food not added yet</td></tr>";
                    }

                ?>


                
            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>