<?php
include('connection.php');
if(isset($_POST['submit'])) {
  $ques = $_POST['question'];
  $op1 = $_POST['op1'];
  $op2 = $_POST['op2'];
  $op3 = $_POST['op3'];
  $op4 = $_POST['op4'];
  $cor = $_POST['correct'];
  $sql = "INSERT INTO question(que, opt1, opt2, opt3, opt4, correct) VALUES('$ques', '$op1', '$op2', '$op3', '$op4', '$cor')";
  $sql = mysqli_query($con, $sql);
  if($sql) {
?><script>window.location.href="add_question.php?error=Successfully added ! 🎈😃"</script><?php
           } else {echo "nope"; echo mysqli_error($con);}

}
else {
echo mysqli_error($con);
  echo "Button Not Pressed";
}




?>