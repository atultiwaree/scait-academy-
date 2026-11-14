<?php
include('connection.php');
if(isset($_POST['chsubmit'])) {
$cor = $_POST['cour'];
$rol = $_POST['r_n'];
  
  $sql = "SELECT * FROM s_cer_det WHERE course='$cor' AND roll = '$rol'";
  $query = mysqli_query($con, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0) {
    
?><script>window.location.href="certificate/index.php?of=<?php echo $rol; ?>&cor=<?php echo $cor; ?>"</script><?php
    
  } else {
?><script>window.location.href="error_page.php?error=Your Roll No. or Course May Be Wrong...Enter Again"</script><?php
  }
   
 

}

?>