<?php include('partials-front/menu.php'); ?>
    
    <!-- food search section -->
    <section class="food-catagory">
        <div class="container">
            <?php
                // get the search keyword
                $search = $_POST['search'];
            ?>
            <h2>Foods on your search <a href="">"<?php echo $search; ?>"</a></h2>
        </div>
    </section>

    <!-- food menu -->
    <section class="food-menu">
        <h3 class="title">Food Menu</h3>
        <div class="food-menu-container">
            <?php
                
                // sql query to get food based on search keyword
                $sql = "SELECT * FROM `tbl-food` WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // execute the query
                $result = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($result);

                // check whether food available or not
                if($count>0){
                    // food available
                    while($row= mysqli_fetch_assoc($result)){
                        // get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $imagename = $row['image-name'];
                        ?>
                            <div class="food-menu-item">
                                <div class="food-img">
                                    <?php
                                        // check whether the image name is available or not
                                        if($imagename==""){
                                            // image not available
                                            echo "<div class='error'>Image is not available</div>";
                                        }
                                        else{
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
                                    <a href="order.html">Order</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    // food not available
                    echo "<div class='error'>Food not found</div>";
                }

            ?>
            
        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>