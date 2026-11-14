
<?php
session_start();
if(!isset($_SESSION['user'])) {
?><script>window.location.href="index.php"</script><?php
exit();

} else {
     
  if(isset($_GET['error'])) {
$show = $_GET['error'];
} else {
$show = "Status";
}
   

  }




?>
<!DOCTYPE html>
<html lang="en">


<head>
 <style>
   *{
   font-family:Abel;
   letter-spacing:1px;
   }
  </style>
    <title>Student Certificate Details</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EEducation master is one of the best eEducational html template, it's suitable for all eEducation websites like university,college,school,online eEducation,tution center,distance eEducation,computer eEducation">
    <meta name="keyword" content="eEducation html template, university template, college template, school template, online eEducation template, tution center template">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />

</head>

<body>
    <div class="container-fluid sb1" style="display:flex;">
       


   
            <div class="col-md-2 col-sm-3 col-xs-6" style="display:flex;">
           
                <a class='top-user-pro' href='logout.php' data-activates='top-menu' style="color:white"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
            </div>

         
   
    </div>

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!--== USER INFO ==-->
     
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                      
					
     
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="admin-user-all.php">All Users</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>

                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-users" aria-hidden="true"></i> Students</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="admin-user-all.php">All Students</a>
                                    </li>
                                    <li><a href="admin-user-add.php">Add New Students</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-commenting-o" aria-hidden="true"></i> Enquiry</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="admin-all-enquiry.html">All Enquiry</a></li>
									
                                </ul>
                            </div>
                        </li>
          
                    </ul>
                </div>
            </div>

            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                       <li class="page-back"><a href="index.php" style="font-size:15px"><?php echo $show; ?></a>
                        </li>
                    </ul>
                </div>

                <!--== User Details ==-->
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
						<div class="box-inn-sp admin-form">
                                <div class="inn-title">
                                    <h4>Add Students Certificate Details</h4>
                                    <p>Here you can edit your website basic details URL, Phone, Email, Address, User and password and more</p>
                                </div>
                                <div class="tab-inn">
                                    <form method="POST" action="add_que.php">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="question" required>
                                                <label class="">Add Question</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="op1" required>
                                                <label class="">Option</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="op2" required>
                                                <label class="">Option</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="op3" required>
                                                <label class="">Option</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="op4" required>
                                                <label class="">Option</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="correct" required>
                                                <label class="">Correct</label>
                                            </div>
                                           
                                        </div>
                                     
                                      <div class="row">
                                            <div class="input-field col s12">
                      <i class="waves-effect waves-light btn-large waves-input-wrapper" style=""><input type="submit" class="waves-button input" name="submit"></i>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>