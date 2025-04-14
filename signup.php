<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sampath';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    // Check if the username or email already exists in the database
    $check_query = "SELECT * FROM signup WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username or Email already exists. Please choose a different one.";
    } else {
        // Insert new user into the database
        $insert_query = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Signup successful. You can now login.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
