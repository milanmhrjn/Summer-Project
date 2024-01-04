<?php
include("partials/header.php")
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class='admin'>Add Admin</h1>
        <?php 
            if(isset($_SESSION['add']))//checking whether session is set or not
            { 
                echo $_SESSION['add']; //displaying session msg
                unset($_SESSION['add']); //removing session msg
            }
            ?>
        <div class="admin-form">
            <form action="" method="POST">
                <table class='tbl-form'>
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter your full name"></td> 
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter username"></td> 
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter password"></td> 
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type="submit" name='submit' value="Add Admin" class='add-admin'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>



<?php
include("partials/footer.php");
?>



<?php

//process value from form and save it in database

//check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    //if button is clicked

    //get the data from form 
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encryption with md5

     //SQL query to save the data into database
     $sql = "INSERT INTO tbl_admin SET
     full_name = '$full_name',
     username = '$username',
     password = '$password'
     ";

     //execute query and save data in database
     $res =  mysqli_query($con,$sql) or die(mysqli_error()); 

     //check whether the(query is executed) data is inserted or not and display appropriate message

     if($res==TRUE)
     {
        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        //Redirect page to manage admin page after admin added successfully 
        header("location:".SITE_URL."admin/manage-admin.php");
     }
     else{
        //create a session variable to display message
        $_SESSION['add'] = "<div.class='error'>Failed to Add Admin.";
        //Redirect page to add admin page after admin added unsuccessfully 
        header("location:".SITE_URL."admin/manage-admin.php");
     }
}

?>