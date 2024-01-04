<?php

include("partials-front/header.php");

?>
<style>
    .floating-button {
            height: 100px;
            width: 100px;
            position: fixed;    
            bottom: 75px;
            right: 75px;
            background-color:  #4A235A;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .floating-button:hover {
            background-color: #45a049;
        }
    </style>


<section class="product-menu">
        <div class="container">
        <?php
         if(isset($_SESSION['order-submit'])){
            echo $_SESSION['order-submit']; //displaying session msg
            unset($_SESSION['order-submit']); //removing session msg
        }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
             }

             if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }
             
             ?>
      <?php
          //get all the orders from database
          $sql = "SELECT * FROM tbl_order_services";
          //execute the query 
          $res = mysqli_query($con,$sql);
          //count the rows
          $count = mysqli_num_rows($res);
          if($count>0){
              //order available
              while($row=mysqli_fetch_assoc($res)){
                  //get all the order details 
                  $id = $row['id'];
                  $image_name = $row['image_name'];
                  $order_message = $row['order_message'];
                ?>
            <div class="product-menu-box">
            <div class="product-menu-img">
               <img src="<?php echo SITE_URL;?>images/user_design/<?php echo $image_name?>" alt=""class="img-responsive img-curve">
            </div>  
            <div class="product-menu-des">
                <p class="product-details"><?php echo $order_message?></p> <br>
                <a href="<?php echo SITE_URL;?>cancel-order.php?id=<?php echo $id;?>&image_name=<?php echo $image_name?>" class="delete">Cancel</a>
                 <a href="<?php echo SITE_URL;?>edit-order.php?id=<?php echo $id;?>" class="update">Edit Order </a>
            </div>
            </div>
                
                <?php
                }
            
            }
            else{
                echo "<div class='error'>You have not ordered anything yet.</div>";
            }
      ?>

            <div class="clearfix"></div>
        </div> 
        <br><br> <br> <br> <br> <br> <br> <br> <br>
    </section>  

    <button class="floating-button" onclick="handleButtonClick()">Checkout</button>

<!-- Optional JavaScript for button functionality -->
<script>
        function handleButtonClick() {
            // Handle button click functionality here
            window.location.href = "http://localhost/TripleTwoProduction/payment_page.php";
        }
    </script>

    <?php
    
    include("partials-front/footer.php");
    ?>