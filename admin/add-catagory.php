<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br><br>
        <!-- add catagory form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" id="title" placeholder="Categorty Title">
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" id="featured" value="Yes">Yes
                        <input type="radio" name="featured" id="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" id="active" value="Yes">Yes
                        <input type="radio" name="active" id="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

<?php
// check whether the button is clicked or not
if(isset($_POST['submit'])){
    // echo "button clicked";
    // get the value from catagory form
    $title=$_POST['title'];

    // for radio input type we need to check the button is selected or not
    if(isset($_POST['featured'])){
        // get the value from form
        $featured=$_POST['featured'];
    }else{
        // set the default value
        $featured= "No";
    }
    if(isset($_POST['active'])){
        // get the value from form
        $active=$_POST['active'];
    }else{
        // set the default value
        $active= "No";
    }
    // check whether the image is selected or not and set the value for image name accordingly
    // print_r($_FILES['image']);
    // die();  //break the code here

    if(isset($_FILES['image']['name'])){
        // upload the image
        // to upload image we need image name, source path and destination path
        $imagename=$_FILES['image']['name'];

        // upload image only if image is selected
        if($imagename!=""){
            // auto rename our image
            // get the extension of our image(jpeg,png etc)e.g. food.jpg
            $ext =end(explode('.', $imagename));

            // rename the image
            $imagename ="food_catagory_".rand(000,999).'.'.$ext; //e.g. food_catagory_834.jpg
            
            // get the source and destination path
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
                header('location:'.SITEURL.'admin/add-catagory.php');
                // stop the process
                die();
            }
        }
    }else{
        // don't upload image and set image-name value as blank
        $imagename="";
    }

    // create sql query to insert catagory in to database
    $sql= "INSERT INTO `tbl-catagory`(`title`, `image-name`, `featured`, `active`) VALUES ('$title','$imagename','$featured','$active')";

    // execute the query and save in db
    $result= mysqli_query($conn,$sql);

    // check whether the query is executed or not
    if($result==true){
        $_SESSION['add']= "<div class='success'>Category added successfully</div>";
        header('location:'.SITEURL.'admin/manage-catagory.php');
    }else{
        $_SESSION['add']= "<div class='error'>Failed to add category</div>";
        header('location:'.SITEURL.'admin/add-catagory.php');
    }
}
?>

    </div>
</div>


<?php include('partials/footer.php'); ?>