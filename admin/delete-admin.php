<?php

include ('../config/constant.php');
//get the id of admin to be deleted
$id = $_GET['id'];

//create sql to delete admin 
$sql ="DELETE FROM tbl_admin WHERE id = $id";

//execute the query 
$res = mysqli_query($con, $sql);

//check whether the query executed successfully or not
if ($res==TRUE){
    //create  session variable to display message
    $_SESSION ['delete']="<div class='success'>Admin Deleted Successfully.</div>";
    //Redirect to manage admin page
    header('location:'.SITE_URL.'/admin/manage-admin.php');
}
else{
    $_SESSION['delete']="<div class ='error'>Failed to Delete Admin. Try Again Later.</div>";
    header('location:'.SITE_URL.'/admin/manage-admin.php');
}
// redirect to manage admin page with success message or error message




?>