<?php include('partials-front/menu.php'); ?>

    <!-- catagory section -->
    <section class="catagory">
        <h3 class="title">Explore Foods</h3>
        <div class="catagory-container">

        <?php
            // display all the catagories that are active
            $sql = "SELECT * FROM `tbl-catagory` WHERE active='Yes'";
            // execute the  query
            $result = mysqli_query($conn,$sql);

            // count rows
            $count =  mysqli_num_rows($result);

            // check whether catagories available or not
            if($count>0){
                // catagories available
                while($row= mysqli_fetch_assoc($result)){
                    // get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $imagename = $row['image-name'];
                    ?>
                        <div class="catagory-item">
                            <a href="<?php echo SITEURL; ?>catagory-foods.php?catagory_id=<?php echo $id; ?>">
                                <?php
                                    if($imagename==""){
                                        // image not available
                                        echo "<div class='error'>Image not found</div>";
                                    }else{
                                        // image availabele
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
                echo "<div class='error'>Catagory not found</div>";
            }
        ?>

            
        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>