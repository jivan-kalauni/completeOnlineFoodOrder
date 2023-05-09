<?php include('partials/menu.php'); ?>




<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" id="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="description" cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" id="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image" id="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="catagory" id="catagory">
                            <?php
                                // create php code to display catagories from db
                                // 1. create sql to get all active catagories from db
                                $sql = "SELECT * FROM `tbl-catagory` WHERE active='Yes'";
                                
                                // executin the query
                                $result= mysqli_query($conn,$sql);

                                // count rows to check whether we have catagories or not
                                $count = mysqli_num_rows($result);

                                // if count is greater than zero we have catagories
                                if($count>0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        // get the details of catagories
                                        $id= $row['id'];
                                        $title= $row['title'];
                                        ?>
                                           <option value="<?php echo $id;  ?>"><?php echo $title; ?></option> 
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <option value="0">No catagories found</option>
                                    <?php
                                }

                                // 2. display on dropdown
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" id="featured" value="Yes">Yes
                        <input type="radio" name="featured" id="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" id="active" value="Yes">Yes
                        <input type="radio" name="active" id="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            // check whether the button is clicked or not
            if(isset($_POST['submit'])){
                // add the food in db
                
                // 1. get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $catagory = $_POST['catagory'];
                
                // check whether radio is active or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No"; //default value
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No"; //default value
                }

                // 2. upload the image if selected
                // check whether the select image is clicked or not and upload if selected
                if(isset($_FILES['image']['name'])){
                    // get the detail of the selected image
                    $imagename= $_FILES['image']['name'];

                    // check whether the image is selected or not and upload if selected
                    if($imagename!=""){
                        // image is selected
                        // A. rename the image
                        // get the extension of selected image
                        $ext = end(explode('.',$imagename));

                        $imagename ="food_name_".rand(000,999).'.'.$ext; //e.g. food_catagory_834.jpg

                        // B. upload the image
                        // get the source and destination path
                        
                        // source path is the current location of image
                        $src = $_FILES['image']['tmp_name'];

                        // destination path for the image to be uploaded
                        $dest = "../images/food/".$imagename;

                        // finally upload the food image
                        $upload= move_uploaded_file($src,$dest);

                        // check whether image uploaded or not
                        if($upload==false){
                            // failed to upload the image
                            // redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('loaction:'.SITEURL.'admin/add-food.php');
                            // stop the process
                            die();
                        }

                    }
                }else{
                    $imagename="";
                }

                // 3. insert into db
                // create a sql query to insert db
                $sql2 = "INSERT INTO `tbl-food`(`title`, `description`, `price`, `image-name`, `catagory_id`, `featured`, `active`) VALUES ('$title','$description','$price','$imagename','$catagory','$featured','$active')";

                // execute the query
                $result1 = mysqli_query($conn, $sql2);
                // check whether data inserted or not
                // redirect with message to manage food page
                if($result1==true){
                    // data inserted successfully
                    $_SESSION['add']= "<div class='success'>Food added successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    // failed to insert data
                    $_SESSION['add']= "<div class='error'>Failed to add food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }


        ?>


    </div>
</div>



<?php include('partials/footer.php'); ?>