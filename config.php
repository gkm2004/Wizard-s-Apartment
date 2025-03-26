<?php
$servername = "localhost";
$username = "root";  // Default MySQL root username
$password = "";      // Default MySQL root password is empty
$dbname = "my_blog_db";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
