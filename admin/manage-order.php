<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php
                    // get all the orders from db
                    $sql= "SELECT * FROM `tbl-order` ORDER BY id DESC";
                    // execute the query
                    $result= mysqli_query($conn,$sql);
                    // count the rows
                    $count = mysqli_num_rows($result);
                    $sn=1; //create a serial no. and set initial value as 1
                    if($count>0){
                        // order available
                        while($row= mysqli_fetch_assoc($result)){
                            // get all the order details
                            $id= $row['id'];
                            $food= $row['food'];
                            $price= $row['price'];
                            $qty= $row['qty'];
                            $total= $row['total'];
                            $orderdata= $row['order-date'];
                            $status= $row['status'];
                            $customername= $row['customer-name'];
                            $customercontact= $row['customer-contact'];
                            $customeremail= $row['customer-email'];
                            $customeraddress= $row['customer-address'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $orderdata; ?></td>
                                    
                                    <td>
                                        <?php
                                            // ordered on delivery, undelivey,cancelled
                                            if($status=="Ordered"){
                                                echo "<label>$status</label>";
                                            }elseif($status=="On Delivery"){
                                                echo "<label style='color:orange;'>$status</label>";
                                            }elseif($status=="Delivered"){
                                                echo "<label style='color:green;'>$status</label>";
                                            }elseif($status=="Cancelled"){
                                                echo "<label style='color:red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $customername; ?></td>
                                    <td><?php echo $customercontact; ?></td>
                                    <td><?php echo $customeremail; ?></td>
                                    <td><?php echo $customeraddress; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        // order not available
                        echo "<tr><td colspan='12' class='error'>Order not availabel</td</tr?";
                    }
                ?>
                
            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>