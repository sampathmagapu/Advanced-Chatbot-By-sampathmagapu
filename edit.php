<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['username'];

    // Fetch the user from the `signup` table
    $sql = "SELECT * FROM signup WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Update user details in the `signup` table
    $sql = "UPDATE signup SET password='$password', email='$email' WHERE username='$username'";
    
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
        <input type="password" name="password" value="<?php echo $user['password']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
