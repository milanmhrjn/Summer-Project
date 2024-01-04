<?php
include ('partials-front/header.php');
?>

<!-- Form section starts -->

   <div class="main-content">
    <div class="wrapper">
        <h1 class='admin'>Place Your Order Here.</h1>
        <div class="admin-form">
            <form action="" method="POST"  enctype="multipart/form-data">
            <?php 
           
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br><br>
                <table class='tbl-form'>
                    <tr>
                        <td>Full Name:</td> 
                        <td><input type="text" name="full_name" placeholder="Enter your full name" required></td> 
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><input type="text" name="phone_number" placeholder="Enter Phone Number" required></td> 
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" placeholder="Enter email" required></td> 
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="text" name="address" placeholder="Enter Address" required></td> 
                    </tr>
                    <tr>
                    <td>Your Design:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                    </tr>
                    <tr>
                    <td>Order Message:</td>
                    <td>
                        <textarea name="order_message"  cols="50" rows="5" placeholder="Your Order Message" required></textarea>
                    </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type="submit" name='submit' value="Order" class='add-admin'>
                        </td>
                    </tr>
                </table>
            </form>
            
<?php

if (isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $address= $_POST['address'];
        $order_message = $_POST['order_message'];
        //upload the image if selected
        //check whether the select image is clicked or not and upload the image only if the image is selected
        if(isset($_FILES['image']['name'])){
            //get the details of selected image 
            $image_name = $_FILES['image']['name']; 
            //check whether the image is selected or not and upload the image only if the image is selected 
            if($image_name!=""){
                //image is selected
                //rename the image
                //get the extension of selected image (jpg,png,gif)
                $ext = end(explode('.',$image_name));
                //create new name for image 
                $image_name = "product".rand(0000,9999).".".$ext; //new image name like 'product1423423425.jpg'
                //upload the image
                //get the source and destination path 
                //source path is the current location of the image 
                $source_path = $_FILES['image']['tmp_name'];
                //destination path is the location of the image to be uploaded
                $destination_path = "images/user_design/".$image_name;
                //then upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                //check whether image uploaded or not
                if($upload==false){
                    //failed to upload the image 
                    //redirect to add service page with error message
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                    header('location:'.SITE_URL.'order_product.php');
                    //stop the process
                    die();
                }
            }
        }
        else{
            $image_name =  ""; //setting default value as blank 
        }
        //save the order in database
        //create the sql to save the data 
        $sql ="INSERT INTO tbl_order_services SET
        full_name = '$full_name',
        phone_number = '$phone_number',
        email = '$email',
        address = '$address',
        image_name = '$image_name',
        order_message = '$order_message'
        ";

        //execute the query 
        $res = mysqli_query($con,$sql);

        //check whether query successfully or not 
        if($res==true){
            //query executed and order saved
            $_SESSION['order-submit']="<div class='success'>Order Submitted Successfully.</div>";
            header('location:'.SITE_URL.'my-order.php'); 
        }
        else{
            //failed to save order
            $_SESSION['order-submit']="<div class='error'>Failed to Order.</div>";
            header('location:'.SITE_URL.'order_product.php');
        }

}

?>
        </div>
    </div>
</div>
    <!-- Form section ends -->



<?php
include("partials-front/footer.php");
?>




