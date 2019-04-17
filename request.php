<?php
// if there ia post
if(isset( $_POST['name']) && $_POST['name'] == "" || isset($_POST['email']) && $_POST['email'] == "" || isset( $_POST['subject']) && $_POST['subject'] == "") {
    $error = 'Please Fill All Fields';
}else {
    if(isset($_FILES) && (bool) $_FILES) {
        $AllowedExtensions = ["pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt"];
        $files = [];
        $server_file = [];
        foreach($_FILES as $name => $file) {
            $file_name = $file["name"];
            $file_temp = $file["tmp_name"];
            foreach($file_name as $key) {
                $path_parts = pathinfo($key);
                $extension = strtolower($path_parts["extension"]);
                if(!in_array($extension, $AllowedExtensions)) { die("Extension not allowed"); }
                $server_file[] = "uploads/{$path_parts["basename"]}";
            }
            for($i = 0; $i<count($file_temp); $i++) { move_uploaded_file($file_temp[$i], $server_file[$i]); }
        }
        $to = "shohag14748@gmail.com";
        $from = "jubokstp@premium70.web-hosting.com";
        $subject ="Application for employment";

        $job_name = $_POST['job_name'];
        $industry = $_POST['industry'];
        $time = $_POST['time'];
        $shift = $_POST['shift'];
        $location = $_POST['location'];
        $responsibility = $_POST['responsibility'];

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $message = "Message From The Outcome Network
        
                     Job Information
                        Job Name : ".$job_name."
                        Industry : ".$industry."
                        Time Frame : ".$time."
                        Shift : ".$shift."
                        Location : ".$location."
                        Responsibility : ".$responsibility."
                     Contact Information 
                        Name : ".$name."
                        Phone : ".$phone."
                        Email : ".$email." ";

        $headers = "From: $from";
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
        $message .= "--{$mime_boundary}\n";
        $FfilenameCount = 0;
        for($i = 0; $i<count($server_file); $i++) {
            $afile = fopen($server_file[$i],"rb");
            $data = fread($afile,filesize($server_file[$i]));
            fclose($afile);
            $data = chunk_split(base64_encode($data));
            $name = $file_name[$i];
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" .
                "Content-Disposition: attachment;\n" . " filename=\"$name\"\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}\n";
        }
        if(mail($to, $subject, $message, $headers)) {
            $error = "mail sent Successful";
        } else {
            $error =  "mail could not be sent!";
        }
    }


}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>The Outcome Network</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <!-- line icons -->
    <link rel="stylesheet" href="css/linearicons.css" type="text/css" />
    <!-- simple-line-icons-->
    <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />
    <!-- owl-carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup/magnific-popup.css" type="text/css" />
    <!-- shortcodes -->
    <link rel="stylesheet" href="css/shortcodes.css" type="text/css" />
    <!-- base -->
    <link rel="stylesheet" href="css/base.css" type="text/css" />
    <!-- Bootsnav -->
    <link rel="stylesheet" href="css/bootsnav.css" type="text/css" />
    <!-- Responsive -->
    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="clear-loading loading-effect"><img src="images/loading.gif" width="100" alt=""></div>
    </div>
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-sticky bootsnav">
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->
        <div class="container">
            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="icon-magnifier icons"></i></a></li>
                    <li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
                <a class="navbar-brand" href="index.html"><img src="images/brand/logo-1.png" class="logo logo-scrolled" alt=""> </a>
            </div>
            <!-- End Header Navigation -->
            <!-- Megamenu -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="active ">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Our Story</a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">About</a></li>
                            <li><a href="mission.html">Mission</a></li>
                            <li><a href="unique.html">How Are We Unique</a></li>
                            <li><a href="culture.html">Our Culture</a></li>
                            <li><a href="clients.html">Our Clients</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="services.html" class="dropdown-toggle" data-toggle="dropdown">Services</a>
                        <ul class="dropdown-menu">
                            <li><a href="services.html#staffing">Staffing</a></li>
                            <li><a href="services.html#transportation">Transportation</a></li>
                            <li><a href="services.html#behavior">Behavior Supports</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Employers</a>
                        <ul class="dropdown-menu">
                           <li><a href="providers.html">Our Service Providers</a></li>
                            <li><a href="request.php">Request Fof Employee</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Career Gateway</a>
                        <ul class="dropdown-menu">
                            <li><a href="testimonial.html">Testimonials</a></li>
                            <li><a href="application.php">Application for Employment</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- Start Side Menu -->
        <div class="side dark-bg">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <div class="widget">
                <p class="text-center my-3"><img  style="height: 50px; margin: 20px 0;" src="images/brand/logo-2.png" class="logo" alt="" /></p>
                <p>Our network connect people experiencing disability to support and services all across Ontari.</p>
            </div>
            <div class="widget">
                <h6 class="text-uppercase">OFFICE 01</h6>
                <ul class="list-unstyled address">
                    <li><i class="lnr lnr-map-marker"></i><span>The Outcome Network ON, Canada.</span></li>
                    <li><i class="lnr lnr-envelope"></i><span>otto@theoutcomenetwork.ca</span></li>
                    <li><i class="icon-phone"></i><span>705-881-4615</span></li>
                </ul>
            </div>
            <div class="widget">
                <div class="social-icons animated color">
                    <ul class="clearfix">
                        <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li class="social-youtube"><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
    <!-- Banner -->
    <section class="inner-intro dark-bg overlay jarallax" data-overlay-color="dark" data-overlay="8" data-bg-img="images/slide1.jpg" data-jarallax-video="https://www.youtube.com/watch?v=0aCbYxJ9gus">
        <div class="container">
            <div class="row intro-title">
                <div class="col-sm-12 text-center">
                    <h1 class="title">Request An Employee</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner -->
    <!-- Our service -->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left mt-1 ">
                    <h3 class="mb-1">Request an employee</h3>
                    <p>Are you looking for an outstanding staff? Please complete the form below or contact us directly:</p>
                    <div id="formmessage" style="color: red; margin-bottom: 20px;"><?php
                        if(isset($_POST['btn'])) {
                            if ($error) {
                                echo $error;
                            } else {
                                echo $error;
                            }
                        }
                        ?></div>
                    <form id="contactform" role="form" method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <h2 class='mb-1'>Job Information</h2>
                            <div class="form-group col-md-6">
                                <input type="text" name="job_name" id="" class="form-control" placeholder="Job Title*">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="industry" id="" class="form-control" placeholder="Industry*">
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control" name="time" id="" placeholder="Is this position temporary or full-time?">
                                    <option value="" disabled selected>Is this position temporary or full-time?</option>
                                    <option value="Temporary">Temporary</option>
                                    <option value="Full-time">Full-time</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="shift" id="" class="form-control" placeholder="Shift*">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="location" id="location" class="form-control" placeholder="Location*">
                            </div>

                            <div class="form-group col-md-12">
                                <textarea name="responsibility" id="responsibility" class="form-control" rows="3" placeholder="Duties &amp; Responsibilities"></textarea>
                            </div>
                            
                            <h2 class='mb-1'>Your Contact Information</h2>
                            
                            <div class="form-group col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name*">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone*">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                            </div>
                            <div class="form-group col-md-12">
                               <label for="file">Upload Your Job Description*</label>
                                <input type="file" name="attach[]" id="file" style="padding: 7px 20px; border: 2px solid #e6e6e6; width: 100%;" >
                            </div>

                            <div class="form-group col-md-12">
                                <button name="btn" type="submit" class="btn btn-default btn-rounded fill-dark">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Our service -->
    <!-- Footer -->
    <footer class="footer-dark">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                   <div class="col-sm-3 col-xs-6 col-xx-12 mb-4">
                        <h6 class="text-uppercase">About</h6>
                        <img style="width: 200px; margin-bottom: 20px" src="images/brand/logo-2.png" alt="">
                        <p>A Leader in Workforce Solutions and Behavior Support.</p>
                    </div>
                    <div class="col-sm-3 col-xs-6 col-xx-12 mb-4">
                        <h6 class="text-uppercase">Services</h6>
                        <ul class="list-unstyled">
                            <li><a href="services.html#staffing">Staffing</a></li>
                            <li><a href="services.html#transportation">Transportation</a></li>
                            <li><a href="services.html#behavior">Behavior Supports</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xs-6 col-xx-12 mb-4">
                        <h6 class="text-uppercase">Our Story</h6>
                        <ul class="list-unstyled">
                            <li><a href="about.html">About</a></li>
                            <li><a href="mission.html">Mission</a></li>
                            <li><a href="unique.html">How Are We Unique</a></li>
                            <li><a href="culture.html">Our Culture</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xs-6 col-xx-12 mb-4">
                        <h6 class="text-uppercase">Contact</h6>
                        <ul class="list-unstyled address">
                            <li><i class="lnr lnr-map-marker"></i><span>The Outcome Network ON, Canada.</span></li>
                            <li><i class="lnr lnr-envelope"></i><a href="mailto:otto@theoutcomenetwork.ca">otto@theoutcomenetwork.ca</a></li>
                            <li><i class="lnr lnr-phone-handset"></i><span>705-881-4615</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copy right -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">© Copyright By The Outcome Network All rights reserved And Designed by <a href="https://www.freelancer.com/hireme/mdakshohag">Ali Shohag</a>.</div>
                    <div class="col-sm-4 text-right">
                        <ul class="list-unstyled list-inline footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i> </a> </li>
                            <li><a href="#"> <i class="fa fa-google-plus"></i> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer -->
    <!-- Back to Top -->
    <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-chevron-up"></i></a></div>
    <!-- jquery  -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Appear -->
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <!-- owl-carousel -->
    <script type="text/javascript" src="js/owl-carousel/owl.carousel.min.js"></script>
    <!-- counter -->
    <script type="text/javascript" src="js/counter/jquery.countTo.js"></script>
    <!-- countdown -->
    <script type="text/javascript" src="js/countdown/jquery.downCount.js"></script>
    <!-- Piechart -->
    <script type="text/javascript" src="js/jquery.piechart.js"></script>
    <!-- magnific popup -->
    <script type="text/javascript" src="js/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- isotope -->
    <script src="js/isotope/isotope.pkgd.min.js"></script>
    <script src="js/isotope/imagesLoaded.js"></script>
    <!-- jarallax -->
    <script src="js/jarallax/jarallax.js"></script>
    <script src="js/jarallax/jarallax-video.js"></script>
    <!-- Bootsnavs -->
    <script src="js/bootsnav.js"></script>
    <!-- custom -->
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
