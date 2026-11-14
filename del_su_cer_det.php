<?php
include('connection.php');
$user= $_GET['id'];
$cmd = "DELETE FROM s_cer_det WHERE id = '$user'";
$exe = mysqli_query($con, $cmd);
if($exe) {
header('location:admin-user-all.php');
} else {
    mysqli_error($con);
}

?>