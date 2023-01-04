<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php
        // check whether id is set or not
        if(isset($_GET['id'])){
            // get the order detail
            $id= $_GET['id'];

            // get all of the detail based on this id
            // sql query to get order details
            $sql = "SELECT * FROM `tbl-order` WHERE id=$id";
            // execute query
            $result= mysqli_query($conn,$sql);
            // count rows
            $count= mysqli_num_rows($result);
            if($count==1){
                // detail available
                $row= mysqli_fetch_assoc($result);
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status'];
                $cusname=$row['customer-name'];
                $cuscontact=$row['customer-contact'];
                $cusemail=$row['customer-email'];
                $cusaddress=$row['customer-address'];

            }else{
                // details not available
                // redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }else{
            // redirect to manage order page
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <b>$<?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" id="" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="cname" id="" value="<?php echo $cusname; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="contact" id="" value="<?php echo $cuscontact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="email" id="" value="<?php echo $cusemail; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <input type="text" name="address" id="" value="<?php echo $cusaddress; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" id="" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" id="" value="Update Order" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            // check whether the update button is clicked or not
            if(isset($_POST['submit'])){
                // echo "clicked";
                // get all the values from form
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $status= $_POST['status'];
                $customername= $_POST['cname'];
                $customercontact= $_POST['contact'];
                $customeremail= $_POST['email'];
                $customeraddress= $_POST['address'];

                // update the values
                $sql2= "UPDATE `tbl-order` SET `qty`='$qty',`total`='$total',`status`='$status',`customer-name`='$customername',`customer-contact`='$customercontact',`customer-email`='$customeremail',`customer-address`='$customeraddress' WHERE id=$id";
                // execute the query
                $result2 = mysqli_query($conn,$sql2);

                // check whether update or not
                // redirect to manage with message
                if($result2==true){
                    // updated
                    $_SESSION['update']= "<div class='success'>Order updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }else{
                    // failed to update
                    $_SESSION['update']= "<div class='error'>Failed to update food</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>