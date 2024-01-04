<?php
include("../admin/partials/header.php")
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1> <br> 
            <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION ['login'];
                        unset ($_SESSION['login']);
                    }
                    ?> <br> 
            <div class="col-4 text-center">
                <?php
                //sql query
                $sql = "SELECT * FROM tbl_products";
                //execute query
                $res = mysqli_query($con,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count?></h1>
                <br>
                Services
            </div>

            <div class="col-4 text-center">
            <?php
                //sql query
                $sql = "SELECT * FROM tbl_admin";
                //execute query
                $res = mysqli_query($con,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count?></h1>
                <br>
                Admin    
            </div>

            <div class="col-4 text-center">
                <?php
                //sql query
                $sql = "SELECT * FROM tbl_order_services";
                //execute query
                $res = mysqli_query($con,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count?></h1>
                <br>
                Orders    
            </div>

            
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php
include("../admin/partials/footer.php");
?>



   