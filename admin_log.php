<?php
include('connection.php');
session_start();
if(isset($_POST['adsubmit'])) {
	$user = $_POST['admin'];
	$pass = $_POST['adpass'];
	$sql = "SELECT * FROM admin WHERE user = '$user' AND pass = '$pass' ";
	$exe = mysqli_query($con, $sql);
	if($exe) {
		$num = mysqli_num_rows($exe);
	if($num > 0) {
      echo "exists";
      $_SESSION['user'] = $user;
      ?><script>window.location.href="admin-user-add.php?error=logged in"</script><?php
	}
	else {
		echo "not exists";
      ?><script>window.location.href="index.php?error=Wrong User and Password"</script><?php
	 }
	} 
	else {
		echo "query not executed";
	}
	
}




?>