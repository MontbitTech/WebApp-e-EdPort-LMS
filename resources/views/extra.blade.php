<!doctype html>
<html lang="en">

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>e-EdPort</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('extra/assets/images/logo-1.png')}}')}}" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/LineIcons.css')}}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/magnific-popup.css')}}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/slick.css')}}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/animate.css')}}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/default.css')}}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('extra/assets/css/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            text-align: center;
            font-family: arial;
        }

        .hidden {
            display: none;
        }

        .header-btn li:nth-child(2) {
            display: none !important;
        }
    </style>
</head>

<body>
    <section class="header-area">
        <div class="navbar-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg mx-5">
                            <a class="navbar-brand" href="">
                                <img src="{{asset('extra/assets/images/logo-1.png')}}" style="height:70px;" alt="Logo">
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div id="home" class="header-hero bg_cover" style="background-image:url({{asset('extra/assets/images/bg3.jpg')}})">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 mx-0">
                        <div class="header-content text-center mx-0">
                            <h3 class="header-title wow fadeInUp mx-0" data-wow-duration=".7s" data-wow-delay="0.8s">
                                Providing Solutions for Systematic Growth of Teaching & Learning</h3>
                            <p class="text wow fadeInUp" style="color:#1a1a1a" data-wow-duration=".7s" data-wow-delay="0.9s">Understanding New Trends in Educational Technology</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-shape">
                <img src="{{asset('extra/assets/images/header-shape.svg')}}" alt="shape">
            </div>
        </div>
    </section>
    <div class="overlay-right"></div>
    <section class="pt-0 mt-0">
        <div class="container-fluid">
            <div class="row py-5 bg-light">
                <div class="col-md-12 col-lg-12 col-12 text-center portfolio-card" id="admin">
                    <form method="POST" action="{{ route('admin.login.post') }}">
                        @csrf
                        <div>
                            <button type="submit" class="btn " style=" background:#D1D6E5;color: #060911;">
                                {{ __('I Am School Coordinator ') }}
                            </button>
                        </div>
                    </form>
                    <!-- <a href="#" target="_blank" rel="noopener noreferrer" class="btn text-white btn-primary">Admin login</a> -->
                </div>
                <div class="col-md-12 col-lg-12 col-12 text-center hidden portfolio-card" id="student">

                    <form method="POST" action="{{ route('student.login.post') }}">
                        @csrf
                        <div>
                            <button type="submit" class="btn " style=" background:#D1D6E5;color: #060911;">
                                {{ __('I Am School Student ') }}
                            </button>
                        </div>
                    </form>
                    <!-- <a href="#" target="_blank" rel="noopener noreferrer" class="btn text-white btn-primary">Student Login</a> -->
                </div>
                <div class="col-md-12 col-lg-12 col-12 text-center hidden portfolio-card" id="teacher">
                    <form method="POST" action="{{ route('teacher.login.post') }}">
                        @csrf
                        <div>
                            <button type="submit" class="btn " style=" background:#D1D6E5;color: #060911;">
                                {{ __('I Am School Teacher ') }}
                            </button>
                        </div>
                    </form>
                    <!-- <a href="#" target="_blank" rel="noopener noreferrer" class="btn text-white btn-primary">Teacher Login</a></div> -->
                </div>
            </div>
    </section>
    <!--====== Key Features PART START ======-->
    <section id="portfolio" class="portfolio-area">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h3 class="title">Key Features</h3>
                        <p class="text">Facilitating the elements to empower the Indian Education System.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="portfolio-menu pt-30 text-center">
                        <ul>

                            <li onclick="showhide()" id="virtualclass" data-filter=".virtual-school" class="active">
                                Admin</li>
                            <li onclick="showinstitutional()" id="instbrand" data-filter=".institutional-brand">
                                Student
                            </li>
                            <li onclick="showsmart()" id="smartteacher" data-filter=".smart-teacher">Teacher</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div id="virtual" class=" portfolio-card virtual-school">
                    <div class="row ">
                        <div class="col-lg-6 ">
                            <div class="single-about d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets/images/KeyFeatures/virtualschooling/liveclasses.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Live Classes</h5>
                                    <p class="text ">Helps conduct uninterrupted
                                        classes online from the
                                        comfort of your home.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="single-about d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\virtualschooling\practiceexercises2.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Practice Exercises</h5>
                                    <p class="text pr-2"> Helps students master each chapter's
                                        concepts.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="single-about d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\virtualschooling\selfexplanatoryvideos2.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Self Explanatory Videos</h5>
                                    <p class="text pr-2">Videos that help you visualize various
                                        concepts, making it easier to understand.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="single-about d-sm-flex mt-30  Features pb-3 pt-2 pl-2 media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\virtualschooling\onlineassessment2.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Online Assessments</h5>
                                    <p class="text pr-2"> Easy to create, launch and manage online
                                        tests and
                                        assessments securely with Google Classroom.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="single-about d-sm-flex mt-30 Features pb-3 pt-2 pl-2 media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\virtualschooling\mocktest.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Mock Tests</h5>
                                    <p class="text pr-2">
                                        Be exam ready by solving test questions from a pool of
                                        questions
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="single-about media d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\virtualschooling\Additionalresources.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Additional Resources</h5>
                                    <p class="text pr-2">
                                        Extra Resources like Drawing Board, WikiPedia and many more
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="institutional" class="hidden portfolio-card institutional-brand">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex mt-30   pb-3 pt-2 pl-2 Features media ">
                                <img src="{{asset('extra/assets\images\KeyFeatures\InstitutionalBranding\School Website_2.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Educational institution Website</h5>
                                    <p class="text pr-2">Create your digital identity with your Educational
                                        institution
                                        Website.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media ">
                                <img src="{{asset('extra/assets\images\KeyFeatures\InstitutionalBranding\DigitalmarketingSetup.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Digital Marketing Setup</h5>
                                    <p class="text pr-2">Increasing your brand presence with your own
                                        website along with social media pages.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex  mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\InstitutionalBranding\PromotinalVideo.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Promotional Videos</h5>
                                    <p class="text pr-2"> Promotional video content for individual educational
                                        institution.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="smart" class="hidden  portfolio-card smart-teacher">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\SmartTeacherTraining\OnlineTeacherAssessment_2.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Online Teacher Assessment</h5>
                                    <p class="text pr-2">Assessing the teacher’s ability to help
                                        finesse their technical knowledge.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex  mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra/assets\images\KeyFeatures\SmartTeacherTraining\Smart Teacher Training.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Online Teacher Training Course</h5>
                                    <p class="text pr-2">Familiarising teachers with the new
                                        technological trends </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-about d-sm-flex  mt-30 pb-3 pt-2 pl-2 Features media">
                                <img src="{{asset('extra\assets\images\KeyFeatures\SmartTeacherTraining\SmartTeacherCertification.png')}}')}}" alt="Icon" class="align-self-center mr-3">
                                <div class="about-content media-body">
                                    <h5 class="mt-0 mb-1">Smart Teacher Certification</h5>
                                    <p class="text pr-2">Certifying teachers as technologically
                                        advanced ‘Smart Teachers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <footer id="footer" class="footer-area">
        <div class="footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="copyright text-center text-lg-left mt-10">
                            <p class="text">© Copyright 2020, All Rights Reserved |<a style="color: #253372" rel="nofollow" href=""> Montbit Technologies.</a></p>
                        </div> <!--  copyright -->
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-logo text-center mt-10">
                            <a href="#"><img style="height: 100px !important;" src="{{asset('extra/assets/images/logo-1.png')}}" alt="Logo"></a>
                        </div> <!-- footer logo -->
                    </div>
                    <div class="col-lg-5">
                        <ul class="social text-center text-lg-right mt-10">
                            <li><a target="_blank" href="https://www.facebook.com/eEdPort/?ref=aymt_homepage_panel&eid=ARCBqzK2__TNHwk7BNW0sZ_oWFM0IvHmdY-FDdEfmU53ssgLiCXbgwFPlB9YkVl9yHDyQSyJrafLcVi-"><i class="lni-facebook-filled"></i></a></li>
                            <li><a target="_blank" href="https://www.youtube.com/channel/UCy76UlnIMTWXk_aN4ZnmDdA"><i class="lni-youtube"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/e_edport/?hl=en"><i class="lni-instagram-original"></i></a></li>
                            <li><a target="_blank" href="https://www.linkedin.com/showcase/electroniceducationportal"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('examination/plugins/popper/popper.min.js')}}"></script>
    <!--====== Slick js ======-->
    <!--====== jquery js ======-->
    <script src=" {{ asset('extra/assets\js\vendor\modernizr-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('examination/plugins/jquery/jquery.min.js')}}"></script>

    <!--====== Bootstrap js ======-->

    <script src="{{asset('extra/assets/js/slick.min.js')}}"></script>
    <!--====== Isotope js ======-->
    <script src="{{asset('extra/assets/js/isotope.pkgd.min.js')}}"></script>
    <!--====== Images Loaded js ======-->
    <script src="{{asset('extra/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <!--====== Magnific Popup js ======-->
    <script src="{{asset('extra/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!--====== Scrolling js ======-->
    <script src="{{asset('extra/assets/js/scrolling-nav.js')}}"></script>
    <script src="{{asset('extra/assets/js/jquery.easing.min.js')}}"></script>
    <!--====== wow js ======-->
    <script src="{{asset('extra/assets/js/wow.min.js')}}"></script>
    <!--====== Main js ======-->
    <script src="{{asset('extra/assets/js/main.js')}}"></script>

    <!-- Toastr -->
    <script type="text/javascript" src="{{asset('extra/plugins/toastr/toastr.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('extra/plugins/toastr/toastr.min.css')}}">

    <script>
        function showhide() {
            $('.portfolio-card').addClass('hidden');
            var a = document.getElementById("virtual");
            let b = document.getElementById("admin");
            b.classList.toggle("hidden");
            a.classList.toggle('hidden');
        }


        function showinstitutional() {

            $('.portfolio-card').addClass('hidden');
            var b = document.getElementById("institutional");
            let a = document.getElementById("student");
            a.classList.toggle("hidden");
            b.classList.toggle('hidden');
        }

        function showsmart() {

            $('.portfolio-card').addClass('hidden');
            var c = document.getElementById("smart");
            let b = document.getElementById("teacher");
            b.classList.toggle("hidden");
            c.classList.toggle('hidden');
        }
    </script>

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src =
                    'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js')
        }
        }
        ';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $('body').on('click', '.goto', function(event) {
            var id = $(this).attr('data-id');
            $("#" + id).trigger("click");
        });
    </script>
</body>

</html>