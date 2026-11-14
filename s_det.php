<?php
include('connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['submit']))
{
	  $name = $_POST['name'];
	  $phon = $_POST['phon'];
	  $pass = $_POST['pass'];
	  $pasc = $_POST['pasc'];
	  $file = $_FILES['file'];
	  $fname = $file['name'];
	  $ftemp = $file['tmp_name'];
	  $fsize = $file['size'];
	  $ftype = $file['type'];
      $ferror = $file['error'];
      $course = $_POST['course'];
  
      $fileExt = explode('.', $fname);
      $fileActual = strtolower(end($fileExt));
      
	   if($ferror == 0) {
       $fileNew = uniqid('.', true).$name.".".$fileActual;
         $fileDest = 'photo/'.$fileNew;
         if($pass == $pasc) {
           $sql = "INSERT INTO s_det(name, phone, course, profile, pass) VALUES('$name', '$phon', '$course', '$fileDest', '$pass')";
           $exe = mysqli_query($con, $sql);
           move_uploaded_file($ftemp, $fileDest);
           if($exe) {
            echo "Done";
             ?><script>window.location.href="index.php?error=You are registerd, All Done"</script><?php
           } else {
           
           echo  mysqli_error($con);
           exit();
           }
           
         
           
         } else {
           ?><script>window.location.href="index.php?error=Password is not Matching, Submit Form Again 😫"</script><?php
         }
       } else {
       
         echo "there was an error";
       
       }

	


} else {
	echo "Submit Button Not Pressed";
}



?>