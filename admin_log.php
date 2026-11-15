<?php
session_start();
require_once('connection.php');

if (isset($_POST['adsubmit'])) {
    $user = trim($_POST['admin'] ?? '');
    $pass = trim($_POST['adpass'] ?? '');

    if ($user === '' || $pass === '') {
        header("Location: index.php?error=" . urlencode("कृपया यूजरनेम और पासवर्ड दोनों दर्ज करें"));
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT id, user, pass FROM admin WHERE user = ? AND pass = ? LIMIT 1");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['user'] = $user;
            header("Location: admin-user-add.php");
            echo '<script>window.location.href="admin-user-add.php";</script>';
            exit();
        } else {
            header("Location: index.php?error=" . urlencode("Wrong User and Password"));
            echo '<script>window.location.href="index.php?error=Wrong User and Password";</script>';
            exit();
        }
    } else {
        die("Database query error: " . mysqli_error($con));
    }
} else {
    header("Location: index.php");
    exit();
}
?>