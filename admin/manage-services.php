<?php
include("partials/header.php")
?>

<!-- Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>MANAGE SERVICES</h1>
         <br>
         <?php
         if (isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         }
         if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
         }

         if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
         }

         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
         ?>
         <br>
            <a href="<?php echo SITE_URL;?>admin/add-services.php" class='btn-primary'>Add Services</a>
            <br> 
           <table class='tbl'>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
                //create sql query to get all the services 
                $sql = "SELECT * FROM tbl_products";
                //execute the query
                $res= mysqli_query($con,$sql);
                //check whether we have products or not 
                $count = mysqli_num_rows($res);
                //create serial number variable and set default value as 1
                $sn=1;
                if($count>0){
                    //we have products in database
                    //get the products from database and display them
                    while($row = mysqli_fetch_assoc($res)){
                        //get the value from individual columns 
                        $id= $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active']; 
                        ?>

                        <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php echo $title?></td>
                            <td><?php echo $price?></td>
                            <td><?php echo $description?></td>
                            <td>
                                <?php
                                    //check whether we have image or not
                                    if($image_name==""){
                                        //we don't have image, display error message
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else{
                                        //we have image, display image
                                        ?>
                                        <img src="<?php echo SITE_URL;?>images/services/<?php echo $image_name?>" width="150px" height="200px">
                                        <?php
                                    }
                                ?></td>
                            <td><?php echo $featured?></td>
                            <td><?php echo $active?></td>
                            <td>
                            <a href="<?php echo SITE_URL;?>admin/update-services.php?id=<?php echo $id;?>" class="update">Update</a>
                            <a href="<?php echo SITE_URL;?>admin/delete-services.php?id=<?php echo $id;?>&image_name=<?php echo $image_name?>" class="delete">Delete</a>
                            </td>
                        </tr>

                        <?php

                    }
                }
                else{
                    //the database is empty or there are no products in database 
                    echo "<tr><td colspan='8' class='error'>Products not Added Yet.</td></tr>";
                }
            ?>
            
           </table>
        </div>
    </div>


<?php
include("partials/footer.php")
?>