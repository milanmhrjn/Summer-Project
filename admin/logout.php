<?php
//include constant.php for SITE_URL 
include('../config/constant.php');
//destroy the session  
session_destroy();//unsets $_SESSION['user']
// redirect back to login page
header('location:'.SITE_URL.'admin/login.php');
?>