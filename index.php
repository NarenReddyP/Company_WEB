<?php
session_start();
if($_SESSION['UserID']!=""){

ini_set('display_errors',1);

$Uhost = "localhost";
$Utype = "root";
$Upass = "";
$Udb   = "company_web";

$conn1 = mysqli_connect($Uhost,$Utype,$Upass,$Udb);

if(!$conn1){
die("ERROR: mysql db connection error ".mysqli_error());
}

if(isset($_POST['Usubmitdata'])){

    $UserName = mysqli_real_escape_string($conn1, $_POST['Uuser']);
    $UEmail   = mysqli_real_escape_string($conn1, $_POST['email']);
    $UMobile  = mysqli_real_escape_string($conn1, $_POST['mobile']);
    $UCompany = mysqli_real_escape_string($conn1, $_POST['CompanyNM']);
    $Utext    = mysqli_real_escape_string($conn1, $_POST['msg_text']);

    $rowss     = "select * from `users_information` where email='$UEmail' ";
    $ress      = mysqli_query($conn1,$rowss);

   if (!preg_match("/^[a-zA-Z ]+$/",$UserName)) {
   $name_error = "**Name must contain only alphabets and space**";
   }
   else if(mysqli_num_rows($ress) > 0){
     $row = mysqli_fetch_assoc($ress);
     if($UEmail==isset($row['Email'])){
     $_SESSION['fail']=0;

     }
   }
   else if(!filter_var($UEmail,FILTER_VALIDATE_EMAIL)) {
   $email_error = "**Please Enter Valid Email ID**";
   }
   #$error = $name_error = $email_error = $password_error = $mobile_error = $cpassword_error;
   else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$UCompany)) {
   $websiteErr = "URL is not valid";
   }
   else if (empty($_POST['UserID'])) {

     $sql1 = "INSERT INTO `users_information` (`UserName`, `Email`,`Mobile`, `CompanyName`, `User_Msg`,`Date`) VALUES ('$UserName', '$UEmail','$UMobile', '$UCompany', '$Utext', now())";
   if(mysqli_query($conn1, $sql1)) {
     echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
   <h4></i>Your data submited successfully</h4>
   </div>';


   #header("location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
   #exit();
   } else {
   echo "Error: " . $sql1 . "" . mysqli_error($conn1);
   }
   }
   mysqli_close($conn1);
   }



