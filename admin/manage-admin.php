<?php
include("../admin/partials/header.php");
?>

<div class="main-content">
<div class="wrapper">
            <h1>MANAGE ADMIN</h1> <br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //displaying session message
                    unset ($_SESSION['add']); //removing session message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete']; 
                    unset ($_SESSION['delete']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']); 
                }
                
                if(isset($_SESSION['user not found'])){
                    echo $_SESSION['user not found'];
                    unset ($_SESSION['user not found']);
                }

                if(isset($_SESSION['Changed Password'])){
                    echo $_SESSION['Changed Password'];
                    unset ($_SESSION['Changed Password']);
                }
                if (isset($_SESSION['Password not match']) ){
                    echo $_SESSION['Password not match'];
                    unset ($_SESSION['Password not match']);
                }
            ?>
            <br>
            <a href="add-admin.php" class='btn-primary'>Add Admin</a>
            <br> 
           <table class='tbl'>
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            
            <!-- displaying admin from database -->
            <?php
                //query to get all admin
                $sql = 'SELECT * FROM tbl_admin ';
                //execute query
                $res = mysqli_query($con,$sql);
                //check whether the query is executed or not
                if($res==TRUE){
                    // count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res); // function to get all the rows in database
                    //check the num of rows
                    $sn = 1; //create a variable and assign the value
                    if($count>0){
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res)){
                            //using while loop to get all data from database and while loop will run as long as we have data in database
                            
                            //get individual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //display value in out table 
                            ?>

                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                 <td>
                                <a href="<?php echo SITE_URL;?>admin/update-password.php?id=<?php echo $id;?>" class="change">Change Password</a>
                                <a href="<?php echo SITE_URL;?>admin/update-admin.php?id=<?php echo $id;?>" class="update">Update Admin</a>
                                <a href="<?php echo SITE_URL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="delete">Delete Admin</a>
                                </td>
                            </tr>
                            
                            <?php
                        }
                    }
                    else{
                        //we don't have data in database
                    }
                }
            ?>
            
           </table>
        </div>
</div>




<?php
include("../admin/partials/footer.php");
?>



