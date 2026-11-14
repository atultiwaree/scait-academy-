<?php
if(isset($_GET['error'])) {
  $show = "<font color='orange'>".$_GET['error']."</font>";
} else {
  $show = "Welcome! to Student Computer Academy Portal";
}


?>
<!DOCTYPE html>
<html lang="en">


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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
  <style>

    .map-container-5{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container-5 iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
  </style>
</head>

<body>

    <!-- MOBILE MENU -->

    <section>
        <div class="ed-mob-menu">
            <div class="ed-mob-menu-con">
                <div class="ed-mm-left">
                    <div class="wed-logo">
                        <a href="index.php"><img src="images/logo.png" alt="" />
						</a>
                    </div>
                </div>
                <div class="ed-mm-right">
                    <div class="ed-mm-menu">
                        <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>
                        <div class="ed-mm-inn">
                            <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>
                            <h4>All Courses</h4>
                            <ul>
                                <li><a href="#">ADCA</a></li>
                                <li><a href="#">CCC</a></li>
                                <li><a href="#">Hindi Typing</a></li>
                                <li><a href="#">English Typing</a></li>
                                <li><a href="#">DOS</a></li>
                                <li><a href="#">Operating Systems</a></li>
                                <li><a href="#">Tally</a></li>
                                <li><a href="#">Corel Draw</a></li>
                                <li><a href="#">Excell</a></li>
                                <li><a href="#">Access</a></li>
                                <li><a href="#">Word</a></li>
                                <li><a href="#">Networking</a></li>
                            </ul>
                            <h4>User Account</h4>
                            <ul>
                                <li><a href="#!" data-toggle="modal" data-target="#modal1">Sign In</a></li>
                                <li><a href="#!" data-toggle="modal" data-target="#modal2">Register</a></li>
                            </ul>
                            <h4>All Pages</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--HEADER SECTION-->
    <section>
        <!-- TOP BAR -->
        <div class="ed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ed-com-t1-left">
                            <ul>
                                <li><a href="#">Contact: Tewa Kaushambi Uttar Pradesh IN</a>
                                </li>
                                <li><a href="tel:8736002004">Click To Call : 8736002004</a>
                                </li>
                            </ul>
                        </div>
                        <div class="ed-com-t1-right">
                            <ul>
                                <li><a href="#!" data-toggle="modal" data-target="#modal1">Sign In</a>
                                </li>
                                <li><a href="#!" data-toggle="modal" data-target="#modal2">Sign Up</a>
                                </li>
                            </ul>
                        </div>
                        <div class="ed-com-t1-social">
                            <ul>
                                <li><a href="https://api.whatsapp.com/send?phone=+918736002004"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGO AND MENU SECTION -->
        <div class="top-logo" data-spy="affix" data-offset-top="250">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wed-logo">
                            <a href="index.php"><img src="images/logo.png" alt="" />
                            </a>
                        </div>
                        <div class="main-menu">
                            <ul>
                                <li><a href="#">Home</a>
                                </li>
                                <li class="admi-menu">
                                    <a href="#" class="mm-arr">Admission</a>
                                    <!-- MEGA MENU 1 -->
                                    
                                </li>
                                <li><a href="#">Student</a>
                                </li>
                                <li><a href="#">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="all-drop-down-menu">

                    </div>

                </div>
            </div>
        </div>
       
    </section>
    <!--END HEADER SECTION-->

    <!-- SLIDER -->
    <section>
        <div class="h2-hero">
			<div class="container">
				<div class="row">
					<div class="h2-hero-inn">
						<div class="h2-hero-left">
						<div class="ed-ban-tit">
						<div class="ed-ban-tit-1">
							<h1><?php echo $show; ?><span><br>Educating Since 2008</span></h1>
						</div>
						<div class="ed-ban-tit-2">
							<h4><span class="ed-bann-line"></span><span class="ed-bann-line1"></span>Tewa,<br> Kaushambi UP</h4>
						</div>
						<div class="ed-ban-tit-3">
							<div class="ed-ban-tit-3-com ed-ban-tit-31">
								<div class="ed-sprit ed-ban-cal-le">
									<span>01</span><span>Sep</span>
								</div>
								<div class="ed-ban-cal-ri">
									<a href="#"><span>Admission 2021</span></a><span>@ Tewa</span>
								</div>
							</div>
							<!-- <div class="ed-ban-tit-3-com ed-ban-tit-32">
								<div class="ed-sprit ed-ban-cal-le">
									<span>05</span><span>apr</span>
								</div>
								<div class="ed-ban-cal-ri">
									<a href="#"><span>College farewell</span></a><span>Chicago</span>
								</div>
							</div> -->
							<!-- <div class="ed-ban-tit-3-com ed-ban-tit-31">
								<div class="ed-sprit ed-ban-cal-le">
									<span>18</span><span>jul</span>
								</div>
								<div class="ed-ban-cal-ri">
									<a href="#"><span>Sports event</span></a><span>San Francisco</span>
								</div>
							</div> -->
							<div class="ed-ban-tit-3-com ed-ban-tit-32">
								<div class="ed-sprit ed-ban-cal-le">
									<span>04</span><span>Nov</span>
								</div>
								<div class="ed-ban-cal-ri">
									<a href="#"><span>Diwali Celebration</span></a><span>@ Campus, Tewa</span>
								</div>
							</div>
						</div>
					</div>
						</div>
						<div class="h2-hero-right">
<div class="ed-ref-form">
						<div class="ed-ref-form-inn">
<div class="map-head">
						<p>Register for the</p>
						<h2>Admission</h2> <span class="footer-ser-re">fill below details</span> </div>
							<form method="POST" action="s_adm.php">
								<ul>
									<li>
										<input type="text" required="" name="aname">
										<span class="floating-label">Full Name</span>
									</li>
									<!-- <li>
										<input type="email" required="">
										<span class="floating-label">Email ID</span>
									</li> -->
									<li>
										<input type="number" required="" name="aphone">
										<span class="floating-label">Phone number</span>
									</li>
									<li>
										<input type="text" required="" name="address">
										<span class="floating-label">Address</span>
									</li>
																		
									<li>
										<input type="submit" name="asubmit" value="Register Now">
									</li>
								</ul>
							</form>
						</div>
					</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>

    <!-- DISCOVER MORE -->
    <div class="container">
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="con-title">
                    <h2>Discover <span>More</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="ed-course">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="ed-course-in">
                            <a class="course-overlay" href="about.html">
                                <img src="images/h-about.jpg" alt="">
                                <span>Academics</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="ed-course-in">
                            <a class="course-overlay" href="admission.html">
                                <img src="images/h-adm1.jpg" alt="">
                                <span>Admission</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="ed-course-in">
                            <a class="course-overlay" href="#.html">
                                <img src="images/h-cam.jpg" alt="">
                                <span>Students Login</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="ed-course-in">
                            <a class="course-overlay" href="all-courses.html">
                                <img src="images/h-about1.jpg" alt="">
                                <span>Couse</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    <!-- POPULAR COURSES -->
    <div class="container">
    <section class="pop-cour">
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="con-title">
                    <h2>Popular <span>Courses</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <!--POPULAR COURSES-->

                        <!--POPULAR COURSES-->
                        <div class="home-top-cour">
                            <!--POPULAR COURSES: CONTENT-->
                            <div class="col-md-9 home-top-cour-desc">
                                <a href="#">
                                    <h3>A.D.C.A</h3>
                                </a>
                                <h4>Advance Diploma in Computer Application
                                </h4>
                                <p>This is Diploma course, in which you will learn basics of Computer like Tally, DOS, Hindi & English Typing etc. there are total 20 Subjects uder ADCA you are gonna learn</p> 
                         
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <!--POPULAR COURSES-->
                        <div class="home-top-cour">
                            <!--POPULAR COURSES IMAGE-->
                            <!--POPULAR COURSES: CONTENT-->
                            <div class="col-md-9 home-top-cour-desc">
                                <a href="#">
                                    <h3>C.C.C</h3>
                                </a>
                                <h4>Course on Computer Concepts</h4>
                                <p>The course is aimed at integrating necessary programming skills and teaching people how to use computers. After finishing this program, computers can be easily used for various purposes such as typing letters, sending emails, reading news, shopping online, social media and much more.</p>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-md-6">
                    <div>
                        <!--POPULAR COURSES-->
                        <div class="home-top-cour">
                            <!--POPULAR COURSES IMAGE-->
                            <!--POPULAR COURSES: CONTENT-->
                            <div class="col-md-9 home-top-cour-desc">
                                <a href="#">
                                    <h3>D.C.A</h3>
                                </a>
                                <h4>Diploma in Computer Applications</h4>
                                <p>In This Program you're going to learn Topics like : </p>
								<ul>
								
								<li>Computer Concepts and Fundamentals</li>
								<li>Operating System</li>
								<li>Microsoft Office (Whole Package like excel, ppt etc.)</li>
								<li>Front End Concept like HTML</li>
								<h5 style="color:orange">Eligibility Criteria</h5>
								<p>10th Pass student is eligible for this course</p>
								<h5 style="color:orange">Duration</h5>
								<p>6 Months</p>
							    
								
								
								
								</ul>
								
								
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-md-6">
                    <div>
                        <!--POPULAR COURSES-->
                        <div class="home-top-cour">
                            <!--POPULAR COURSES IMAGE-->
                            <!--POPULAR COURSES: CONTENT-->
                            <div class="col-md-9 home-top-cour-desc">
                                <a href="#">
                                    <h3>D.T.P</h3>
                                </a>
                                <h4>Certificate Course in DeskTop Publihing</h4>
                                <p>In This Program you're going to learn Topics like : </p>
								<ul>
								
								<li>Computer Concepts and Fundamentals with Introduction to Internet and Email</li>
								<li>Operating System</li>
								<li>Adobe Page Maker</li>
								<li>Adobe PhotoShop</li>
								<li>Corel Draw</li>
								<h5 style="color:orange">Eligibility Criteria</h5>
								<p>10th Pass student is eligible for this course</p>
								<h5 style="color:orange">Duration</h5>
								<p>4 Months</p>
							    
								
								
								
								</ul>
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


    <!-- NEWS AND EVENTS -->
    <div class="container">
    <section>
        <div class="container com-sp">
            <div class="row">
                <div class="col-md-4">
                    <div class="bot-gal h-gal ho-event-mob-bot-sp">
                        <h4>Students While Learning</h4>
                        <ul>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/8.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/9.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/10.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/11.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/1.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/2.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/3.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/4.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/5.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/6.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/7.jpg" alt="">
                            </li>
                            <li><img class="materialboxed" data-caption="Hotel Captions" src="images/ami/8.jpg" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bot-gal h-vid ho-event-mob-bot-sp">
                        <h4>Know About Us</h4>
                        <iframe src="https://www.youtube.com/embed/o0Zd8UPGOCU" allowfullscreen></iframe>
                        <h5>Student Computer Academy</h5>
                        <p>We are giving computer educations to rural Students since 2008.</p>
                        <p>We provide various courses such as ADCA, CCC, Tally....and much more skill based computer courses and we are proud on ourself that we have achieved excellence in teaching students in far easier as easiest as possible...and hopefully in future we will add more values to students and Village in education sector Thank-You/ </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <!--<div class="ho-ex-title">
							<h4>Upcoming Event</h4>
						</div>-->
                    <div class="ho-ev-latest ho-ev-latest-bg-3">
                        <div class="ho-lat-ev">
                            <h4>Results</h4>
                            <p><b>student have to enter roll number and her/his Official Name, to get the Results</b></p>
                        </div>
                    </div>
                    <div class="ho-st-login" style="padding-bottom:100px !Important;">
                   
                        <div id="hom-vijay" class="col s12">
                            <form class="col s12" method="POST" action="s_chk_res.php">
                                <div class="row">
                                    <div class="input-field col s12">
                                      <select name="cour">
                                        <option>Select Course</option>
                                        <option value="ADCA">ADCA</option>
                                        <option value="TALLY">TALLY</option>
                                        <option value="TYPING">TYPING</option>
                                        <!--<option value="DTP">DTP</option>-->
                                      </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="validate" name="r_n">
                                        <label>Roll Number</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="submit" value="Check" class="waves-effect waves-light light-btn" name="chsubmit">
                                    </div>
                                </div>
                                <p style="text-align: center; margin-top:20px;"><a href="https://result.scait.in/" alt="new result" style="color:red ;font-weight: bold"> New Result Portal </a></p>
                            </form>
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


    <!-- FOOTER -->
     <!-- FOOTER COURSE BOOKING -->
     <div class="container">
        <section>
    <div class="full-bot-book">
        <div class="container">
            <div class="row">
                <div class="bot-book">
                    <div class="col-md-2 bb-img">
                        <img src="images/3.png" alt="">
                    </div>
                    <div class="col-md-7 bb-text">
                        <h4>Having any query or doubts</h4>
                        <p>Feel Free to call Us and get rid of your doubts or query...call us between 8:00 AM to 6:00PM , Thank-You!!</p>
                    </div>
                    <div class="col-md-3 bb-link">
                        <a href="tel:8736002004">Click to Call</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
          
</section>
</div>

<!--Grid row-->
<!-- FOOTER -->
<section class="wed-hom-footer">
    <div class="container">
<div class="row" style="margin:0px auto;">



  <!--Grid column-->
  <div class="col-md-6 mb-4">

    <!--Card-->
    <div class="card card-cascade narrower">

      <!--Card image-->
      <div class="view view-cascade gradient-card-header peach-gradient">
        <h5 class="mb-0">Our Location</h5>
      </div>
      <!--/Card image-->

      <!--Card content-->
      <div class="card-body card-body-cascade text-center">

        <!--Google map-->
        <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
          <iframe 
             src="https://maps.google.com/maps?q=chicago&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
        </div>


      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
  <!--Grid column-->

</div>
        <div class="row wed-foot-link">
            <div class="col-md-4 foot-tc-mar-t-o">
                <h4>Top Courses</h4>
                <ul>
                    <li><a href="#">DOS</a></li>
                    <li><a href="#">Operating System</a></li>
                    <li><a href="#">MS Office</a></li>
                    <li><a href="#">C-Programming</a></li>
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">PhotoShop</a></li>
                    <li><a href="#">Page Maker</a></li>
                    <li><a href="#">Coral Draw</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>New Courses</h4>
                <ul>
                    <li><a href="#">Tally</a></li>
                    <li><a href="#">Basics of Networkin</a></li>
                    <li><a href="#">Web Design/Development</a></li>
                    <li><a href="#">SEO</a></li>
                    <li><a href="#">Hindi Typing</a></li>
                    <li><a href="#">English Typing/a></li>
                    <li><a href="#">Information technology</a></li>
                </ul>
            </div>
        </div>
        <div class="row wed-foot-link-1">
            <div class="col-md-4 foot-tc-mar-t-o">
                <h4>Get In Touch</h4>
                <p>Address: Tewa, Kaushambi Uttar Pradesh IN</p>
                <p>Phone: <a href="tel:8736002004">+918736002004</a></p>
                <p>Email: <a href="mail-to:scaitin@scait.in">scaitin@scait.in</a></p>
            </div>
            <div class="col-md-4">
                <h4>DOWNLOAD OUR FREE MOBILE APP</h4>
                <ul>
                    <li><a href="#"><span class="sprite sprite-android"></span></a>
                    </li>
                </ul>
            </div>
          <!--Grid row-->

            <div class="col-md-4">
                <h4>SOCIAL MEDIA</h4>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <!-- <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    </li> -->
                    <li><a href="https://api.whatsapp.com/send?phone=+918736002004"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  
</section>




    <!--SECTION LOGIN, REGISTER AND FORGOT PASSWORD-->
    <section>
        <!-- LOGIN SECTION -->
        <div id="modal1" class="modal fade" role="dialog">
            <div class="log-in-pop">
                <div class="log-in-pop-right">
                    <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                    </a>
                    <h4>Login for Admins</h4>
                    
                    <form class="s12" method="POST" action="admin_log.php">
                        <div>
                            <div class="input-field s12">
                                <input type="text" data-ng-model="name" class="validate" name="admin">
                                <label>User name</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                                <input type="password" class="validate" name="adpass">
                                <label>Password</label>
                            </div>
                        </div>
                       
                        <div>
                            <div class="input-field s4">
                                
                          <button type="submit" class="btn btn-secondary btn-sm" name="adsubmit">Login</button> </div>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
        <!-- REGISTER SECTION -->
        <div id="modal2" class="modal fade" role="dialog">
            <div class="log-in-pop">
                <div class="log-in-pop-right">
                    <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                    </a>
                    <h4>Create an Account</h4>
                    <p>Don't have an account? Create your account. It's take less then a minutes</p>
                    <form class="s9" method="POST" action="s_det.php" enctype="multipart/form-data">
                        <div>
                            <div class="input-field s12">
                                <input type="text" data-ng-model="name1" class="validate" required="" name="name">
                                <label>Full Name</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                                <input type="number" class="validate" required="" name="phon">
                                <label>Phone Number</label>
                            </div>
                        </div>
                    <div>
                       <div class="form-group">
                         <p>Select Your Course</p>
                        <select class="" id="sel1" name="course" required>
                          <option>SELECT COURSE</option>
                          <option value="ADCA">ADCA</option>
                          <option value="DCA">DCA</option>
                          <option value="CCC">CCC</option>
                          <option value="DTP">DTP</option>
                          <option value="OTHER">OTHER</option>
                        </select>
                      </div> 
                      </div>
                        <div>
                            <div class="input-field s12" id="pass1">
                                <input type="text" class="validate" required="" name="pass">
                                <label>Password</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12" id="pass2">
                                <input type="text" class="validate"  required="" name="pasc">
                                <label>Confirm Password</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                              <p>Upload Your Image</p>
                                <input type="file" class="validate" maxlength="8" required="" style="width:100%;" accept="image/*" name = "file" required>
                              
                            
                            </div>
                        </div>
                        <div>
                            <div class="input-field s4">
                            
                 <button type="submit" class="btn btn-secondary btn-sm" name="submit">Register</button> 
                     
                          
                          </div>
                          
                        </div>
                        <div>
                            <div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal1">Are you a already member ? Login</a> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FORGOT SECTION -->
        <div id="modal3" class="modal fade" role="dialog">
            <div class="log-in-pop">
                <div class="log-in-pop-left">
                    <h1>Hello... </h1>
                    <p>Don't have an account? Create your account. It's take less then a minutes</p>
                    <h4>Login with social media</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
                        </li>
                        <li><a href="#"><i class="fa fa-google"></i> Google+</a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                    </ul>
                </div>
                <div class="log-in-pop-right">
                    <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                    </a>
                    <h4>Forgot password</h4>
                    <p>Don't have an account? Create your account. It's take less then a minutes</p>
                    <form class="s12">
                        <div>
                            <div class="input-field s12">
                                <input type="text" data-ng-model="name3" class="validate">
                                <label>User name or email id</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s4">
                                <input type="submit" value="Submit" class="waves-effect waves-light log-in-btn"> </div>
                        </div>
                        <div>
                            <div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal1">Are you a already member ? Login</a> | <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal2">Create a new account</a> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>


</body>


</html>