#}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Company Web</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Favicon-->
    <link rel="shortcut icon" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/favicon/favicon-16x16.png">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/Bootstrap_css/bootstrap.css">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--Fontawesome Icons-->
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/fontawesome_css/all.min.css">
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/fontawsome_js/all.min.js"></script>

    <!-- Including the bootstrap CDN -->
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
    </script>

    <!--Owl Carousel-->
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/Owl-carousel_css/owl.carousel.min.css">
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/Owl-carousel_css/owl.theme.default.min.css">

    <!--Responsive-tabs CSS-->
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/Responsive-tabs_css/responsive-tabs.css">

    <!--Magnific Popup CSS-->

    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/magnific-popup_css/magnific-popup.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="/PHP_WORK/CompleteWeb/GlassLoginform/C_CSS/mystyle.css">
    <!--JQery -->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="75">
    <!--Preloader  -->
    <div id="preloader">
        <div id="preloader_status">&nbsp;</div>
    </div>
    <!--Preloader Ends -->

   <!--Header  -->
   <header class="sticky">

   <nav class="navbar fixed-top navbar-expand-md ">

   <!--Logo [this is class white-nav-top] -->
   <a class="navbar-brand  smooth-scroll logo" href="#home">
       <img src="http://localhost/PHP_WORK/CompleteWeb/GlassLoginform/C_img/favicon/favicon-32x32.png" alt="LOGO">

   </a>

     <!--
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

         <div class="menuToggle" onclick="toggleMenu();"><i class="fas fa-bars"></i></div> -->

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
         <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
         </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto navigation">

            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#home" onclick="toggleMenu();">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#about" onclick="toggleMenu();">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#team" onclick="toggleMenu();">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#services" onclick="toggleMenu();">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#portfolio" onclick="toggleMenu();">Work</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#blog" onclick="toggleMenu();">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link smooth-scroll" href="#contact" onclick="toggleMenu();">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="logandreg.php" >Logout</a>

            </li>

          </ul>

        </div>
    </nav>

   </header>
   <!--Header Ends -->


    <!--Home  -->
    <section id="home">
        <!--Background Video  -->
        <video id="home-bg-video" poster="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Videoposter.jpg" autoplay muted loop>
            <source src="/PHP_WORK/CompleteWeb/GlassLoginform/C_Videos/GoldenV1.mp4">
        </video>
        <!--Overlay-->
        <div id="home-overlay"> </div>
        <!-- Home Content  -->
        <div id="home-content">
            <div id="home-content-inner" class="text-center">
                <div id="home-heading">
                    <h1 id="home-heading-1">Company Web</h1><br>
                    <h1 id="home-heading-2"><span>Creative</span>Web Developers</h1>
                </div>
                <div id="home-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi eum iusto enim quis ab hic modi, consectetur ullam architecto corrupti totam non alias.</p>
                </div>
                <div id="home-btn">
                    <a class="btn btn-general btn-home smooth-scroll" role="button" title="Start Now" href="#about">START NOW</a>
                </div>
            </div>
        </div>
        <!--Arrow Down-->
        <a href="#about" id="arrow-down" class="smooth-scroll"><i class="fas fa-chevron-circle-down"></i></a>
    </section>
    <!--Home Ends -->


    <!--About  -->
    <section id="about">
        <!--About 01 -->
        <div id="about-01">

            <div class="content-box-lg">
                <div class="container">
                    <div class="row">

                        <!--About Left Side-->
                        <div class="col-md-6">

                            <div id="about-left">
                                <div class="vertical-heading">
                                    <h5>Who We Are</h5>
                                    <h2>A <strong>Story</strong><br>About Us</h2>
                                </div>
                            </div>
                        </div>

                        <!--About right Side-->
                        <div class="col-md-6">

                            <div id="about-right">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates quo sunt sapiente placeat ducimus praesentium et, perspiciatis blanditiis? Laborum corporis quo quaerat numquam ab, nesciunt sed a voluptatem fugit vel.</p>
                            </div>
                        </div>

                    </div>

                    <!--About Bottom-->

                    <div class="row">
                        <div class="col-md-12">

                            <div id="about-bottom">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/apple-bg.jpg" class="img-fluid" alt="About Us">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!--About 01 Ends -->

        <!--About 02 -->

        <div id="about-02">

            <div class="content-box-md">
                <div class="container">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="about-item text-center">

                                <span>
                                    <i class="fas fa-rocket"></i>
                                </span>
                                <h3>Mission</h3>
                                <hr>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque fuga soluta tempore ipsum officia obcaecati quia repudiandae, quis similique impedit est, esse. Incidunt nulla cumque dolorum quo aliquam sequi quia!</p>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="about-item text-center">
                                <span>
                                    <i class="fas fa-eye"></i>
                                </span>
                                <h3>Vission</h3>
                                <hr>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque fuga soluta tempore ipsum officia obcaecati quia repudiandae, quis similique impedit est, esse. Incidunt nulla cumque dolorum quo aliquam sequi quia!</p>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="about-item text-center">
                                <span>
                                    <i class="fas fa-volleyball-ball"></i>
                                </span>
                                <h3>Passion</h3>
                                <hr>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque fuga soluta tempore ipsum officia obcaecati quia repudiandae, quis similique impedit est, esse. Incidunt nulla cumque dolorum quo aliquam sequi quia!</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--About 02 Ends-->

    </section>
    <!--About Ends-->


     <!--Team  -->
     <section id="team">
         <div class="content-box-lg">
             <div class="container">


                 <!--Team Members -->
                 <div class="row">
                     <!--Team Left Side -->

                     <div class="col-md-6">

                         <div id="team-left">
                             <div class="vertical-heading">
                                 <h5>Who We Are</h5>
                                 <h2>Meet Our<br><strong>Talented</strong> Team</h2>
                             </div>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint expedita saepe obcaecati porro quibusdam quam ea pariatur soluta asperiores, ad itaque deserunt culpa? Aspernatur, hic vel maiores animi? Nesciunt, ipsum.</p>
                         </div>
                     </div>

                     <!--Team Right Side -->

                     <div class="col-md-6">

                         <div id="team-members" class="owl-carousel owl-theme">


                             <!--Member 01 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member1.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Kumari</h6>
                                         <p>Web Devloper</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 02 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member2.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Kumari</h6>
                                         <p>Web Devloper</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 03 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member3.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Kumari</h6>
                                         <p>Web Devloper</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 04 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member4.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Kumari</h6>
                                         <p>Web Devloper</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 05 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member5.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Rasmi Kumari</h6>
                                         <p>Customer Sr.Executive</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 06 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member6.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Ragava Kumar</h6>
                                         <p>Ass Managing Director</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 07 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member7.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Kumar</h6>
                                         <p>Managing Director</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>

                             <!--Member 08 -->
                             <div class="team-member">
                                 <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/members_img/member9.jpg" alt="Team Member" class="img-fluid">
                                 <div class="team-member-overlay">
                                     <div class="team-member-info text-center">
                                         <h6>Krishna Vedika</h6>
                                         <p>Ass Managing Director</p>
                                         <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>


                         </div>

                     </div>

                 </div>


                 <div id="progress-elements">

                     <div class="row">
                         <div class="col-md-6">


                             <!--Skill 01 -->
                             <div class="skill">
                                 <h4>Web Development</h4>
                                 <div class="progress">
                                     <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"><span>95%</span></div>
                                 </div>
                             </div>


                         </div>
                         <div class="col-md-6">

                             <!--Skill 02 -->
                             <div class="skill">
                                 <h4>Logo Design</h4>
                                 <div class="progress">
                                     <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><span>80%</span></div>
                                 </div>
                             </div>

                         </div>
                         <div class="col-md-6">

                             <!--Skill 03 -->
                             <div class="skill">
                                 <h4>Web Design</h4>
                                 <div class="progress">
                                     <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span>85%</span></div>
                                 </div>
                             </div>


                         </div>
                         <div class="col-md-6">

                             <!--Skill 04 -->
                             <div class="skill">
                                 <h4>Digital Marketing</h4>
                                 <div class="progress">
                                     <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"><span>95%</span></div>
                                 </div>
                             </div>

                         </div>
                     </div>

                 </div>


             </div>
         </div>



     </section>
    <!--Team  Ends-->


    <!--Statement  -->
    <section id="statement">

        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tech-statement" class="text-center">
                            <div id="quote-box">
                                <h3><i class="fas fa-quote-left"></i> We design and develop stylish &#38; modern responsive websites. <i class="fas fa-quote-right"></i></h3>
                                <p>- Narendra Reddy-</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--Statement Ends -->


    <!--Services   -->
    <section id="services">


        <!-- Services Part 1  -->
        <div id="services-01">

            <div class="content-box-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="horizontal-heading text-center">
                                <h5>What We Do</h5>
                                <h2>Our Services</h2>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/monitor-bg.jpg" alt="Services 01" class="img-fluid">
                        </div>
                        <div class="col-md-5">

                            <!-- Service 01   -->
                            <div class="service">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="icon text-right">
                                            <i class="fas fa-paint-brush"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <h5>Service 01</h5>
                                        <h4>Web Design</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio iste libero eos nulla quibusdam id, animi placeat suscipit, magni blanditiis magnam hic voluptatem.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Service 02   -->
                            <div class="service">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="icon text-right">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <h5>Service 02</h5>
                                        <h4>Web Development</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio iste libero eos nulla quibusdam id, animi placeat suscipit, magni blanditiis magnam hic voluptatem.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Service 03   -->
                            <div class="service">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="icon text-right">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <h5>Service 03</h5>
                                        <h4>Digital Marketing</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio iste libero eos nulla quibusdam id, animi placeat suscipit, magni blanditiis magnam hic voluptatem.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </div>
         <!-- Services Part 1 Ends  -->


       <!--  Services Part 2  -->
           <div id="services-02">
                   <div class="content-box-md">

                   <div id="services-tabs">
                       <ul class="text-center">
                           <li><a href="#service-tab-1">Creativity</a></li>
                           <li><a href="#service-tab-2">Strategy</a></li>
                           <li><a href="#service-tab-3">Design</a></li>
                           <li><a href="#service-tab-4">Development</a></li>

                       </ul>


                   <!-- service Tab 01 -->
                   <div id="service-tab-1">
                       <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                             <img class="img-size" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/service-tab1.jpg" alt="Service Tab 01" width="400" height="400">
                           </div>

                           <div class="col-md-6">

                             <div class="tab-bg">
                                 <h2>01</h2>
                                 <h3>Get More From Life with Creativity</h3>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi inventore saepe laudantium, possimus optio mollitia eligendi minima eaque ratione cum odit eos necessitatibus quis magni obcaecati provident quae autem dolores.</p>

                                 <div id="service-btn">
                                        <a class="btn btn-general btn-yellow" role="button" title="Get In Touch" href="#about">Get In Touch</a>
                                 </div>
                             </div>
                           </div>

                       </div>
                     </div>
                   </div>

                    <!-- service Tab 02 -->
                   <div id="service-tab-2">
                       <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                             <img class="img-size" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/service-tab2.jpg" alt="Service Tab 02" width="400" height="400">
                           </div>

                           <div class="col-md-6">

                             <div class="tab-bg">
                                 <h2>02</h2>
                                 <h3>Get More From Life with Creativity</h3>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi inventore saepe laudantium, possimus optio mollitia eligendi minima eaque ratione cum odit eos necessitatibus quis magni obcaecati provident quae autem dolores.</p>

                                 <div id="service-btn">
                                        <a class="btn btn-general btn-yellow" role="button" title="Get In Touch" href="#about">Get In Touch</a>
                                 </div>
                             </div>
                           </div>

                       </div>
                     </div>
                   </div>

                    <!-- service Tab 03 -->
                   <div id="service-tab-3">
                       <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                             <img class="img-size" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/service-tab3.jpg" alt="Service Tab 03" width="400" height="400">
                           </div>

                           <div class="col-md-6">

                             <div class="tab-bg">
                                 <h2>03</h2>
                                 <h3>Get More From Life with Creativity</h3>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi inventore saepe laudantium, possimus optio mollitia eligendi minima eaque ratione cum odit eos necessitatibus quis magni obcaecati provident quae autem dolores.</p>

                                 <div id="service-btn">
                                        <a class="btn btn-general btn-yellow" role="button" title="Get In Touch" href="#about">Get In Touch</a>
                                 </div>
                             </div>
                           </div>

                       </div>
                     </div>
                   </div>

                    <!-- service Tab 04 -->
                   <div id="service-tab-4">
                       <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                             <img class="img-size" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/service-tab4.jpg" alt="Service Tab 04" width="400" height="400">
                           </div>

                           <div class="col-md-6">

                             <div class="tab-bg">
                                 <h2>04</h2>
                                 <h3>Get More From Life with Creativity</h3>
                                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi inventore saepe laudantium, possimus optio mollitia eligendi minima eaque ratione cum odit eos necessitatibus quis magni obcaecati provident quae autem dolores.</p>

                                 <div id="service-btn">
                                        <a class="btn btn-general btn-yellow" role="button" title="Get In Touch" href="#about">Get In Touch</a>
                                 </div>
                             </div>
                           </div>

                       </div>
                     </div>
                   </div>

                   </div>
               </div>
           </div>
       <!--Services Part 2 Ends -->

        </section>
    <!--Services Ends -->


    <!--Work  -->
    <section id="portfolio">

        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                       <div class="vertical-heading">
                           <h5>Find Our Work</h5>
                           <h2>Our<br>Amazing<strong> WORK</strong></h2>
                       </div>
                    </div>

                    <div class="col-md-12">
                        <div class="portfolio-buttons">
                          <button class="btn active" data-filter="*">All</button>
                          <button class="btn" data-filter=".web">Web</button>
                          <button class="btn" data-filter=".logo">Logo</button>
                          <button class="btn" data-filter=".mobile">Mobile</button>
                          <button class="btn" data-filter=".desktop">Desktop</button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Portfolio Items Wrapper -->

            <section id="portfolio-wrapper">


                    <div class="container">
                        <div class="row grid">

                               <!-- Portfolio Item 1 -->
                               <div class="col-md-3 portfolio-item logo">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry1.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry1.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Logo</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Logo,of Netflix</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 2 -->
                               <div class="col-md-3 portfolio-item logo">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry2.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry2.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Logo</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Logo, of BMW</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 3 -->
                               <div class="col-md-3 portfolio-item mobile">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry3.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry3.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Mobile</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Mobile, view</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 4 -->
                               <div class="col-md-3 portfolio-item logo">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry4.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry4.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Logo</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Logo,of BMW full view</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 5 -->
                               <div class="col-md-3 portfolio-item mobile">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry5.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry5.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Mobile</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Mobile,back view</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 6 -->
                               <div class="col-md-3 portfolio-item web desktop">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry9.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry9.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Desktop</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Desktop,of Computers view</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 7 -->
                               <div class="col-md-3 portfolio-item web desktop">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry7.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry7.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Desktop</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Desktop,of Computers</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                                <!-- Portfolio Item 8 -->
                               <div class="col-md-3 portfolio-item mobile">

                               <a href="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry8.jpg" title="Description">
                                   <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/img_gallory/img-galry8.jpg" class="img-fluid" alt="Portfolio Item" width="400" height="400">

                                   <div class="portfolio-item-overlay">
                                       <div class="portfolio-item-details text-center">

                                           <!--  Item Header-->
                                           <h3>Mobile</h3>

                                           <!--  Item strips-->
                                           <span></span>


                                           <!--  Item Description-->
                                           <p>Mobile, app view</p>

                                       </div>

                                   </div>

                               </a>

                               </div>

                        </div>

                    </div>



            </section>

            <!-- Portfolio Items Wrapper Ends -->



        </div>

    </section>
    <!--Work Ends -->


    <!--  Testimonials   -->
    <section id="testimonials">


            <div class="container">
                <div class="row">


                    <div class="col-md-3">

                       <div class="vertical-heading">
                           <h5>Who We Are</h5>
                           <h2>What Our<br><strong>Customers</strong> Say</h2>
                       </div>

                    </div>

                    <div class="col-md-9">


                     <div id="testmonial-slider" class="owl-carousel owl-theme">

                        <!--  Testimonials 01  -->
                        <div class="testimonial">
                            <div class="row">

                                <div class="col-md-6">
                                <h3>Quality Support</h3>
                                </div>

                                <div class="col-md-6">
                                   <div class="stars text-right">
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                   </div>
                                 </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ipsum perferendis quaerat quam ab. Natus nemo eos similique minus impedit. Suscipit expedita neque totam omnis. Fugit aliquid nesciunt quia ipsam.</p>


                          <div class="row author">
                              <div class="col-md-2">

                              <img class="img-fluid rounded-circle" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client_5.jpg" alt="Customer">

                              </div>
                              <div class="col-md-10">

                                 <div class="author-details">
                                     <p>Full Name</p>
                                     <p>Description</p>
                                 </div>

                              </div>
                          </div>
                        </div>


                         <!--  Testimonials 02  -->
                        <div class="testimonial">
                            <div class="row">

                                <div class="col-md-6">
                                <h3>Quality Support</h3>
                                </div>

                                <div class="col-md-6">
                                   <div class="stars text-right">
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                   </div>
                                 </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ipsum perferendis quaerat quam ab. Natus nemo eos similique minus impedit. Suscipit expedita neque totam omnis. Fugit aliquid nesciunt quia ipsam.</p>


                          <div class="row author">
                              <div class="col-md-2">

                              <img class="img-fluid rounded-circle" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client_0.jpg" alt="Customer" style="height: 135px;">

                              </div>
                              <div class="col-md-10">

                                 <div class="author-details">
                                     <p>Full Name</p>
                                     <p>Description</p>
                                 </div>

                              </div>
                          </div>
                        </div>


                         <!--  Testimonials 03  -->
                        <div class="testimonial">
                            <div class="row">

                                <div class="col-md-6">
                                <h3>Quality Support</h3>
                                </div>

                                <div class="col-md-6">
                                   <div class="stars text-right">
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                   </div>
                                 </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ipsum perferendis quaerat quam ab. Natus nemo eos similique minus impedit. Suscipit expedita neque totam omnis. Fugit aliquid nesciunt quia ipsam.</p>


                          <div class="row author">
                              <div class="col-md-2">

                              <img class="img-fluid rounded-circle" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client_6.jpg" alt="Customer" style="height: 135px;">

                              </div>
                              <div class="col-md-10">

                                 <div class="author-details">
                                     <p>Full Name</p>
                                     <p>Description</p>
                                 </div>

                              </div>
                          </div>
                        </div>

                         <!--  Testimonials 04  -->
                        <div class="testimonial">
                            <div class="row">

                                <div class="col-md-6">
                                <h3>Quality Support</h3>
                                </div>

                                <div class="col-md-6">
                                   <div class="stars text-right">
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                       <i class="fas fa-star"></i>
                                   </div>
                                 </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ipsum perferendis quaerat quam ab. Natus nemo eos similique minus impedit. Suscipit expedita neque totam omnis. Fugit aliquid nesciunt quia ipsam.</p>


                          <div class="row author">
                              <div class="col-md-2">

                              <img class="img-fluid rounded-circle" src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client1.jpg" alt="Customer">

                              </div>
                              <div class="col-md-10">

                                 <div class="author-details">
                                     <p>Full Name</p>
                                     <p>Description</p>
                                 </div>

                              </div>
                          </div>
                        </div>

                     </div>

                    </div>

                </div>

            </div>

    </section>
    <!--Testimonials  Ends -->


    <!--Pricing  -->
    <section id="pricing">

        <div class="content-box-md">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">

                       <div class="horizontal-heading text-center">
                           <h5>Super Customers</h5>
                           <h2>Our Pricing</h2>
                       </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">


                        <!--  Pricing box 01 -->

                    <div class="pricing-box">
                        <div class="type">
                             <h4>Basic</h4>
                        </div>
                          <div class="price">
                            <div class="row">
                                <div class="col-md-4">

                                        <h2><span class="dollar">&#36;</span>25<br><span class="month">Month</span></h2>

                                </div>
                                <div class="col-md-8">
                                        <p>You will get all these special services with this great price. Get It Now!</p>
                                </div>
                            </div>
                          </div>
                        <div>
                            <ul class="package">

                                <li><span><i class="fas fa-hand-point-right"></i></span>Full Access</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Admin Cpanel</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Unlimited Bandwidth</li><span></span>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Email Account</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>24 × 7 Support</li>

                            </ul>

                             <div id="pricing-btn">
                                <a class="btn btn-general btn-yellow" role="button" title="Get Started" href="#about">Get Started</a>
                             </div>
                        </div>
                    </div>



                    </div>
                    <div class="col-md-4">

                       <!--  Pricing box 02 -->

                    <div class="pricing-box black">
                        <div class="type">
                             <h4>Unlimited</h4>
                        </div>
                          <div class="price">
                            <div class="row">
                                <div class="col-md-4">

                                        <h2><span class="dollar">&#36;</span>50<br><span class="month">Month</span></h2>

                                </div>
                                <div class="col-md-8">
                                        <p>You will get all these special services with this great price. Get It Now!</p>
                                </div>
                            </div>
                          </div>
                        <div>
                            <ul class="package">

                                <li><span><i class="fas fa-hand-point-right"></i></span>Full Access</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Admin Cpanel</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Unlimited Bandwidth</li><span></span>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Email Account</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>24 × 7 Support</li>

                            </ul>

                             <div id="pricing-btn">
                                <a class="btn btn-general btn-yellow" role="button" title="Get Started" href="#about">Get Started</a>
                             </div>
                        </div>
                    </div>

                    </div>
                    <div class="col-md-4">
                       <!--  Pricing box 03 -->


                    <div class="pricing-box">
                        <div class="type">
                             <h4>Business</h4>
                        </div>
                          <div class="price">
                            <div class="row">
                                <div class="col-md-4">

                                        <h2><span class="dollar">&#36;</span>75<br><span class="month">Month</span></h2>

                                </div>
                                <div class="col-md-8">
                                        <p>You will get all these special services with this great price. Get It Now!</p>
                                </div>
                            </div>
                          </div>
                        <div>
                            <ul class="package">

                                <li><span><i class="fas fa-hand-point-right"></i></span>Full Access</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Admin Cpanel</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Unlimited Bandwidth</li><span></span>
                                <li><span><i class="fas fa-hand-point-right"></i></span>Email Account</li>
                                <li><span><i class="fas fa-hand-point-right"></i></span>24 × 7 Support</li>

                            </ul>

                             <div id="pricing-btn">
                                <a class="btn btn-general btn-yellow" role="button" title="Get Started" href="#about">Get Started</a>
                             </div>
                        </div>
                    </div>


                    </div>

                </div>


            </div>

        </div>

    </section>
    <!--Pricing Ends -->

    <!--Stats    -->
    <section id="stats">

        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                       <div class="vertical-heading">
                           <h5>Fun Facts</h5>
                           <h2>We Deliver<br><strong>Excellent</strong> Services</h2>
                       </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3">

                        <!--Stats Item 01   -->
                        <div class="stats-item text-centr">
                            <span><i class="fas fa-hourglass-half"></i></span>
                            <h3 class="counter">20</h3>
                            <p>Years Experience</p>
                        </div>
                    </div>


                    <div class="col-md-3">

                          <!--Stats Item 02   -->
                        <div class="stats-item text-centr">
                            <span><i class="fas fa-tasks"></i></span>
                            <h3 class="counter">369</h3>
                            <p>Projects Done</p>
                        </div>
                    </div>

                    <div class="col-md-3">

                          <!--Stats Item 03   -->
                        <div class="stats-item text-centr">
                            <span><i class="fas fa-trophy"></i></span>
                            <h3 class="counter">99</h3>
                            <p>Awards Received</p>
                        </div>
                    </div>

                    <div class="col-md-3">

                          <!--Stats Item 04   -->
                        <div class="stats-item text-centr">
                            <span><i class="fas fa-users"></i></span>
                            <h3 class="counter">344</h3>
                            <p>Happy Clients</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--Stats Ends -->


    <!--Clients    -->
    <section id="clients">

        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                       <div class="horizontal-heading text-center">
                           <h5>Satisfied Clients</h5>
                           <h2>Our Happy <strong>Clients</strong></h2>
                       </div>


                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div id="clients-list" class="owl-carousel owl-theme">

                            <!--Clients  01  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/custmer_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  02  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1Axis_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  03  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1hdfc_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  04  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1sbi_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  05  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1cub_logo.png" class="img-fluid" alt="Client">
                            </div>

                             <!--Clients  06  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1max_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  07  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1yesB_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  08  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1icici_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  09  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/1pizza_logo.png" class="img-fluid" alt="Client">
                            </div>

                            <!--Clients  10  -->
                            <div class="client">
                                <img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/Bg_img/Logos/PNG_logs/kfc_logo.png" class="img-fluid" alt="Client">
                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>

    </section>
    <!--Clients Ends -->


    <!--Blog    -->
    <section id="blog">

        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">

                       <div id="blog-left">
                           <div class="vertical-heading">
                               <h5>Latest News</h5>
                               <h2>Latest<br>From<strong> Blog</strong></h2>
                           </div>
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta ipsa quasi minima, dolorem aperiam nisi exercitationem commodi perspiciatis, sed excepturi impedit maxime dolorum itaque molestias consectetur ut labore debitis quas.</p>

                           <div id="blog-btn">
                                <a class="btn btn-general btn-yellow" role="button" title="View ALl Posts" href="#about">View All Posts</a>
                            </div>


                       </div>

                    </div>

                    <div class="col-md-8">

                       <div class="row">
                           <div class="col-md-6">

                            <!--Blog post 01   -->
                            <div class="blog-post">
                                <h4>Your Post Title</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos ex doloribus doloremque repudiandae minus, dolor similique. Atque, inventore.</p>
                                <a href="#">Read More > </a>

                                <div class="post-meta">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client_5.jpg" alt="Author" style="width: 200px; height: 200px">  Author Name</p>
                                        </div>

                                        <div class="col-md-6">
                                        <p class="text-right">January 10, 2022</p>
                                        </div>

                                    </div>
                                </div>
                            </div>


                           </div>

                           <div class="col-md-6">

                           <!--Blog post 02   -->
                            <div class="blog-post">
                                <h4>Your Post Title</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos ex doloribus doloremque repudiandae minus, dolor similique. Atque, inventore.</p>
                                <a href="#">Read More > </a>

                                <div class="post-meta">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><img src="/PHP_WORK/CompleteWeb/GlassLoginform/C_img/clients/client4.jpg" alt="Author" style="width: 200px; height: 200px">  Author Name</p>
                                        </div>

                                        <div class="col-md-6">
                                        <p class="text-right">March 10, 2022</p>
                                        </div>

                                    </div>
                                </div>
                            </div>


                           </div>

                       </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--Blog Ends -->


    <!--Contact   -->
    <section id="contact">

        <div class="content-box-md">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                       <!--Contact Left  -->
                       <div id="contact-left">
                           <div class="vertical-heading">
                               <h5>Who We Are</h5>
                               <h2>Get<br>In<strong> Touch</strong></h2>
                           </div>
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptates perferendis neque repellendus provident. Accusamus placeat, aut eos veritatis, aliquid nisi beatae quis tenetur autem obcaecati voluptates ullam, at soluta aliquid nisi beatae quis tenetur autem obcaecati voluptates ullam.</p>
                           <div id="office-addr">
                               <h5>Address Title</h5>
                               <ul class="office-details">
                                   <li><span><i class="fas fa-mobile-alt"></i></span>9999912345</li>
                                   <li><span><i class="fas fa-envelope"></i></span>Support@cw.com</li>
                                   <li><span><i class="fas fa-map-marked-alt"></i></span>Street Address, Hyderabad, Telangana, India, Pin Code: 500001</li>
                               </ul>
                           </div>
                                        <ul class="social-list">
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                             <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                             <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                       </div>

                    </div>

                    <div class="col-md-6">
                       <!--Contact Right  -->
                       <div id="contact-right">
                          <h4>Send Message</h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia vel pariatur, facilis maiores iste harum, unde tempore ad impedit eveniet perferendis.</p>
                            <?php

                            ?>
                           <form action="" method="POST" name="Uform" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <input type="text" name="Uuser" class="form-control" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <input type="email" name="email" class="form-control" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <input type="tel" name="mobile" class="form-control" placeholder="Mobile Number" minLength="10" maxLength="10" pattern="[7-9]{1}[0-9]{9}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <input type="text" name="CompanyNM" class="form-control" placeholder="Your Company Name">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                   <textarea class="form-control"  name="msg_text" id="msg-text" placeholder="Type message here..."></textarea>
                                </div>

                               <div id="contact-btn">
                                <button id="userbtnstyle" class="btn btn-general btn-yellow" role="button" title="Submit" href="#" name="Usubmitdata" type="submit" style="text-transform: uppercase;letter-spacing: 4px;">Submit <span><i class="fas fa-paper-plane"></i></span> </button>
                               </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Ends -->


    <!--Map    -->
    <section id="map">

        <div class="content-box-md">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3808.0461561493103!2d78.47223491459413!3d17.36151188809412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9744e8e8da55%3A0x30df6e48f86a6734!2sCharminar!5e0!3m2!1sen!2sin!4v1643971397668!5m2!1sen!2sin" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Map Ends -->


    <!--Footer    -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; 2022 All Rights Reserved by <span><a href="#"> CompanyWeb Ltd.</a></span></p>
                </div>
            </div>
        </div>

                                <a id="back-to-top" class="btn btn-general btn-yellow smooth-scroll" role="button" title="Submit" href="#home">
                                <span><i class="fas fa-chevron-circle-up"></i></span>
                                </a>

    </footer>
     <!--Footer Ends -->


    <!--Bootstrap JS-->
    <script src="PHP_WORK/CompleteWeb/GlassLoginform/C_JS/Bootstrap_js/bootstrap.js"></script>

    <!--Owl Carousel-->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/Owl-carousel/owl.carousel.min.js"></script>

    <!--Waypoints JS-->

    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/Waypoints/jquery.waypoints.min.js"></script>

    <!--Responsive-tabs JS-->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/Responsive-tabs_js/jquery.responsiveTabs.min.js"></script>

    <!--Isotope JS-->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/isotop/isotope.pkgd.min.js"></script>

    <!--Magnific Popup JS-->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/magnific-popup_js/jquery.magnific-popup.min.js"></script>

    <!--Counter JS-->

    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/counter_js/jquery.counterup.min.js"></script>

    <!--Easing Effect JS-->

    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/easing/jquery.easing.1.3.js"></script>

    <!-- MenuToggle  Effect JS-->

    <!--Custom JS-->
    <script src="/PHP_WORK/CompleteWeb/GlassLoginform/C_JS/myscript.js"></script>

    <!--error message user data submition-->
    <script>
    $(document).ready(function () {
        $("#flash-msg").delay(3000).fadeOut("slow");
    });
    </script>

</body>

</html>
<?php
}else {
  header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
}
?>
