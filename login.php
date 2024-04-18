<?php

    session_start();
    include "dbconn.php";
    // Assuming you have a database connection $conn
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'super admin') {
            // Redirect to super admin dashboard
            header('Location: super_admin_dashboard.php');
        } elseif ($user['role'] == 'admin') {
            // Redirect to admin dashboard
            header('Location: admin_dashboard.php');
        } elseif ($user['role'] == 'employee') {
            // Redirect to employee dashboard
            header('Location: employee_dashboard.php');
        }
    } else {
        echo "Invalid username or password";
    }
?>
