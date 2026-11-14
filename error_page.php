
<!DOCTYPE html>
<html>
<head>
   <title>Student Computer Academy | Mahewa Road Tewa Kaushambi | scait.in</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link href="css/bootstrap.css" rel="stylesheet" />

</head>
<body>
  <br>
  <br>

  <center>
<?php

  if(isset($_GET['error'])) {
    
    echo $_GET['error'];
  
  } else {
   
    echo "Hi!";
  
  }
  
  ?>
  <br>
  
  <a href="https://scait.in" style="color:blue !Important;">Go To Home Page</a>
  </center>
</body>
  <script>
    setTimeout(function(){
    window.location.href = "index.php";
}, 5000);//wait 2 seconds
  </script>
</html>
