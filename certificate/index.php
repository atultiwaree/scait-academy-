<?php
//header('content-type:image/jpeg');
include('../connection.php');
$of = $_GET['of'];
$cor = $_GET['cor'];
$save_location = "cer_img/".$of."."."jpg";
$sql = "SELECT * FROM s_cer_det WHERE roll='$of' AND course = '$cor' ";
$exe = mysqli_query($con, $sql);
if($exe){
$num = mysqli_num_rows($exe);
  if($num > 0) {
  $fet = mysqli_fetch_assoc($exe);
    $name = $fet['name'];
    $fname = $fet['fname'];
    $mname = $fet['mname'];
    $enroll = $fet['enroll'];
    $roll = $fet['roll'];
    $dob = $fet['dob'];
    $course = $fet['course'];
    $duration = $fet['duration'];
    $gender = $fet['gender'];
    $pics = $fet['photo'];
  }
  else {header('location:error_page.php?Not Found');}
} else {
header('location:error_page.php?query_not_executed');
}
if($cor == "TALLY"){$title = "Certificate in Accounts";$x_dir=680;$course="*Tally*";}else if($cor=="TYPING"){

$title = "Certificate OF Typing";$x_dir=705;$course="Hindi Typing | English Typing";


} else {
  $title="Advance Diploma in Computer Application";
  $x_dir=100;
  $course = "DOS, Windows Operating System, 
MS Offiece including Word,
Excel, Power point, Access , 
C Programming language, HTML, 
PhotoShop, PageMaker, CorelDraw,
Tally, Internet, and Hindi | English Typing.";

}
$font="Certificate.ttf";
$font2="Helvetica.ttf";
$font3="Helvetica-Bold.ttf";
$image=imagecreatefromjpeg("certificate.jpg");


$img = "certificate.jpg";
$image2 = "$pics";

$image = imagecreatefromstring(file_get_contents($img));
$image2 = imagecreatefromstring(file_get_contents($image2));
imagecopymerge($image, $image2, 2250, 1650, 0, 0, 413, 531, 100);

$color=imagecolorallocate($image,0,0,254);
$color2=imagecolorallocate($image,0,0,0);


imagettftext($image,115,0,$x_dir,1300,$color,$font,$title);


$date="Enrollment No. : $enroll"."          Roll No. : $roll"."          Duration : "."$duration";
imagettftext($image,40,0,410,1500,$color2,$font2,$date);

$award = "Certificate Awarded To  ";
imagettftext($image,80,0,410,1700,$color2,$font3,$award);
$details = "
Student's Name :
Father's Name  :
Mother's Name  :
Date of Birth  :
";
imagettftext($image,60,0,410,1800,$color2,$font3,$details);

$detailss = "
$name
$fname
$mname
$dob
";
imagettftext($image,60,0,1210,1800,$color2,$font2,$detailss);

$transcript = "Transcript Enclosed in the program was conducted given under the seal of Students Computer Academy";
imagettftext($image,40,0,85,2400,$color2,$font3,$transcript);

$module = "Main module covered   ";
imagettftext($image,80,0,410,2620,$color2,$font3,$module);



imagettftext($image,60,0,410,2800,$color2,$font2,$course);
$gen = "";
if($gender == "female") {$gen = "She";}else {$gen = "He";}
$award = $gen.' has been Awarded with " A " grade';
imagettftext($image,80,0,418,3390,$color,$font3,$award);

  

imagejpeg($image,$save_location);
imagedestroy($image);
?>
<html>
  <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <style>
      .css-button {
  font-family: Verdana;
  color: #ffffff;
  font-size: 16px;
  border-radius: 5px;
  border: 1px #3381ed solid;
  background: linear-gradient(180deg, #3d93f6 5%, #1e62d0 100%);
  text-shadow: 1px 1px 1px #1571cd;
  box-shadow: inset 1px 1px 2px 0px #97c4fe;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
        margin-top:100px;
     text-decoration:none;
}
.css-button:hover {
  background: linear-gradient(180deg, #1e62d0 5%, #3d93f6 100%);
}
.css-button-icon {
  padding: 10px 10px;
  border-right: 1px solid rgba(255, 255, 255, 0.16);
  box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button-icon svg {
  vertical-align: middle;
  position: relative;
}
.css-button-text {
  padding: 10px 18px;
}

    </style>
    </head>
  <body>
<img src="<?php echo $save_location; ?>" style="width:100%;">
    
    
    <a class="css-button" href="<?php echo $save_location; ?>" download>
  <span class="css-button-icon"><svg width="16" height="16" viewBox="2 2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.5 10a.5.5 0 01.5.5V14a1 1 0 001 1h12a1 1 0 001-1v-3.5a.5.5 0 011 0V14a2 2 0 01-2 2H4a2 2 0 01-2-2v-3.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
<path fill-rule="evenodd" d="M7 9.5a.5.5 0 01.707 0L10 11.793 12.293 9.5a.5.5 0 01.707.707l-2.646 2.647a.5.5 0 01-.708 0L7 10.207A.5.5 0 017 9.5z" clip-rule="evenodd"/>
<path fill-rule="evenodd" d="M10 3a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 0110 3z" clip-rule="evenodd"/>
</svg></span>
  <span class="css-button-text">Download This Certificate</span>
</a>
    <p><b><?php echo $pics; ?></b></p>
  </body>
</html>
