<?php 
 include("partials-front/header.php");
?>


    <!-- Product Search section starts -->
    <section class="product-search text-center">

        <div class="container" >
        <form action="<?php echo SITE_URL;?>product-search.php" method="POST">
            <input type="search" name="search" placeholder="Search Product" required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
        </div>
        
    </section>
    <!-- Product Search section ends -->
     
    <!-- Product Menu section starts -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Featured Services</h2>

            <?php
                //create sql query to display products from database
                $sql = "SELECT * FROM tbl_products WHERE active='Yes' AND featured='Yes'  ";
                //execute query
                $res= mysqli_query($con,$sql);
                //count rows to check whether the product is available or not  
                $count = mysqli_num_rows($res); 
                if($count>0){
                    //products available 
                    while($row = mysqli_fetch_assoc($res)){
                        //get the value like id,title,image_name 
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $price= $row['price'];
                        $description = $row['description'];
                        ?>
                        
                        <div class="product-menu-box">
                            <div class="product-menu-img">
                                <a href="<?php echo SITE_URL;?>order_product.php">
                                <?php
                                //check whether image is available or not 
                                if($image_name==""){
                                    //display the message
                                    echo "<div class='error'>Image not found</div>";
                                }
                                else{
                                    //image found
                                    ?>
                                <img src="<?php echo SITE_URL;?>images/services/<?php echo $image_name?>" alt="Normal Flex" class="img-responsive img-curve">

                                    <?php
                                }
                                ?>
                                </a>
                            </div>
                            <div class="product-menu-des">
                                <h3><?php echo $title;?></h3>
                                <p class="product-price"><?php echo $price;?></p>
                                <p class="product-details"><?php echo $description;?></p> <br>
                            </div>
                        </div>
                        <?php


                    }
                }
                else{
                    //products not available
                    echo "<div class='error'>No Products Available.</div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div> 
        <br><br> <br> <br>
    </section>
    <!-- Product Menu section ends -->



 <?php 
include ("partials-front/footer.php");
 ?>