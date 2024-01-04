<?php
$conn = new mysqli('localhost', 'root', '', 'triple_two_production');

// Check connection
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'username' and 'password' keys exist
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Retrieve data from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash the password (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the users table
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // User registered successfully, now redirect to the login form
            echo "User registered successfully!";
            echo "<script>window.location.href = 'user/login/login_form.php';</script>";
            exit; // Stop further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid form data.";
    }
}

$conn->close();
?>