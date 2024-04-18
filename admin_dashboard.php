<?php
    session_start();
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
    <h1>Welcome, <?php echo $user['username'] ?>!</h1>
    <p>You are logged in as an <?php echo $user['role']; ?>.</p>

    <h2>Dashboard</h2>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_tasks.php">Manage Tasks</a></li>
        <li><a href="view_reports.php">View Reports</a></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>

</html>