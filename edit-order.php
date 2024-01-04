<?php
include('partials-front/header.php');
?>

<?php

    //check whether the id  is set or not 
    if(isset($_GET['id'])){
        //get all the details
        $id= $_GET['id'];
        //sql query to get selected products
        $sql = "SELECT * FROM tbl_order_services Where id = $id";
        //execute the query
        $res = mysqli_query($con, $sql);

        //get the value based on query executed
        $row = mysqli_fetch_assoc($res);

        //get the individual value of selected products 
        $full_name = $row['full_name'];
        $phone_number = $row['phone_number'];
        $email = $row['email'];
        $address= $row['address'];
        $current_image = $row['image_name'];
        $order_message = $row['order_message']; 
    }
    else{
        //redirect to manage service page
         header("location:".SITE_URL.'my-order.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="updateAdmin">Edit Your Order</h1>
        <br><br>    
        <div class="admin-form">
        <form action="" method="POST" enctype = "multipart/form-data">
            <table class='tbl-form'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value = "<?php echo $full_name?>"></td>
                </tr>
                <tr>
                        <td>Phone Number:</td>
                        <td><input type="text" name="phone_number" placeholder="<?php echo $phone_number?>" ></td> 
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" placeholder="<?php echo $email?>" ></td> 
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="text" name="address" placeholder="<?php echo $address?>" ></td> 
                    </tr>
                    <tr>
                    <td>Current Image:</td>
                    <td>
                    <?php
                        if($current_image==""){
                        //image not available
                        echo "<div class='error'>Image not Available.</div>";

                        }   
                        else{
                        //image available
                    ?>
                        <img src="<?php echo SITE_URL;?>images/user_design/<?php echo $current_image?>"width="250px" height="250px">
                        <?php
                    }
                   ?>
                    </td>
                    </tr>
                    <tr>
                    <td>Select New Image:</td>
                    <td>
                    <input type="file" name='image' >
                    </td>
                    </tr>
                    <tr>
                    <td>Order Message:</td>
                    <td>
                        <textarea name="order_message"  cols="50" rows="5" placeholder="<?php echo $order_message?>" ></textarea>
                    </td>
                    </tr>
                    <tr>
                    <input type="hidden" name="id" value=<?php echo $id;?>> 
                    <input type="hidden" name='current_image' value=<?php echo $current_image;?>>
                     <td colspan ="2"><input type="submit" name="submit" value="Edit Order" class="add-admin"></td>
                    </tr>
            </table>
        </form>   
        <?php
            if(isset($_POST['submit'])){
                //get all the details from the form 
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $phone_number = $_POST['phone_number'];
                $email = $_POST['email'];
                $address= $_POST['address'];
                $order_message = $_POST['order_message']; 
                //upload the image if selected
                //check whether upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    //upload button clicked
                    $image_name = $_FILES['image']['name']; //new image name 
                    //check whether the file is available or not 
                    if($image_name!=""){
                        //image is available
                        //uploading new image
                        //rename the image 
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);
                        $image_name = "product".rand(0000,9999).".".$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path="images/user_design/".$image_name;
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //check whether the image is uploaded or not
                        if($upload==false){
                            //failed to upload the image 
                            //redirect to add service page with error message
                            $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITE_URL.'my-order.php');
                            //stop the process
                            die();
                        }
                        //remove the current image if new image is uploaded and current image exists
                        //remove current image if available
                        if($current_image!=""){
                            //current is available
                            //remove the image
                            $remove_path = 'images/user_design/'.$current_image;

                            $remove = unlink($remove_path);

                            //check whether the image is removed or not
                            if($remove==false){
                                //failed to remove current image
                                $_SESSION['remove-failed']="<div class='error'>Failed to Remove Image</div>";
                                //redirect to manage service page 
                                header('location:'.SITE_URL.'my-order.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                }
                else{
                    $image_name = $current_image;
                }
                //update the database
                $sql2 = "UPDATE tbl_order_services SET 
                full_name = '$full_name',
                phone_number = '$phone_number',
                email = '$email',
                address = '$address',
                image_name = '$image_name',
                order_message = '$order_message'
                WHERE id = $id
                ";

                //execute the sql query
                $res2 = mysqli_query($con, $sql2);
                //check whether the query is executed or not 
                if($res2==true){
                    //query is executed and product is updated
                    $_SESSION['update']='<div class="success">You have successfully edited your order.</div>';
                    header('location:'.SITE_URL.'my-order.php');
                }
                else{
                    //failed to update the product
                    $_SESSION['update']='<div class="error">Failed to edit your order.</div>';
                    header('location:'.SITE_URL.'my-order.php');
                }


            }
        ?>

        </div>
    </div>
</div>





<?php
include('partials-front/footer.php');
?>