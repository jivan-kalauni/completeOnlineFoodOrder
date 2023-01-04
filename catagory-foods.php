<?php include('partials-front/menu.php'); ?>

<?php
// check whether id passed or not
if(isset($_GET['catagory_id'])){
    // catagory id is set and get id
    $catagory_id= $_GET['catagory_id'];
    // get the catagory title based on catagory id
    $sql = "SELECT title FROM `tbl-catagory` WHERE id=$catagory_id";

    // execute the query
    $result= mysqli_query($conn,$sql);

    // get the value from db
    $row = mysqli_fetch_assoc($result);
    // get the title
    $catagory_title = $row['title'];
}else{
    // catagory not passed
    // redirect to home page
    header('location:'.SITEURL);
}
?>

    <!-- food search section -->
    <section class="food-catagory">
        <div class="container">
            <h2>Foods on <a href="">"<?php echo $catagory_title ?>"</a></h2>
        </div>
    </section>

    <!-- food menu -->
    <section class="food-menu">
        <h3 class="title">Food Menu</h3>
        <div class="food-menu-container">
            <?php
                //  create sql query to get food based on selected catagory
                $sql2 = "SELECT * FROM `tbl-food` WHERE catagory_id=$catagory_id";
                // execute the query
                $result2 = mysqli_query($conn,$sql2);

                // count rows
                $count2 = mysqli_num_rows($result2);

                // check whether food is available or not
                if($count2>0){
                    // food is available
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $id=$row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $imagename = $row2['image-name'];
                        ?>
                            <div class="food-menu-item">
                                <div class="food-img">
                                    <?php
                                        if($imagename==""){
                                            // image not available
                                            echo "<div class='error'>Image is not available</div>";
                                        }else{
                                            // image is available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imagename; ?>" alt="">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="food-detail">
                                    <h2 class="food-title"><?php echo $title; ?></h2>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-description"><?php echo $description; ?></p>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>">Order</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    // food not available
                    echo "<div class='error'>Food is not available</div>";
                }
            ?>
            
        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>