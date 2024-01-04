<?php
include("partials/header.php");
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
        $order_message = $row['order_message']; 
    }
    else{
        //redirect to manage service page
         header("location:".SITE_URL.'admin/manage-order.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="updateAdmin">Update Order</h1>
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
                    <td>Order Message:</td>
                    <td>
                        <textarea name="order_message"  cols="50" rows="5" placeholder="<?php echo $order_message?>" ></textarea>
                    </td>
                    </tr>
                    <tr>
                     <input type="hidden" name="id" value=<?php echo $id;?>>
                     <td colspan ="2"><input type="submit" name="submit" value="Update Order" class="add-admin"></td>
                    </tr>
            </table>
        </form>   
        </div>
        <?php
            
            if(isset($_POST['submit'])){
                //get all the details from the form 
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $phone_number = $_POST['phone_number'];
                $email = $_POST['email'];
                $address= $_POST['address'];
                $order_message = $_POST['order_message']; 

                 //update the product in database
                 $sql = "UPDATE tbl_order_services SET 
                 full_name = '$full_name',
                 phone_number = '$phone_number',
                 email = '$email',
                 address = '$address',
                 order_message = '$order_message'
                 WHERE id = $id
             ";
             //execute the sql query
             $res = mysqli_query($con, $sql);
             //check whether the query is executed or not 
             if($res==true){
                 //query is executed and product is updated
                 $_SESSION['update']='<div class="success">Order Updated Successfully.</div>';
                 header('location:'.SITE_URL.'admin/manage-order.php');
             }
             else{
                 //failed to update the product
                 $_SESSION['update']='<div class="error">Failed to Update Order.</div>';
                 header('location:'.SITE_URL.'admin/manage-order.php');
             }

         }
            
        ?>

    </div>
<div>

<?php
include("partials/footer.php");
?>