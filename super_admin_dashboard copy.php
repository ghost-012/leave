<?php
include "dbconn.php";


// Assuming you have a database connection $conn
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found";
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
        }

        .dashboard-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Sample, <?php echo $user['username'] ?>!</h1>
    <p>You are logged in as an <?php echo $user['role']; ?>.</p>
    <div class="container">
        <h1>Super Admin Dashboard</h1>
        <div class="dashboard-item">
            <h2>Manage Users</h2>
            <p>View, add, edit, or delete users.</p>
            <a href="manage_users.php">Go to Manage Users</a>
        </div>
        <div class="dashboard-item">
            <h2>Manage Content</h2>
            <p>View, add, edit, or delete content.</p>
            <a href="manage_content.php">Go to Manage Content</a>
        </div>
        <!-- Add more dashboard items as needed -->
    </div>
</body>

</html>