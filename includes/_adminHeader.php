<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
       

        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/ie-fixes.js"></script>
        <link rel="stylesheet" href="css/ie-fixes.css">
        <![endif]-->

        <meta name="description" content="Testing">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--- This should placed first off all other scripts -->




        <link rel="stylesheet" href="/css/revolution_settings.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link rel="stylesheet" href="/css/axfont.css">
        <link rel="stylesheet" href="/css/tipsy.css">
        <link rel="stylesheet" href="/css/prettyPhoto.css">
        <link rel="stylesheet" href="/css/isotop_animation.css">
        <link rel="stylesheet" href="/css/animate.css">





        <link href='/css/style.css' rel='stylesheet' type='text/css'> 
        <link href='/css/responsive.css' rel='stylesheet' type='text/css'>

        <link href="/css/skins/bright-green.css" rel='stylesheet' type='text/css' id="skin-file">



        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/respond.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="/css/color-chooser.css">
    </head>
    <body class="bgpattern-pw-pattern">




        <div id="wrapper" class="boxed" >

            <div class="top_wrapper">
                <div class="top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="call-us top-bar-block">
                                   Welcome: <?php echo $_SESSION['screenName'] ?>
                                </div>
                                <div class="mail-us top-bar-block">
                                                          
                                </div>

                            </div>
                            <div class="col-sm-5">

                                <!-- Search Box -->
                                <div class="searchbox">
                                    <form action="#" method="get">
                                        <input type="text" class="searchbox-inputtext" id="searchbox-inputtext" name="s" placeholder="Search.."/>
                                        <label class="searchbox-icon" for="searchbox-inputtext"></label>
                                        <input type="submit" class="searchbox-submit" value="Search"/>
                                    </form>
                                </div>
                                <!-- //Search Box// -->
                                <div class="social-icons">
                                    <ul>
                                        <li>
                                            <a href="#" target="_blank" class="social-media-icon facebook-icon" data-original-title="facebook">facebook</a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="social-media-icon twitter-icon" data-original-title="twitter">twitter</a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="social-media-icon googleplus-icon" data-original-title="googleplus">googleplus</a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="social-media-icon pininterest-icon" data-original-title="pininterest">pininterest</a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="social-media-icon dribble-icon" data-original-title="dribble">dribble</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header -->
                <header id="header">
                    <div class="container">

                        <div class="row header">

                            <!-- Logo -->
                            <div class="col-xs-2 logo">
                                <a href="home-version1.html">
                                    <img src="/images/discover.png" alt="Discover Anime"  />
                                </a>
                            </div>
                            <!-- //Logo// -->


                            <!-- Navigation File -->
                            <div class="col-md-10">

                                <!-- Mobile Button Menu -->
                                <div class="mobile-menu-button">
                                    <i class="fa fa-list-ul"></i>
                                </div>
                                <!-- //Mobile Button Menu// -->




                                <nav>
                                    <ul class="navigation">
                                        <li>
                                            <a href="home-version1.html">
                                                <span class="label-nav">
                                                    Home
                                                </span>
                                                <span class="label-nav-sub" data-hover="Examples">
                                                    Home
                                                </span>
                                            </a>
                                          
                                        </li>
                                       <li>
                                            <a href="blog.html">
                                                <span class="label-nav">
                                                    Blog
                                                </span>
                                                <span class="label-nav-sub" data-hover="The News">
                                                    Blog
                                                </span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="blog.html">Blog</a>
                                                </li>
                                                <li>
                                                    <a href="blog-masonry.html">Blog Masonry</a>
                                                </li>
                                                <li>
                                                    <a href="blog-single.html">Blog Single</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                             <a href="/Admin/Category/category-list.php">
                                                <span class="label-nav">
                                                    Admin Utilities
                                                </span>
                                                <span class="label-nav-sub" data-hover="Add/Change">
                                                    Admin Utilities
                                                </span>
                                            </a> 
                                            <ul>
                                                <li>
                                                    <a href="/Admin/Category/category-list.php">Category</a>
                                                </li>
                                                <li>
                                                    <a href="/Admin/Images/image-list.php">Images</a>
                                                </li>
                                                <li>
                                                    <a href="/Admin/Posts/post-list.php">Posts</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                      
                                        <li>
                                            <a href="elements.html">
                                                <span class="label-nav">
                                                    About Us
                                                </span>
                                                <span class="label-nav-sub" data-hover="Elements">
                                                    Elements
                                                </span>
                                            </a>
                                            
                                        </li>
                                        <li>
                                            <a href="/Admin/logout.php">
                                                <span class="label-nav">
                                                    Log Out
                                                </span>
                                                <span class="label-nav-sub" data-hover="Log Out">
                                                    Log Out
                                                </span>
                                            </a>
                                            
                                        </li>
                                       
                                    </ul>

                                </nav>

                                <!-- Mobile Nav. Container -->
                                <ul class="mobile-nav">
                                    <li class="responsive-searchbox">
                                        <!-- Responsive Nave -->
                                        <form action="#" method="get">
                                            <input type="text" class="searchbox-inputtext" id="searchbox-inputtext-mobile" name="s" />
                                            <button class="icon-search"></button>
                                        </form>
                                        <!-- //Responsive Nave// -->
                                    </li>
                                </ul>
                                <!-- //Mobile Nav. Container// -->
                            </div>
                            <!-- Nav -->

                        </div>



                    </div>
                </header>
                <!-- //Header// -->
               


        <script type="text/javascript" src="/js/_jq.js"></script>

        <script type="text/javascript" src="/js/_jquery.placeholder.js"></script>






        <script src="/js/activeaxon_menu.js" type="text/javascript"></script> 
        <script src="/js/animationEnigne.js" type="text/javascript"></script> 
        <script src="/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="/js/ie-fixes.js" type="text/javascript"></script> 
        <script src="/js/jq.appear.js" type="text/javascript"></script> 
        <script src="/js/jquery.base64.js" type="text/javascript"></script> 
        <script src="/js/jquery.carouFredSel-6.2.1-packed.js" type="text/javascript"></script> 
        <script src="/js/jquery.cycle.js" type="text/javascript"></script> 
        <script src="/js/jquery.cycle2.carousel.js" type="text/javascript"></script> 
        <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script> 
        <script src="/js/jquery.easytabs.js" type="text/javascript"></script> 
        <script src="/js/jquery.infinitescroll.js" type="text/javascript"></script> 
        <script src="/js/jquery.isotope.js" type="text/javascript"></script> 
        <script src="/js/jquery.prettyPhoto.js" type="text/javascript"></script> 
        <script src="/js/jQuery.scrollPoint.js" type="text/javascript"></script> 
        <script src="/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script> 
        <script src="/js/jquery.themepunch.revolution.js" type="text/javascript"></script> 
        <script src="/js/jquery.tipsy.js" type="text/javascript"></script> 
        <script src="/js/jquery.validate.js" type="text/javascript"></script> 
        <script src="/js/jQuery.XDomainRequest.js" type="text/javascript"></script> 
        <script src="/js/kanzi.js" type="text/javascript"></script> 
        <script src="/js/retina.js" type="text/javascript"></script> 
    </body>
</html>
