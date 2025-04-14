<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['username'];

    // Delete user from the `signup` table
    $sql = "DELETE FROM signup WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: index.php'); // Redirect back to the main admin panel
}
?>
