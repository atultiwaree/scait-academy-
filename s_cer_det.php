<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('connection.php');
if(isset($_POST['submit'])) {
$name = $_POST['s_name'];
$fname = $_POST['f_name'];
$mname = $_POST['m_name'];
$enroll = $_POST['e_number'];
$roll = $_POST['r_number'];
$dob = $_POST['dob'];
$course = $_POST['course'];
$dur = $_POST['duration'];
$gen = $_POST['gender'];
$file = $_FILES['file']['tmp_name'];
  
  echo $file;
  
  list($width, $height) = getimagesize($file);
  $nwidth = 413;
  $nheight = 531;
  $newimage = imagecreatetruecolor($nwidth, $nheight);
  $locate = "";
  if($_FILES['file']['type'] == 'image/jpeg'){

  $source = imagecreatefromjpeg($file);
  imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
  $file_name = $name.time().'.jpg';
    $locate = "upload/".$file_name;
    $locates = "certificate/upload/".$file_name;
     imagejpeg($newimage, $locates);
   

  } if($_FILES['file']['type'] == 'image/png'){

  $source = imagecreatefrompng($file);
  imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
  $file_name = $name.time().'.png';
  $locate = "upload/".$file_name;
    $locates = "certificate/upload/".$file_name;
  imagepng($newimage, $locates);
  
  }

  
echo $name." ".$fname." ".$mname." ".$enroll." ".$roll." ".$dob." ".$course." ".$dur." ".$gen;
  

 $sql = "INSERT INTO s_cer_det(name, fname, mname, enroll, roll, dob, course, duration, gender, photo) VALUES('$name', '$fname', '$mname', '$enroll', '$roll', '$dob', '$course', '$dur', '$gen', '$locate')";
 $exe = mysqli_query($con, $sql);

 if($exe) {
     ?><script>window.location.href="admin-user-add.php?error=Details Uploaded!!, Go for Next 😃"</script><?php
 } else {
   ?><script>window.location.href="admin-user-add.php?error=Query Not Executed"</script><?php
  exit();
   
 }
  
  

}
else {
echo mysqli_error($con);
  echo "Button Not Pressed";
}




?>