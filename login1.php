<?php
    session_start();
    include "dbconn.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'super admin') {
            header('Location: super_admin_dashboard.php');
        } elseif ($user['role'] == 'admin') {
            header('Location: admin_dashboard.php');
        } elseif ($user['role'] == 'employee') {
            header('Location: employee_dashboard.php');
        }
    } else {
        echo "Invalid username or password";
    } 
?>

