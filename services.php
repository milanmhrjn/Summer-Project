<?php
include('partials-front/header.php');
?>


 <!-- Product Search section starts -->
 <section class="product-search text-center" >
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
        <h2 class="text-center"><u>Our Services</u></h2>

        <?php
            
            //display all the products that are active
            $sql = 'SELECT * FROM tbl_products WHERE active ="Yes"';
            //execute the query 
            $res = mysqli_query($con, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            //check whether products are available or not 
            if($count>0){
                //products are available 
                while($rows=mysqli_fetch_assoc($res)){
                    //get the value
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $price = $rows['price'];
                    $description = $rows['description'];
                    ?>
                    <div class="product-menu-box">
                        <div class="product-menu-img">
                        <a href="order_product.php">
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
                //products are not available
                echo "<div class='error'>No Products Available.</div>";
            }
        
        ?>

        <!-- <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/paperbag.jpg" alt="Paper Bag" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Paper Bag</h3>
                <p class="product-price">Rs.30.00 /Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div> -->


        <!-- <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/envelope.jpg" alt="envelope" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Envelope</h3>
                <p class="product-price">Rs.30.00 /Pcs</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/wobbler.jpg" alt="Wobbler" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Wobbler</h3>
                <p class="product-price">Rs.2.20 /Pcs</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/table calendar.png" alt="table calendar" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Table Calendar</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/mugs.webp" alt="mugs" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Mugs</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/visting card holder.webp" alt="visiting card holder" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Visiting Card Holder</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>
        
        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/uv sign board.jpg" alt="uv sign board" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Uv Sign Board</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/vinyl stickers.jpg" alt="Vinyl Stickers" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Vinyl Stickers</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/visiting card.webp" alt="visting card" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Visiting Card</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/ganeshcanva.jpg" alt="Ganesh canva" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Canva</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/flex.jpg" alt="normal flex" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Flex Normal Print</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types.</p> <br>
            </div>
        </div>


        <div class="product-menu-box">
            <div class="product-menu-img">
                <img src="images/id.jpg" alt="id card" class="img-responsive img-curve">
            </div>
            <div class="product-menu-des">
                <h3>Identity Card</h3>
                <p class="product-price">Rs.30.00/Pcs/Sq.</p>
                <p class="product-details">Best quality flex print for all types. 
                </p> <br>
            </div>
        </div>   -->

        <div class="clearfix"></div>
    </div>
    <br><br> <br> <br>
</section>
<!-- Product Menu section ends -->


 <?php
 include("partials-front/footer.php");
 ?>