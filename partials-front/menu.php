<?php include('config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online food order</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- header section -->
    <section class="header">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="" class="logo-img">
                </a>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item">
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo SITEURL; ?>about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo SITEURL; ?>catagories.php">Catagories</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo SITEURL; ?>food.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>