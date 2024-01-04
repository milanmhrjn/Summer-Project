<?php
include ('../config/constant.php');
?>

<html>
    <head>
        <title>LogIn Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body class="bg">
        <div class="login_container">
            <div class="myform">
                <form action="" method="POST">
                    <h1 class="adminLogin">ADMIN LOGIN</h1> <br>
                    <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION ['login'];
                        unset ($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset ($_SESSION['no-login-message']);
                    }
                    ?>
                    <br>
                    <input type="text" name="username" placeholder="Admin Name">
                    <input type="password"name="password" placeholder="Password">
                    <button type="submit" value="Login" name="submit">LOGIN</button>
                </form>
            </div>
            <div class="loginimage">
                <img src="../images/loginbackground.jpg" width="350px">
            </div>
        </div>
        
    </body>
</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login

    //get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //sql to check whether the user with username and password exist or not 
    $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password = '$password'";
    //execute the query 
    $res = mysqli_query($con,$sql);

    //count rows to check whether the user exist or not 
    $count = mysqli_num_rows($res);
    if($count==1){
        //user available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user_check']= $username; //to check whether the user is logged in or not and logout will unset it
        //redirect to home page or dashboard
       header('location:'.SITE_URL.'admin/');
    }
    else{
        // user not available and login fail
        $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
        //redirect to login page
        header('location:'.SITE_URL.'admin/login.php');
    }
}
?>