<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "sampath";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // SQL injection prevention
  $username = mysqli_real_escape_string($conn, $username);

  $sql = "SELECT username, password FROM signup WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
      // Password is correct, redirect to chatshj.html
      header("Location: chatshj.html");
      exit();
    }
  }

  // Invalid credentials, redirect to error.html
  header("Location: error.html");
  exit();
}

$conn->close();
?>
