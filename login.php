<?php
// Database configuration
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "pass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Prevent SQL injection
$user = stripslashes($user);
$pass = stripslashes($pass);
$user = mysqli_real_escape_string($conn, $user);
$pass = mysqli_real_escape_string($conn, $pass);

// Hash the password (assuming you stored hashed passwords)
// $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Query the database
$sql = "SELECT * FROM users WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify password (use password_verify() if you hashed passwords)
    if ($pass === $row['password']) {
        // Successful login
        echo "Login successful! Welcome " . $row['username'];
    } else {
        // Invalid password
        echo "Invalid username or password";
    }
} else {
    // User not found
    echo "Invalid username or password";
}

$conn->close();
?>