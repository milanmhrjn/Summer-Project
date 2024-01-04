<?php
include("partials/header.php");
?>


 <!-- Main Content Section Starts -->
 <div class="main-content">
        <div class="wrapper">
            <h1>MANAGE ORDERS</h1>
            <br> 
            <?php
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
             }
             if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }
            ?>
           <table class='tbl'>
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Image</th>
                <th>Order Message</th>
                <th>Action</th>
            </tr>

            <?php
                //get all the orders from database
                $sql = "SELECT * FROM tbl_order_services";
                //execute the query 
                $res = mysqli_query($con,$sql);
                //count the rows
                $count = mysqli_num_rows($res);
                //create serial number variable and set default value as 1
                $sn=1;
                if($count>0){
                    //order available
                    while($row=mysqli_fetch_assoc($res)){
                        //get all the order details 
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $phone_number = $row['phone_number'];
                        $email = $row['email'];
                        $address = $row['address'];
                        $image_name = $row['image_name'];
                        $order_message = $row['order_message'];
                        ?>
                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $full_name?></td>
                                <td><?php echo $phone_number?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $address?></td>
                                <td><?php
                                    //check whether we have image or not
                                    if($image_name==""){
                                        //we don't have image, display error message
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else{
                                        //we have image, display image
                                        ?>
                                        <img src="<?php echo SITE_URL;?>images/user_design/<?php echo $image_name?>" width="150px" height="200px">
                                        <?php
                                    }
                                ?></td>
                                <td><?php echo $order_message?></td>
                                <td>
                                    <a href="<?php echo SITE_URL;?>admin/update-order.php?id=<?php echo $id;?>" class="update">Update </a>
                                    <a href="<?php echo SITE_URL;?>admin/delete-order.php?id=<?php echo $id;?>&image_name=<?php echo $image_name?>" class="delete">Delete </a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else{
                    //order not available
                    echo "<tr><td colspan='8' class='error'>Orders not Available.</td> </tr>";
                }
            ?>
            
           </table>
        </div>
    </div>



<?php
include("partials/footer.php")
?>


   