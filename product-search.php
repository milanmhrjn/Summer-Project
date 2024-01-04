<?php
include("partials-front/header.php")
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

    <?php
    //get the search keyword
    $search = $_POST['search'];
    //sql query to get product based on search keyword 
    $sql = "SELECT * FROM tbl_products WHERE title LIKE '%$search' ";
    //execute query 
    $res = mysqli_query($con,$sql);
    //check product is available or not 
    $count = mysqli_num_rows($res);
    //check whether product is available or not
    if($count>0){
        //product is available 
        while($row=mysqli_fetch_assoc($res)){
            //get the details
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name']; 
            ?>
            
                <div class="product-menu-box">
                    <div class="product-menu-img">
                        <a href="order_product.php">
                            <?php
                                //check whether image name is available or not
                                if($image_name==""){
                                    //image not available
                                    echo "<div class='error'>Image name not available</div>";
                                }
                                else{
                                    //image available
                                    ?>
                                    <img src="<?php echo SITE_URL;?>images/services/<?php echo $image_name;?>" alt="Normal Flex" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </a>
                    </div>
                    <div class="product-menu-des">
                        <h3><?php echo $title?></h3>
                        <p class="product-price"><?php echo $price;?></p>
                        <p class="product-details"><?php echo $description;?> </p> <br>
                    </div>
                </div>
            <?php
        }
    }
    else{
        //product is not available
        echo "<br>";
        echo "<div class='text-center'>Product Not Found.</div>";
    }
    ?>

<div class="clearfix"></div>
        </div> 
        <br><br> <br> <br>
<?php
include('partials-front/footer.php');
?>