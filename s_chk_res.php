<?php
include('connection.php');

if (isset($_POST['chsubmit']) || isset($_GET['r_n']) || isset($_POST['r_n'])) {
    $cor = isset($_POST['cour']) ? trim($_POST['cour']) : (isset($_GET['cour']) ? trim($_GET['cour']) : '');
    $rol = isset($_POST['r_n']) ? trim($_POST['r_n']) : (isset($_GET['r_n']) ? trim($_GET['r_n']) : '');

    if (empty($rol)) {
        header("Location: index.php?error=" . urlencode("Please enter your Roll Number or Enrollment Number.") . "#verify");
        exit;
    }

    // Try finding by exact match (roll or enroll + course)
    $stmt = mysqli_prepare($con, "SELECT id, roll, course FROM s_cer_det WHERE (roll = ? OR enroll = ?) AND course = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "sss", $rol, $rol, $cor);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // If not found with course, try matching roll/enroll alone
    if (!$row) {
        $stmt2 = mysqli_prepare($con, "SELECT id, roll, course FROM s_cer_det WHERE roll = ? OR enroll = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt2, "ss", $rol, $rol);
        mysqli_stmt_execute($stmt2);
        $res2 = mysqli_stmt_get_result($stmt2);
        $row = mysqli_fetch_assoc($res2);
        mysqli_stmt_close($stmt2);
    }

    if ($row) {
        $finalRoll = $row['roll'] ?: $rol;
        $finalCourse = $row['course'] ?: $cor;
        header("Location: certificate/index.php?of=" . urlencode($finalRoll) . "&cor=" . urlencode($finalCourse));
        exit;
    } else {
        header("Location: index.php?error=" . urlencode("No certificate found for Roll / Enrollment No. '$rol'. Please double-check your Hall Ticket or contact SCAIT Office.") . "#verify");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
