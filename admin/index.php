<?php include('partials/menu.php'); ?>

    <!-- main-content section -->
    <div class="main-content">
        <div class="wrapper">
        <h1>DASHBORD</h1>
        <br>
        <br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br>
        <br>
        <div class="row">
        <div class="col-4 text-center">
            <?php
                $sql= "SELECT * FROM `tbl-catagory`";
                // execute query
                $result= mysqli_query($conn,$sql);
                // count rows
                $count = mysqli_num_rows($result);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <?php
                $sql2= "SELECT * FROM `tbl-food`";
                // execute query
                $result2= mysqli_query($conn,$sql2);
                // count rows
                $count2 = mysqli_num_rows($result2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">
            <?php
                $sql3= "SELECT * FROM `tbl-order`";
                // execute query
                $result3= mysqli_query($conn,$sql3);
                // count rows
                $count3 = mysqli_num_rows($result3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            Orders
        </div>
        <div class="col-4 text-center">
            <?php
                // create sql query to get total revenue generated
                // aggregate function in sql
                $sql4 = "SELECT SUM(total) AS Total FROM `tbl-order` WHERE status='Delivered'";
                // execute the query
                $result4 = mysqli_query($conn,$sql4);
                // get the value
                $row4 = mysqli_fetch_assoc($result4);

                // get the total revenue
                $totalrevenue= $row4['Total'];
            ?>
            <h1>$<?php echo $totalrevenue; ?></h1>
            <br>
            Revenue Generated
        </div>
        </div>
        </div>
    </div>

    <?php 
        include ('partials/footer.php');
    ?>