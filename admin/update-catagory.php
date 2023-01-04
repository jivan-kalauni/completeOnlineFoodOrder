<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Catagory</h1>
        <br><br>
        
        <?php
            // check whether the id is set or not
            if(isset($_GET['id'])){
                // get the value 
                // echo "getting the data";
                $id= $_GET['id'];

                // create sql query to get all values
                $sql= "SELECT * FROM `tbl-catagory` WHERE id=$id";

                // execute the query
                $result = mysqli_query($conn,$sql);

                // count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($result);

                if($count==1){
                    // get all the data
                    $row = mysqli_fetch_assoc($result);
                    $title = $row['title'];
                    $currentimage = $row['image-name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    // redirect to manage catagory with session message
                    $_SESSION['no-catagory-found']="<div class='error'>Catagory not found</div>";
                    header('location:'.SITEURL.'admin/manage-catagory.php');
                }

            }else{
                // redirect to manage catagory
                header('location:'.SITEURL.'admin/manage-catagory.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" id="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td>
                    <?php
                        if($currentimage!=""){
                            // display the image
                            ?>

                                <img src="<?php echo SITEURL; ?>images/catagory/<?php echo $currentimage; ?>" alt="" width="100px">

                            <?php
                        }else{
                            // display message
                            echo "<div class='error'>Image not added</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image" id="image">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" id="featured" value="Yes">Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" id="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" id="active" value="Yes">Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" id="active" value="No">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="currentimage" id="currentimage" value="<?php echo $currentimage; ?>">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" id="submit" value="Update Catagory" class="btn-primary">
                </td>
            </tr>
        </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // echo "clicked";
                // get all the value from form

                $id = $_POST['id'];
                $title = $_POST['title'];
                $currentimage = $_POST['currentimage'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image if selected
                // check whether the image is seleted or not
                if(isset($_FILES['image']['name'])){
                    // get the image details
                    $imagename =$_FILES['image']['name'];

                    // check whether the image is available or not
                    if($imagename!=""){
                        // image available
                        // upload the new image 
                        // auto rename our image
                        // get the extension of our image(jpeg,png etc)e.g. food.jpg
                        $ext =end(explode('.', $imagename));

                        // rename the image
                        $imagename ="food_catagory_".rand(000,999).'.'.$ext; //e.g. food_catagory_834.jpg
                        

                        $source_path= $_FILES['image']['tmp_name'];
                        $destination_path="../images/catagory/".$imagename;

                        // finally upload image
                        $upload= move_uploaded_file($source_path,$destination_path);

                        // check whether the image is uploaded or not
                        // and if the image is not uploaded we will stop the process and redirect with error message
                        if($upload==false){
                            // set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            // redirect to add-catagory page
                            header('location:'.SITEURL.'admin/manage-catagory.php');
                            // stop the process
                            die();
                        }
                        // remove the current image if available
                        if($currentimage!=""){

                            $remove_path = "../images/catagory/".$currentimage;
                            $remove = unlink($remove_path);

                            // check whether the image is removed or not
                            // if failed to remove the message and stopped the process
                            if($remove==false){
                                // failed to remove the image
                                $_SESSION['failed-remove']= "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-catagory.php');
                                die();
                                }

                        }
                        
                    }else{
                        $imagename = $currentimage;
                    }
                }else{
                    $imagename = $currentimage;
                }
                // update the db
                $sql2 = "UPDATE `tbl-catagory` SET `title`='$title',`image-name`='$imagename',`featured`='$featured',`active`='$active' WHERE id=$id";

                $result2 = mysqli_query($conn, $sql2);


                // redirect to manage catagory with message
                // check whether the query is executed or not
                if($result2==true){
                    $_SESSION['update']= "<div class='success'>Catagory updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-catagory.php');
                }else{
                    $_SESSION['update']= "<div class='error'>Failed to update catagory</div>";
                    header('location:'.SITEURL.'admin/manage-catagory.php');
                }
            }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>