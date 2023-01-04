<?php include('partials-front/menu.php'); ?>

    <!-- food search section -->
    <section class="food-search">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" id="search" placeholder="Search for food">
                <input type="submit" name="submit" id="submit" value="Search" class="search-btn">
            </form>
        </div>
    </section>

    <!-- food menu -->
    <section class="food-menu">
        <h3 class="title">Food Menu</h3>
        <div class="food-menu-container">
            <?php
                // display foods that are active
                $sql = "SELECT * FROM `tbl-food` WHERE active='Yes'";

                // executive the query
                $result = mysqli_query($conn,$sql);

                // count rows
                $count = mysqli_num_rows($result);

                // check whether the food are available or not
                if($count>0){
                    // foods are available
                    while($row = mysqli_fetch_assoc($result)){
                        // get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description= $row['description'];
                        $price= $row['price'];
                        $imagename= $row['image-name'];
                        ?>
                            <div class="food-menu-item">
                                <div class="food-img">
                                    <?php
                                    // check whether image available or not
                                    if($imagename==""){
                                        // image is not available
                                        echo "<div class='error'>Image not available</div>";
                                    }else{
                                        // image available
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
                    // foods are not available
                    echo "<div class='error'>Food not found</div>";
                }
            ?>
            
        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>