<?php 

$image1 = "certificate.jpg";
$image2 = "cer_img/pass.jpg";


$image1 = imagecreatefromstring(file_get_contents($image1));
$image2 = imagecreatefromstring(file_get_contents($image2));
imagecopymerge($image1, $image2, 80, 150, 0, 0, $width, $height, 100);
header('content-type:image/jpeg');
imagejpeg($image1);




?>