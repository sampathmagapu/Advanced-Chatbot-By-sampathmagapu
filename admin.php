<?php
include 'db.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the signup table
$sql = "SELECT * FROM signup";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Manage Users</title>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background color */
            color: black; /* Set text color to black */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white for the container */
            border-radius: 8px; /* Optional: rounds the corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow for depth */
        }

        h1, h2 {
            background-color: #4CAF50; /* Green background for headings */
            color: white; /* White text for contrast */
            padding: 10px; /* Some padding for aesthetics */
            border-radius: 5px; /* Rounded corners for the background */
        }

        .user-table, .add-user-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e0e0e0; /* Light gray for table headers */
        }

        button {
            background-color: #4CAF50; /* Green background for buttons */
            color: white; /* White text */
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table border="1" class="user-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['password']); ?></td> <!-- Ideally, do not display passwords -->
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="edit.php?username=<?php echo urlencode($row['username']); ?>">Edit</a> |
                                <a href="delete.php?username=<?php echo urlencode($row['username']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Add User</h2>
        <table class="add-user-table" border="1">
            <form action="add.php" method="POST">
                <tr>
                    <td>
                        <label for="username">Username:</label>
                    </td>
                    <td>
                        <input type="text" name="username" id="username" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:</label>
                    </td>
                    <td>
                        <input type="password" name="password" id="password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td>
                        <input type="email" name="email" id="email" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Add User</button>
                    </td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
?>