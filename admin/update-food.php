<?php include('partials/menu.php'); ?>

<?php
// check whether id is set or not
if(isset($_GET['id'])){
    // get all the details
    $id= $_GET['id'];

    // sql query to get the selected food
    $sql2= "SELECT * FROM `tbl-food` WHERE id=$id";
    // execute the query
    $result2= mysqli_query($conn, $sql2);

    // get the value based on query executed
    $row2 = mysqli_fetch_assoc($result2);

    // get the individual value of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $currentimage = $row2['image-name'];
    $currentCatagory = $row2['catagory_id'];
    $featured= $row2['featured'];
    $active= $row2['active'];
}else{
    // redirect to manage food
    header('location;'.SITEURL.'admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" id="" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" id="" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                            if($currentimage!=""){
                                // display the image
                                ?>
    
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $currentimage; ?>" alt="" width="100px">
    
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
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Catagory</td>
                    <td>
                        <select name="catagory" id="">
                            <?php
                                $sql= "SELECT * FROM `tbl-catagory` WHERE active='Yes'";
                                // execute the query
                                $result= mysqli_query($conn,$sql);
                                // count rows
                                $count = mysqli_num_rows($result);

                                // check whether catagory available or not
                                if($count>0){
                                    // catagory available
                                    while($row=mysqli_fetch_assoc($result)){
                                        $catagoryId=$row['id'];
                                        $catagoryTitle=$row['title'];
                                        
                                        // echo "<option value='$catagoryId'>$catagoryTitle</option>";
                                        ?>
                                        <option <?php if($currentCatagory==$catagoryId){echo "selected";} ?> value="<?php echo $catagoryId; ?>"><?php echo $catagoryTitle;  ?></option>
                                        <?php
                                    }
                                }else{
                                    // catagory not available
                                    echo "<option value='0'>Catagory not available</option>";
                                }
                            ?>
                            <option value="0">test catagory</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" id="" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" id="" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="active" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
                        <input type="hidden" name="currentimage" id="" value="<?php echo $currentimage; ?>">
                        <input type="submit" name="submit" id="" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                // echo "clicked";

                // 1. get all the details
                $id= $_POST['id'];
                $title= $_POST['title'];
                $description= $_POST['description'];
                $price= $_POST['price'];
                $currentimage= $_POST['currentimage'];
                $catagory= $_POST['catagory'];
                $featured= $_POST['featured'];
                $active= $_POST['active'];

                // 2. upload the image if selected
                // check whether the upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    // upload button clicked
                    $imagename =$_FILES['image']['name'];

                    // check whether the file is available or not
                    if($imagename!=""){
                        // image is available
                        // A. uploading new image
                        // rename the image
                        $ext =end(explode('.',$imagename));
                        $imagename= "food-name-".rand(000,999).'.'.$ext;

                        // get the source and destination path
                        $source = $_FILES['image']['tmp_name'];
                        $destination = "../images/food/".$imagename;

                        // upload the image
                        $upload = move_uploaded_file($source, $destination);

                        // check whether the image is uploaded or not
                        if($upload==false){
                            // failed to upload
                            $_SESSION['upload']= "<div class='error'>Failed to uplaod new image</div>";
                            // redirect to manage food page
                            header('location;'.SITEURL.'admin/manage-food.php');

                            // stop the process
                            die();
                        }
                        // 3. remove the image if new image uploaded and current image exists
                        // B. remove current image if available
                        if($currentimage!= ""){
                            // current image is available
                            // remove the image
                            $removePath = "../images/food/".$currentimage;

                            $remove = unlink($removePath);

                            // check whether the image is removed or not
                            if($remove==false){
                                // failed to remove image
                                $_SESSION['remove-failed']= "<div class='error'>Failed to remove current image</div>";
                                // redirect to manage food page
                                header('location:'.SITEURL.'admin/manage-food.php');
                                // stop the process
                                die();
                            }
                        }
                    }
                }else{
                    $imagename= $currentimage;
                }

                

                // 4. update the food in db
                $sql3 = "UPDATE `tbl-food` SET `title`='$title',`description`='$description',`price`='$price',`image-name`='$imagename',`catagory_id`='$catagory',`featured`='$featured',`active`='$active' WHERE id=$id";

                // execute the sql query
                $result3 = mysqli_query($conn, $sql3);

                // whether the query is executed or not
                if($result3==true){
                    // query executed and food updated
                    $_SESSION['update'] = "<div class='seccess'>Food updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    // failed to update food
                    $_SESSION['update'] = "<div class='error'>Failed to update food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>