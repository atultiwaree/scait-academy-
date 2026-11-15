<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?error=' . urlencode("Unauthorized access"));
    exit();
}

require_once('connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = mysqli_prepare($con, "DELETE FROM s_cer_det WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
}

header('Location: admin-user-all.php');
exit();
?>