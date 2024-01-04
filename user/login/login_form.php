<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

$conn = new mysqli('localhost', 'root', '', 'triple_two_production');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-submit'])) {
    // Check if 'username' and 'password' keys exist
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Retrieve data from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the user exists in the database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Login successful, set session variables
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // Start the session
                }

                $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                $_SESSION['user_check'] = $username;

                header('location:index.php'); // Redirect to your home page
                exit; // Stop further execution
            } else {
                $_SESSION['login'] = "<div class='error'>Invalid username or password.</div>";
            }
        } else {
            $_SESSION['login'] = "<div class='error'>Invalid username or password.</div>";
        }
    } else {
        $_SESSION['login'] = "<div class='error'>Invalid form data.</div>";
    }
}

// Check if the signup form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup-submit'])) {
    // Check if 'signup-username' and 'signup-password' keys exist
    if (isset($_POST['signup-username']) && isset($_POST['signup-password'])) {
        // Retrieve data from the form
        $username = $_POST['signup-username'];
        $password = $_POST['signup-password'];

        // Hash the password (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the users table
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // User registered successfully, now redirect to the login form
            $_SESSION['login'] = "<div class='success'>User registered successfully. You can now login.</div>";
            header('location:user_login_page.php'); // Redirect to your login page
            exit; // Stop further execution
        } else {
            $_SESSION['login'] = "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    } else {
        $_SESSION['login'] = "<div class='error'>Invalid form data.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Style for the pop-up overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Style for the pop-up dialog */
        .popup {
            display: none;
            position: fixed;
            width: 40%;
            height: 55%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        /* Style for the close button */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<hr>
<body class="bg">
    <div class="login_container">
        <div class="myform">
            <form action="" method="POST">
                <h1 class="adminLogin">USER LOGIN</h1> <br>
                <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION ['login'];
                    unset ($_SESSION['login']);
                }
                ?>
                <br>
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button type="submit" value="Login" name="login-submit">LOGIN</button>
                <p>Don't have an account? <a href="#" onclick="openSignupPopup()">Sign up here</a></p>
            </form>
        </div>
        <div class="loginimage">
            <img src="images/loginbackground.jpg" width="350px">
        </div>
    </div>

    <!-- Signup Pop-up Overlay -->
    <div class="overlay" id="signupOverlay" onclick="closeSignupPopup()"></div>

    <!-- Signup Pop-up Dialog -->
    <div class="popup" id="signupPopup">
        <!-- Close button -->
        <span class="close-btn" onclick="closeSignupPopup()">&times;</span>

        <!-- Signup form -->
    <div class="login_container">
        <div class="myform">
        <form method="post">
            <label for="signup-username">Username:</label>
            <input type="text" name="signup-username" required><br>

            <label for="signup-password">Password:</label>
            <input type="password" name="signup-password" required><br>

            <button type="submit" value="Register" name="signup-submit">REGISTER</button>
        </form>
        </div>
        <div class="loginimage">
            <img src="images/loginbackground.jpg" width="350px">
        </div>
        </div>
    </div>
        <div class="clearfix"></div>

    <script>
        // Function to open the signup pop-up
        function openSignupPopup() {
            document.getElementById("signupOverlay").style.display = "block";
            document.getElementById("signupPopup").style.display = "block";
        }

        // Function to close the signup pop-up
        function closeSignupPopup() {
            document.getElementById("signupOverlay").style.display = "none";
            document.getElementById("signupPopup").style.display = "none";
        }
    </script>
    
</body>
</html>
<br> <br> <br> <br>
<br> <br> <br> <br>
<br> <br> <br> <br>
<br> <br> <br> <br>
<br> <br> <br> <br>
<br> <br> <br> <br>
