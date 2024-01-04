<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start the session
    }
    
    include("partials-front/header.php");
    if (isset($_SESSION['user_check'])) {
        header('location:my_order_page.php');
    } else {
        header('location:user_login_page.php');
    }
    include("partials-front/footer.php");
?>