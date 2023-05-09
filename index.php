<?php include('partials-front/menu.php'); ?>

    <!-- food search section -->
    <section class="food-search">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" id="search" placeholder="Search for food...">
                <input type="submit" name="submit" id="submit" value="Search" class="search-btn">
            </form>
        </div>
    </section>

    <?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-- catagory section -->
    <section class="catagory">
        <h3 class="title">Explore Foods</h3>
    <div class="catagory-container">
        <?php
            // create sql query to display catagory from db
            $sql= "SELECT * FROM `tbl-catagory` WHERE active='Yes' AND featured='Yes' LIMIT 6";
            // execute the query
            $result= mysqli_query($conn,$sql);
            // count rows to check whether the catagory is available or not
            $count= mysqli_num_rows($result);

            if($count>0){
                // catagories available
                while($row= mysqli_fetch_assoc($result)){
                    // get the values like id, title, image name
                    $id= $row['id'];
                    $title= $row['title'];
                    $imagename=$row['image-name'];
                    ?>
                        
                            <div class="catagory-item">
                                <a href="<?php echo SITEURL; ?>catagory-foods.php?catagory_id=<?php echo $id; ?>">
                                    <?php
                                        if($imagename==""){
                                            // display message
                                            echo "<div class='error'>Image not available</div>";
                                        }else{
                                            // image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/catagory/<?php echo $imagename; ?>" alt="">
                                            <?php
                                        }
                                    ?>
                                    
                                    <h3><?php echo $title; ?></h3>
                                </a>
                            </div>
                            
                        
                    <?php
                }
            }else{
                // catagories not available
                echo "<div class='error'>Catagory not added</div>";
            }
        ?>
    </div>
</section>

    <!-- food menu -->
    <section class="food-menu">
        <h3 class="title">Food Menu</h3>
        <div class="food-menu-container">

        <?php
            // getting food from db that are active and featured
            // sql query
            $sql2 = "SELECT * FROM `tbl-food` WHERE active='Yes' AND featured='Yes' LIMIT 6";

            // execute the query
            $result2 = mysqli_query($conn, $sql2);

            // count rows
            $count2 = mysqli_num_rows($result2);

            // check whether food available or not
            if($count2>0){
                // food available
                while($row2= mysqli_fetch_assoc($result2)){
                    // get all the values
                    $id= $row2['id'];
                    $title= $row2['title'];
                    $price= $row2['price'];
                    $description= $row2['description'];
                    $imagename= $row2['image-name'];
                    ?>
                        <div class="food-menu-item">
                            <div class="food-img">
                                <?php
                                // check whether image available or not
                                if($imagename== ""){
                                    // image not available
                                    echo "<div class='error'>Image not available</div>";
                                }else{
                                    // image available
                                    ?>
                                        <img src="<?php echo SITEURL ?>images/food/<?php echo $imagename; ?>" alt="">
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
                echo "<div class='error'>Food not available</div>";
            }
        ?>
            
        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>