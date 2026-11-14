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
                                    <form method="POST" action="s_cer_det.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="s_name" required>
                                                <label class="">Student Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="f_name" required>
                                                <label class="">Father Name</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="text" value="" class="validate" name="m_name" required>
                                                <label class="">Mother Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="number" value="" class="validate" name="e_number" required>
                                                <label class="">Enrollment Number</label>
                                            </div>
                                           <div class="input-field col s6">
                                                <input type="number" value="" class="validate" name="r_number" required>
                                                <label class="">Roll Number</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input type="text" class="validate" value="" name="dob" required>
                                                <label class="">DOB, 12-May-2000</label>
                                            </div>
                                          <div class="input-field col s6">
                                        <input type="file" name="file" style="width : 100%;" accept="image/*">
                                          </div>
                                        </div>
                                      <div class="row">
                                        <select name="course" required>
                                          <option>Select Course</option>
                                          <option value="ADCA">ADCA</option>
                                          <option value="TALLY">TALLY</option>
                                          <option value="TYPING">TYPING</option>                                             
                                        </select>
                                      <select name="duration" required>
                                          <option >Select Duration</option>
                                            <option value="6 Months">3 Months</option>
                                            <option value="6 Months">6 Months</option>
                                            <option value="1 Year">1 Year</option>
                                            <option value="2 Year">2 Year</option>
                                          
                                       </select>
                                       <select name="gender" required>
                                          <option>Select Gender</option>
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                       </select>
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