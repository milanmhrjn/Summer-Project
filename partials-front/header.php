<?php
    include('config/constant.php');   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Used to make responsive website -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triple Two Production House</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about_us.css"> 
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body>
    <!-- Navbar section starts -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="images/post/tripletwo.png" alt="Triple Two Production House" class="triple">
                <p class="text">Triple Two Production House</p>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITE_URL;?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL;?>about_us.php">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL;?>services.php">Services</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL;?>order_product.php">Order</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL;?>my-order.php">My Order</a>
                    </li>
                    <?php
                        // Check if the 'user' cookie is set
                        if (isset($_SESSION['user_check'])) {
                            echo "<a href='user/user_logout.php'>Logout</a>";
                        } else {
                            echo "<a href='" . SITE_URL . "user_login_page.php'>Login</a>";
                        }
                    ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar section ends -->