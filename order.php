<?php include('partials-front/menu.php'); ?>
<?php
ob_start();
?>
<?php
// check whether the food id is set or not
if(isset($_GET['food_id'])){
    // get the food id and details of the selected food
    $food_id=$_GET['food_id'];

    // get the details of selected food
    $sql= "SELECT * FROM `tbl-food` WHERE id=$food_id";
    // execute the query
    $result = mysqli_query($conn,$sql);
    // count rows
    $count= mysqli_num_rows($result);
    // checked whether the data is available or not
if($count==1){
    // we have data
    // get the data from database
    $row= mysqli_fetch_assoc($result);
    $title = $row['title'];
    $price = $row['price'];
    $imagename = $row['image-name'];
}else{
    // food not available
    // redirect to home page
    header('location:'.SITEURL);
}
}else{
    // redirect to home page
    header('location:'.SITEURL);
}
?>

    <!-- order details -->
    <section class="food-order">
        <div class="order-form">
            <div class="food-qnty">
                <form action="" method="POST">
                    <fieldset>
                        <legend>Selected Food</legend>
                        <div class="image">
                            <?php
                            // check whether the image is available or not
                            if($imagename==""){
                                // image is not available
                                echo "<div class='eroor'>Image is not available</div>";
                            }else{
                                // image is available
                                ?>
                                    <img src="<?php echo SITEURL ?>images/food/<?php echo $imagename; ?>" alt="">
                                <?php
                            }
                            ?>
                            
                        </div>
                        <div class="detail">
                            <h3><?php echo $title; ?></h3>
                            <input type="hidden" name="food" id="" value="<?php echo $title; ?>">

                            <p class="price">$<?php echo $price; ?></p>
                            <input type="hidden" name="price" id="" value="<?php echo $price; ?>">

                            <h4 class="quantity">Quantity</h4>
                            <input type="number" name="qty" id="qty" value="1" required>
                        </div>
                    </fieldset>
                
            </div>


            <div class="order-details">
                <fieldset>
                    <legend>Delivery Details</legend>
                    

                        <div class="customer-detail">
                            <h4>Full Name</h4>
                            <input type="text" name="fname" id="fname" placeholder="Full Name">
                        </div>
                        <div class="customer-detail">
                            <h4>Phone Number</h4>
                            <input type="text" name="phone" id="phone" placeholder="Phone Number">
                        </div>
                        <div class="customer-detail">
                            <h4>Email</h4>
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="customer-detail">
                            <h4>Address</h4>
                            <input type="text" name="address" id="address" placeholder="Address">
                        </div>
                        <br>
                        <div>
                            <input type="submit" name="submit" id="" value="Confirm Order" class="btn-primary">
                        </div>

                    </form>
                    </fieldset>
                    <?php
                        // check whether the submit button is clicked or not
                        if(isset($_POST['submit'])){
                            // get all the details from the form
                            $food = $_POST['food'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = $price*$qty;
                            $orderdate = date("Y-m-d h:i:sa");
                            $status= "Ordered";
                            $customername=$_POST['fname'];
                            $customercontact=$_POST['phone'];
                            $customeremail=$_POST['email'];
                            $customeraddress=$_POST['address'];

                            // save the order in db
                            // create sql to save the data
                            $sql2 = "INSERT INTO `tbl-order`(`food`, `price`, `qty`, `total`, `order-date`, `status`, `customer-name`, `customer-contact`, `customer-email`, `customer-address`) VALUES ('$food','$price','$qty','$total','$orderdate','$status','$customername','$customercontact','$customeremail','$customeraddress')";
                            // execute the query
                            $result2= mysqli_query($conn,$sql2);
                            // check whether query executed successfully or no
                            if($result2==true){
                                // query executed and order saved
                                $_SESSION['order']= "<div class='success text-center'>Food ordered successfully</div>";
                                header('location:'.SITEURL.'index.php');
                                ob_end_flush();
                            }else{
                                // failed to save order
                                $_SESSION['order']= "<div class='error text-center'>Failed to order food</div>";
                                header('location:'.SITEURL);
                            }
                        }
                    ?>
                
            </div>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>