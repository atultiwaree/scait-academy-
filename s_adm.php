<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('connection.php');
if(isset($_POST['asubmit'])) {

	$name = $_POST['aname'];
	$phone = $_POST['aphone'];
	$address = $_POST['address'];

	$sql = "INSERT INTO s_adm(Name, Phone, Address) VALUES('$name', '$phone', '$address')";
    $exe = mysqli_query($con, $sql);

    if($exe) {
       ?><script>window.location.href="error_page.php?error=Registered! We will contact you soon, Thank-You😊";</script><?php
    } else {

     echo mysqli_error($con);
    }
} else {
	echo "button not pressed";
}





?>