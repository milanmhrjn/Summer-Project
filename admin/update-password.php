<?php
include ('partials/header.php');
?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="changePassword">Change Password</h1>
            <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            ?>
            <div class="admin-form">
            <form action="" method="POST">
                <table class='tbl-form'>
                    <tr>
                        <td>
                            Current Password:   
                        </td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>
                    <tr>
                        <td>
                            New Password:
                        </td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td>
                            Confirm Password:
                        </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type="hidden" name='id' value="<?php echo $id;?>">
                            <input type="submit" name='submit' value="Change Password" class='add-admin'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        </div>
    </div>

    <?php
    //check whether the submit button is clicked or not 
    if(isset($_POST['submit'])){
        //get the data from form 
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether the user with current id and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password ='$current_password'";

        //execute the query 
        $res = mysqli_query($con,$sql);
        if($res==TRUE){
            //check whether data is available or not
            $count = mysqli_num_rows($res);
            if($count==1){
                //user exist and password can be changed
                //check whether the new password and confirm password match or not
               if($new_password==$confirm_password){
                //update the password
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id = $id
                ";
                //execute the query
                $res2 = mysqli_query($con, $sql2);
                //check whether the query is executed or not
                if($res2==TRUE){
                    //display success message
                    $_SESSION['Changed Password']="<div class='success'>Password Changed Successfully.</div>";
                    //redirect user
                    header('location:'.SITE_URL.'admin/manage-admin.php');
                }
                else{
                    //display error message
                    $_SESSION['Password not match']="<div class='error'>Failed to Change Password.</div>";
                    //redirect user
                    header('location:'.SITE_URL.'admin/manage-admin.php');
                }
               }
               else{
                    //redirect to manage admin page with error message
                $_SESSION['Password not match']="<div class='error'>Password didn't match.</div>";
                //redirect user
                header('location:'.SITE_URL.'admin/manage-admin.php');
               }
            }
            else{
                //user does not exist, set message and redirect
                $_SESSION['user not found']="<div class='error'>User does not exist.</div>";
                //redirect user
                header('location:'.SITE_URL.'admin/manage-admin.php');
            }
        }

        //check whether the new password and confirm password match or not 

        
        //change password if all above is true

    }
    ?>

<?php
include('partials/footer.php');
?>