<?php
//include constant page
include('../config/constant.php');
//check whether the id and image_name value is set or not 
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //process to delete
    //get id and image name 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image if available
    //check whether the image is available or not and delete only if available
    if($image_name!=""){
        //it has image and need to be deleted from folder
        //get the image path
         $path = '../images/user_design/'.$image_name; 
         //remove the image file from folder
         $remove = unlink($path);
         //check whether the image is removed or not 
         if($remove==false){
            //failed to remove image 
            $_SESSION['upload']="<div class='error'>Failed to Remove Product Image.</div>";
            //redirect to manage order
            header('location:'.SITE_URL.'admin/manage-order.php');
            //stop the process of deleting services
            die();
         }
    }

    //delete products from database
    $sql = "DELETE FROM tbl_order_services WHERE id = $id";
    //execute query 
    $res = mysqli_query($con,$sql);
    //check whether query executed successfully or not and set the session message
    //redirect to manage order page with session message    
    if($res==true){
        //order delete 
        $_SESSION['delete']="<div class='success'>Order Deleted Successfully.</div>";
        header('location:'.SITE_URL.'admin/manage-order.php');
    }
    else{
        //failed to delete order
        $_SESSION['delete']="<div class='error'>Failed to Delete Order.</div>";
        header('location:'.SITE_URL.'admin/manage-order.php');
    }
}
else{
    //redirect to manage order page
   $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
   header('location:'.SITE_URL.'admin/manage-order.php');
}
?>