<?php
session_start();
if(isset($_GET['course'])) {
  $limit = $_GET['course'];
  $sql = "SELECT * FROM s_cer_det WHERE course = '$limit' ";
} else {
   
  $sql = "SELECT * FROM s_cer_det";

}
if(!isset($_SESSION['user'])) {
?><script>window.location.href="index.php"</script><?php
  exit();
}
else {
$show = $_SESSION['user'];
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <!--== MAIN CONTRAINER ==-->

<div class="container-fluid sb1" style="display:flex;">
       


   
            <div class="col-md-2 col-sm-3 col-xs-6" style="display:flex;">
           
                <a class='top-user-pro' href='logout.php' data-activates='top-menu' style="color:white"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
            </div>

         
   
    </div>
    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">

                <!--== LEFT MENU ==-->
                       <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                      
					
     
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    
                                    <li><a href="admin-user-add.php">Add New user</a>
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
                        <li><a href="admin-user-all.php?course=ADCA"><i class="fa fa-question-circle" aria-hidden="true"></i>ADCA</a>
                        </li>
                                              <li class="active-bre"><a href="admin-user-all.php?course=DCA">DCA</a>
                        </li>
                                              <li class="active-bre"><a href="admin-user-all.php?course=CCC">CCC</a>
                        </li>
                                              <li class="active-bre"><a href="admin-user-all.php?course=DTP">TALLY</a>
                        </li>
                      
                  
                    </ul>
                </div>

                <!--== User Details ==-->
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Students Certificate Details</h4>
                                    <p>All about students like name, student id, phone, email, country, city and more</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Fa. Name</th>
                                                    <th>Mo. Name</th>
                                                    <th>Enroll No</th>
                                                    <th>Roll No</th>
                                                    <th>DOB</th>
                                                    <th>Gen</th>
													<th >Course</th>
													<th style="width:100px;">Period</th>
                                                    <th style="color:red !important;">DEL</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
                                              include('connection.php');

                                              
                                              $exe = mysqli_query($con, $sql);
                                              if($exe) {
                                              $num = mysqli_num_rows($exe);
                                              if($num > 0) {
                                                while($fet = mysqli_fetch_assoc($exe)) {
                                                ?>
                                              
                                              <tr>
                                                    <td><?php echo $fet['id']; ?></td>
                                                    <td><?php echo $fet['name']; ?></td>
                                                    <td><?php echo $fet['fname']; ?></td>
                                                    <td><?php echo $fet['mname']; ?></td>
                                                    <td><?php echo $fet['enroll']; ?></td>
                                                    <td><?php echo $fet['roll']; ?></td>
                                                    <td><?php echo $fet['dob']; ?></td>
                                                    <td><?php echo $fet['gender']; ?></td>
                                                <td><span class="label label-success"><?php echo $fet['course']; ?></span></td>
					<td><a href="admin-student-details.html" class="ad-st-view" style="background-color:#a1a1ff !important";text-align:center;><?php echo $fet['duration'];?></a></td>
                                                <td><a href="del_su_cer_det.php?id=<?php echo $fet['id']; ?>"><i class="fa fa-times" aria-hidden="true" style="background-color:#f76464;border-radius:50%;display:flex; border:2px solid red;"></i></a></td>
                                                </tr>
                                              
                                              
                                              
                                              <?php
                                                }
                                              }
                                              else {

                                               }
                                              }
                                              else {
                                                  echo "Query Not Executed";
                                                  echo mysql_error($con);
                                                  exit();
                                              }




                                              ?>
                                                
                            
                                            </tbody>
                                        </table>
                                    </div>
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