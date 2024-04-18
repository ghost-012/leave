<?php
    session_start();

    include "dbconn.php";
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'employee') {
        // If the user is not logged in or not an employee, redirect to the login page
        header('Location: sign_in.php');
        exit();
    }

    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are logged in as an <?php echo $_SESSION['role']; ?>.</p>

    <h2>Dashboard</h2>
    <ul>
        <li><a href="view_tasks.php">View Tasks</a></li>
        <li><a href="view_schedule.php">View Schedule</a></li>
        <li><a href="view_performance.php">View Performance</a></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
