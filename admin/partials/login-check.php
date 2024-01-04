<?php
    //authorization or access control 
    //check whether the user is logged in or not
    if(!isset($_SESSION['user_check']))//if user session is not set
    {
        //user is not logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] ="<div class='error'>Please Login to access Admin Panel.</div>";
        //redirect to login page 
        header('location:'.SITE_URL.'admin/login.php');
    }
?>